@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }} List</h4>
                    <a href="{{ route('master-data.roles.create') }}" class="btn btn-primary">Create {{ $title }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-role">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('master-data.roles.edit', encrypt($p->id)) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('master-data.roles.destroy', encrypt($p->id)) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($p->created_at)->translatedFormat('d M Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($p->updated_at)->translatedFormat('d M Y') }}</td>
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
        let role = document.querySelector('#table-role');
        let dataTable = new simpleDatatables.DataTable(role);
    </script>
@endpush
