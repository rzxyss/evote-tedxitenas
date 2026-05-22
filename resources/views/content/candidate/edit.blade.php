@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit {{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('master-data.candidates.update', encrypt($candidate->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>User</label>
                        <input class="form-control" value="{{ $candidate->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Booklet</label>
                        <input type="file" class="form-control mb-2" id="booklet" name="booklet"
                            accept="application/pdf">
                        <span class="pt-2">Current Booklet: <button type="button"
                                class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#bookletModal">View</button></span>
                        <span class="text-danger d-block text-sm">*Leave blank if you don't want to change the
                            booklet</span>
                    </div>
                    <div class="form-group">
                        <label>Video <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="video" name="video"
                            placeholder="ex: https://www.youtube.com/watch?v=..."
                            value="{{ old('video', $candidate->video) }}" required>
                    </div>
                    <a href="{{ route('master-data.candidates.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade" id="bookletModal" tabindex="-1" role="dialog" aria-labelledby="bookletModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe src="{{ asset('storage/booklet/' . $candidate->booklet) }}" width="100%" height="600px">
                    </iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
