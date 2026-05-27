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
                            @foreach ($role as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('master-data.roles.edit', encrypt($r->id)) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('master-data.roles.destroy', encrypt($r->id)) }}"
                                                method="POST" style="display: inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($r->created_at)->translatedFormat('d M Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($r->updated_at)->translatedFormat('d M Y') }}</td>
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

        document.querySelector('#table-role').addEventListener('click', function(e) {
            const deleteButton = e.target.closest('.btn-delete');
            if (deleteButton) {
                e.preventDefault();
                const form = deleteButton.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endpush
