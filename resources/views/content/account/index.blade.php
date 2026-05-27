@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }} List</h4>
                    <a href="{{ route('master-data.account.create') }}" class="btn btn-primary">Create
                        {{ $title }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-account">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($account as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('master-data.account.edit', encrypt($a->id)) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('master-data.account.destroy', encrypt($a->id)) }}"
                                                method="POST" style="display: inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger btn-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->getRoleNames()->first() }}</td>
                                    <td>{{ Carbon\Carbon::parse($a->created_at)->translatedFormat('d M Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($a->updated_at)->translatedFormat('d M Y') }}</td>
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
        let account = document.querySelector('#table-account');
        let dataTable = new simpleDatatables.DataTable(account);

        document.querySelector('#table-account').addEventListener('click', function(e) {
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
