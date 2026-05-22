@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit {{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('master-data.account.update', encrypt($account->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex: John Doe"
                            value="{{ old('name', $account->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="ex: johndoe@example.com" value="{{ old('email', $account->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="ex: ********">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control mb-2" id="photo" name="photo" accept="image/*">
                        @if ($account->photo)
                            <span class="pt-2">Current Photo: <button type="button"
                                    class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#photoModal">View</button></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select class="choices form-select" name="role" required>
                            @foreach ($role as $r)
                                <option value="{{ $r->name }}" {{ $account->hasRole($r->name) ? 'selected' : '' }}>
                                    {{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('master-data.account.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>
                        <img src="{{ asset('storage/profile/' . $account->photo) }}" alt="Profile Photo" class="img-fluid">
                    </p>
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
