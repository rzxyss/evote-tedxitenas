<section class="section">
    <div class="page-content">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total Candidates</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalCandidates ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total Votes</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalVotes ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon orange">
                                    <i class="iconly-boldUser"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total Voters</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalVoters ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldActivity"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Participation</h6>
                                <h6 class="font-extrabold mb-0">{{ $participationRate ?? '0%' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Not Voted</h6>
                                <h6 class="font-extrabold mb-0">{{ $notVoted ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon pink">
                                    <i class="iconly-boldChart"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Status</h6>
                                <h6 class="font-extrabold mb-0">{{ $votingStatus ?? 'Active' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Voting Results</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Candidate Name</th>
                                        <th>Total Votes</th>
                                        <th>Progress</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($votingResults ?? [] as $key => $result)
                                        <tr>
                                            <td class="col-3">
                                                <div class="font-bold">{{ $key + 1 }}</div>
                                            </td>
                                            <td class="col-auto">
                                                <div class="font-bold">{{ $result['name'] ?? '-' }}</div>
                                            </td>
                                            <td class="col-auto">
                                                <div class="badge bg-light-info">{{ $result['votes'] ?? 0 }}</div>
                                            </td>
                                            <td class="col-auto">
                                                <div class="progress" data-height="8" style="height: 8px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $result['percentage'] ?? 0 }}%"
                                                        aria-valuenow="{{ $result['percentage'] ?? 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <div class="font-bold">{{ $result['percentage'] ?? 0 }}%</div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No voting data yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('master-data.candidates.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-people"></i> Manage Candidates
                            </a>
                            <a href="{{ route('master-data.permissions.index') }}" class="btn btn-outline-success">
                                <i class="bi bi-shield-lock"></i> Manage Permissions
                            </a>
                            <a href="javascript:void(0)" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-clockwise"></i> Reset Votes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Voting Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around text-center">
                            <div>
                                <h5 class="text-muted">Votes Cast</h5>
                                <h3 class="text-primary font-bold">{{ $totalVotes ?? 0 }}</h3>
                            </div>
                            <div>
                                <h5 class="text-muted">Total Eligible</h5>
                                <h3 class="text-success font-bold">{{ $totalVoters ?? 0 }}</h3>
                            </div>
                            <div>
                                <h5 class="text-muted">Remaining</h5>
                                <h3 class="text-warning font-bold">{{ ($totalVoters ?? 0) - ($totalVotes ?? 0) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
