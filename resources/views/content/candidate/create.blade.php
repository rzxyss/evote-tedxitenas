@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Create {{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('master-data.candidates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>User <span class="text-danger">*</span></label>
                        <select class="choices form-select" name="user" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Booklet <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="booklet" name="booklet" accept="application/pdf"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Video <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="video" name="video"
                            placeholder="ex: https://www.youtube.com/watch?v=..." value="{{ old('video') }}" required>
                    </div>
                    <a href="{{ route('master-data.candidates.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
