@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }} List</h4>
                    <a href="{{ route('master-data.candidates.create') }}" class="btn btn-primary">Create
                        {{ $title }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-candidate">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Booklet</th>
                                <th>Video</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('master-data.candidates.edit', encrypt($c->id)) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('master-data.candidates.destroy', encrypt($c->id)) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $c->user->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                            data-bs-target="#bookletModal{{ $c->id }}">
                                            View Booklet
                                        </button>
                                        <div class="modal fade" id="bookletModal{{ $c->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="bookletModalLabel{{ $c->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <iframe src="{{ asset('storage/booklet/' . $c->booklet) }}"
                                                            width="100%" height="600px">
                                                        </iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                            data-bs-target="#videoModal{{ $c->id }}">
                                            View Video
                                        </button>
                                        <div class="modal fade" id="videoModal{{ $c->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="videoModalLabel{{ $c->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        @php
                                                            $videoId = basename(parse_url($c->video, PHP_URL_PATH));
                                                        @endphp
                                                        <div class="ratio ratio-16x9">
                                                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                                                title="YouTube video player" frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                referrerpolicy="strict-origin-when-cross-origin"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($c->created_at)->translatedFormat('d M Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($c->updated_at)->translatedFormat('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection

@push('scripts')
    <script>
        let candidate = document.querySelector('#table-candidate');
        let dataTable = new simpleDatatables.DataTable(candidate);
    </script>
@endpush
