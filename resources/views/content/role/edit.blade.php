@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit {{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('master-data.roles.update', encrypt($role->id)) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>1. Role Information</p>
                    <div class="row">
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $role->name) }}" placeholder="ex: admin">
                        </div>
                    </div>
                    <hr>
                    <p>2. Permissions</p>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th><strong>Permission</strong></th>
                                    <th><input class="form-check-input" type="checkbox" id="select-all"> Select All</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $group => $items)
                                    <tr>
                                        <td>{{ ucfirst($group) }}</td>
                                        <td>
                                            @foreach ($items as $permission)
                                                <div>
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}" id="perm{{ $permission->id }}"
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="perm{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('master-data.roles.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('select-all');

                const permissionCheckboxes = document.querySelectorAll(
                    'input[name="permissions[]"]'
                );

                function updateSelectAllState() {
                    const total = permissionCheckboxes.length;
                    const checked = document.querySelectorAll(
                        'input[name="permissions[]"]:checked'
                    ).length;

                    selectAll.checked = total === checked;
                }

                updateSelectAllState();

                selectAll.addEventListener('change', function() {
                    permissionCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAll.checked;
                    });
                });

                permissionCheckboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        updateSelectAllState();
                    });
                });
            });
        </script>
    @endpush
@endpush
