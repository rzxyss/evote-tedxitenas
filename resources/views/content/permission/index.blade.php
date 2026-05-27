@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }} List</h4>
                    <a href="{{ route('master-data.permissions.create') }}" class="btn btn-primary">Create
                        {{ $title }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-permission">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permission as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('master-data.permissions.edit', encrypt($p->id)) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('master-data.permissions.destroy', encrypt($p->id)) }}"
                                                method="POST" style="display: inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
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
        let permission = document.querySelector('#table-permission');
        let dataTable = new simpleDatatables.DataTable(permission);

        document.querySelector('#table-permission').addEventListener('click', function(e) {
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
