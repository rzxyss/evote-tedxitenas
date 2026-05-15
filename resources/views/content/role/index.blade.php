@extends('layouts.app')

@section('content')
    @php($roleItems = $roles ?? ($role ?? collect()))
    @php($roleCount = $roleItems->count())
    @php($rolePager = $roles ?? ($role ?? null))
    @php($startIndex = method_exists($rolePager, 'firstItem') ? $rolePager->firstItem() ?? 1 : 1)

    <div class="page-header">
        <div class="page-title">
            <h1>{{ $title ?? 'Roles' }}</h1>
            <p>Manage user roles and access levels for the system.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('master-data.roles.create') }}" class="btn-primary">
                <i class="bi bi-plus-circle"></i>
                Add Role
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 90px;">No</th>
                        <th style="width: 190px;">#</th>
                        <th>Role</th>
                        <th>Guard</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roleItems as $role)
                        <tr>
                            <td>{{ $startIndex + $loop->index }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('master-data.roles.edit', encrypt($role->id)) }}"
                                        class="btn-outline btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST"
                                        action="{{ route('master-data.roles.destroy', encrypt($role->id)) }}"
                                        onsubmit="return confirm('Hapus role ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">{{ $role->name }}</span>
                                    <small class="text-muted">Permissions: {{ $role->permissions?->count() ?? 0 }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-completed">
                                    {{ $role->guard_name ?? 'web' }}
                                </span>
                            </td>
                            <td>{{ $role->created_at?->format('d M Y') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-4 text-muted">
                                    No roles are available yet.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($rolePager && method_exists($rolePager, 'links'))
            @php($currentPage = $rolePager->currentPage())
            @php($lastPage = $rolePager->lastPage())
            @php($startPage = max(1, $currentPage - 1))
            @php($endPage = min($lastPage, $currentPage + 1))

            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Task pagination">
                    <ul class="pagination">
                        <li class="page-item {{ $rolePager->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $rolePager->previousPageUrl() ?? '#' }}" aria-label="Previous"
                                {{ $rolePager->onFirstPage() ? 'aria-disabled=true tabindex=-1' : '' }}>
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        @for ($page = $startPage; $page <= $endPage; $page++)
                            <li class="page-item">
                                <a class="page-link {{ $page === $currentPage ? 'active' : '' }}"
                                    href="{{ $rolePager->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $rolePager->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $rolePager->nextPageUrl() ?? '#' }}" aria-label="Next"
                                {{ $rolePager->hasMorePages() ? '' : 'aria-disabled=true tabindex=-1' }}>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
