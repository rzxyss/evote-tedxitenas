@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit {{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('master-data.permissions.update', encrypt($permission->id)) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Permission Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex: view_users"
                            value="{{ old('name', $permission->name) }}">
                    </div>
                    <a href="{{ route('master-data.permissions.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
