@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }} List</h4>
                    @can('user_create')
                        <div class="d-flex flex-md-row flex-column gap-2">
                            <button class="btn btn-success btn-import" data-bs-toggle="modal"
                                data-bs-target="#importModal">Import</button>
                            <a href="{{ route('master-data.account.create') }}" class="btn btn-primary">Create
                                {{ $title }}</a>
                        </div>
                    @endcan
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
                                            @can('user_update')
                                                <a href="{{ route('master-data.account.edit', encrypt($a->id)) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                            @endcan
                                            @can('user_delete')
                                                <form action="{{ route('master-data.account.destroy', encrypt($a->id)) }}"
                                                    method="POST" style="display: inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-delete">Delete</button>
                                                </form>
                                            @endcan
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

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalTitle">Import {{ $title }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('master-data.account.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Select Excel File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls"
                                required>
                        </div>
                        <a href="{{ route('master-data.account.download-template') }}" target="_blank"
                            class="btn btn-primary ml-1">
                            <i class="bx bx-download d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Download Template</span>
                        </a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Import</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let account = document.querySelector('#table-account');
        let dataTable = new simpleDatatables.DataTable(account);

        const importForm = document.querySelector('form[action*="master-data.account.import"]');
        if (importForm) {
            importForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const fileInput = document.getElementById('file');
                if (!fileInput.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Required',
                        text: 'Please select a file to import'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Importing...',
                    html: 'Please wait while your file is being imported',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                this.submit();
            });
        }

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
