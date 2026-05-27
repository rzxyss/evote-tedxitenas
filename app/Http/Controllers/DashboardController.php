<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        checkingPermission('vote_view');
        $title = 'Dashboard';

        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();

        $totalEligibleVoters = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })->count();

        $votedUsers = User::where('has_voted', '1')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'superadmin');
            })->count();

        $notVoted = $totalEligibleVoters - $votedUsers;

        $participationRate = $totalEligibleVoters > 0
            ? round(($votedUsers / $totalEligibleVoters) * 100, 2)
            : 0;

        $votingResults = Candidate::with(['votes' => function ($query) {
            $query->select('candidate_id');
        }])
            ->select('id', 'user_id')
            ->with('user:id,name')
            ->get()
            ->map(function ($candidate) use ($totalVotes) {
                $votes = $candidate->votes->count();
                return [
                    'name' => $candidate->user->name,
                    'votes' => $votes,
                    'percentage' => $totalVotes > 0 ? round(($votes / $totalVotes) * 100, 2) : 0
                ];
            })
            ->sortByDesc('votes')
            ->values()
            ->toArray();

        $data = [
            'title'              => $title,
            'candidate'          => Candidate::with('user')->get(),
            'totalCandidates'    => $totalCandidates,
            'totalVotes'         => $totalVotes,
            'totalVoters'        => $totalEligibleVoters,
            'participationRate'  => $participationRate . '%',
            'notVoted'           => $notVoted,
            'votingStatus'       => 'Active',
            'votingResults'      => $votingResults,
        ];

        return view('dashboard', $data);
    }

    public function vote($id)
    {
        checkingPermission('vote_create');
        $id = decrypt($id);

        if (Auth::user()->has_voted == '1') {
            return redirect()->route('dashboard')
                ->withErrors(['error' => 'You have already cast your vote!']);
        }

        $candidate = Candidate::findOrFail($id);

        Vote::create([
            'candidate_id' => $candidate->id,
        ]);

        Auth::user()->update(['has_voted' => '1']);

        return redirect()->route('dashboard')
            ->with('success', 'Thank you for voting!');
    }
}
