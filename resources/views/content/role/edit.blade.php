@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h1>{{ $title ?? 'Edit Role' }}</h1>
            <p>Update the role data as needed.</p>
        </div>
    </div>

    <div class="form-card">
        <div class="form-header">
            <h5 class="form-title">
                <i class="bi bi-person-badge"></i>
                Detail Role
            </h5>
            <p class="form-subtitle">Use a clear role name for easy management.</p>
        </div>

        <form method="POST" action="{{ route('master-data.roles.update', encrypt($role->id)) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">
                    Name <span class="required">*</span>
                </label>
                <input type="text" id="name" name="name" class="form-control" placeholder="example: admin"
                    value="{{ old('name', $role->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label mb-0">Permissions</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="select_all_permissions">
                        <label class="form-check-label" for="select_all_permissions">Select All</label>
                    </div>
                </div>

                @php
                    $selectedPermissions = old('permissions', $rolePermissions ?? []);
                    $groupedPermissions = collect($permissions ?? [])->groupBy(function ($permission) {
                        $normalized = str_replace('.', '_', $permission->name);
                        $parts = explode('_', $normalized);
                        $groupKey = count($parts) > 1 ? implode('_', array_slice($parts, 0, -1)) : $normalized;
                        return strtoupper($groupKey);
                    });
                @endphp

                @forelse($groupedPermissions as $groupName => $groupItems)
                    <div class="border-bottom py-2">
                        <div class="text-uppercase fw-semibold small mb-2">{{ $groupName }}</div>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($groupItems as $permission)
                                @php($isChecked = in_array($permission->name, $selectedPermissions))
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        id="permission_{{ $permission->id }}" value="{{ $permission->name }}"
                                        {{ $isChecked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <span class="text-muted">No permissions available.</span>
                @endforelse
                @error('permissions')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @error('permissions.*')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-1 justify-content-end">
                <a href="{{ route('master-data.roles.index') }}" class="btn-outline">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-save"></i>
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('select_all_permissions');
            if (!selectAll) {
                return;
            }

            var permissionInputs = Array.from(
                document.querySelectorAll('input[name="permissions[]"]')
            );

            var syncSelectAllState = function() {
                if (permissionInputs.length === 0) {
                    selectAll.checked = false;
                    selectAll.indeterminate = false;
                    return;
                }

                var checkedCount = permissionInputs.filter(function(input) {
                    return input.checked;
                }).length;

                selectAll.checked = checkedCount === permissionInputs.length;
                selectAll.indeterminate = checkedCount > 0 && checkedCount < permissionInputs.length;
            };

            selectAll.addEventListener('change', function() {
                permissionInputs.forEach(function(input) {
                    input.checked = selectAll.checked;
                });
                syncSelectAllState();
            });

            permissionInputs.forEach(function(input) {
                input.addEventListener('change', syncSelectAllState);
            });

            syncSelectAllState();
        });
    </script>
@endsection
