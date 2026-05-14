@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h1>{{ $title ?? 'Tambah Permission' }}</h1>
            <p>Enter the permission data to be used in the system.</p>
        </div>
    </div>

    <div class="form-card">
        <div class="form-header">
            <h5 class="form-title">
                <i class="bi bi-shield-lock"></i>
                Detail Permission
            </h5>
            <p class="form-subtitle">Use a clear name for easy management.</p>
        </div>

        <form method="POST" action="{{ route('master-data.permissions.store') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">
                    Name <span class="required">*</span>
                </label>
                <input type="text" id="name" name="name" class="form-control" placeholder="contoh: users.create"
                    value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-1 justify-content-end">
                <a href="{{ route('master-data.permissions.index') }}" class="btn-outline">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-save"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
