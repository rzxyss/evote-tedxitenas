<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    private const BOOKLET_DIR = 'booklet';
    public function index()
    {
        $data = [
            'title' => 'Candidates',
            'candidates' => Candidate::with('user')->get(),
        ];
        return view('content.candidate.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Candidates',
            'users' => User::all(),
        ];
        return view('content.candidate.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
            'booklet' => 'required|file|mimes:pdf|max:10240',
            'video' => 'required|url',
        ]);

        try {
            $bookletFileName = $this->storeUploadedFile($request->file('booklet'));

            Candidate::create([
                'user_id' => $request->user,
                'booklet' => $bookletFileName,
                'video' => $request->video,
            ]);

            return redirect()->route('master-data.candidates.index')->with('success', 'Candidate created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create candidate: ' . $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = [
            'title' => 'Candidates',
            'candidate' => Candidate::findOrFail($id),
        ];

        return view('content.candidate.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $request->validate([
            'booklet' => 'nullable|file|mimes:pdf|max:10240',
            'video' => 'required|url',
        ]);

        try {
            $candidate = Candidate::findOrFail($id);
            if ($request->hasFile('booklet')) {
                $bookletFileName = $this->storeUploadedFile($request->file('booklet'));
                $this->deleteStoredFile($candidate->booklet);
            }
            $candidate->update([
                'booklet' => $request->booklet ? $bookletFileName : $candidate->booklet,
                'video' => $request->video,
            ]);

            return redirect()->route('master-data.candidates.index')->with('success', 'Candidate updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update candidate: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        try {
            $candidate = Candidate::findOrFail($id);
            $this->deleteStoredFile($candidate->booklet);
            $candidate->delete();

            return redirect()->route('master-data.candidates.index')->with('success', 'Candidate deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to delete candidate: ' . $e->getMessage()]);
        }
    }

    private function storeUploadedFile($file): ?string
    {
        if (!$file) {
            return null;
        }

        $extension = $file->getClientOriginalExtension();
        $fileName = 'BOOKLET' . '_' . uniqid() . '.' . $extension;

        $file->storeAs(self::BOOKLET_DIR, $fileName, 'public');

        return $fileName;
    }

    private function deleteStoredFile(?string $fileName): void
    {
        if (!$fileName) {
            return;
        }

        $fullPath = self::BOOKLET_DIR . '/' . $fileName;
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        }
    }
}
