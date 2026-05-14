@extends('layouts.app')

@section('content')
    @php($permissionItems = $permissions ?? ($permission ?? collect()))
    @php($permissionCount = $permissionItems->count())
    @php($permissionPager = $permissions ?? ($permission ?? null))
    @php($startIndex = method_exists($permissionPager, 'firstItem') ? $permissionPager->firstItem() ?? 1 : 1)

    <div class="page-header">
        <div class="page-title">
            <h1>{{ $title ?? 'Permissions' }}</h1>
            <p>Manage access permissions for system modules and features.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('master-data.permissions.create') }}" class="btn-primary">
                <i class="bi bi-plus-circle"></i>
                Add Permission
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
                        <th>Permission</th>
                        <th>Guard</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissionItems as $permission)
                        <tr>
                            <td>{{ $startIndex + $loop->index }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('master-data.permissions.edit', encrypt($permission->id)) }}"
                                        class="btn-outline btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST"
                                        action="{{ route('master-data.permissions.destroy', encrypt($permission->id)) }}"
                                        onsubmit="return confirm('Hapus permission ini?')">
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
                                    <span class="fw-semibold">{{ $permission->name }}</span>
                                    <small class="text-muted">Slug: {{ $permission->name }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-completed">
                                    {{ $permission->guard_name ?? 'web' }}
                                </span>
                            </td>
                            <td>{{ $permission->created_at?->format('d M Y') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-4 text-muted">
                                    No permissions are available yet.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($permissionPager && method_exists($permissionPager, 'links'))
            @php($currentPage = $permissionPager->currentPage())
            @php($lastPage = $permissionPager->lastPage())
            @php($startPage = max(1, $currentPage - 1))
            @php($endPage = min($lastPage, $currentPage + 1))

            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Task pagination">
                    <ul class="pagination">
                        <li class="page-item {{ $permissionPager->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $permissionPager->previousPageUrl() ?? '#' }}"
                                aria-label="Previous"
                                {{ $permissionPager->onFirstPage() ? 'aria-disabled=true tabindex=-1' : '' }}>
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        @for ($page = $startPage; $page <= $endPage; $page++)
                            <li class="page-item">
                                <a class="page-link {{ $page === $currentPage ? 'active' : '' }}"
                                    href="{{ $permissionPager->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $permissionPager->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $permissionPager->nextPageUrl() ?? '#' }}" aria-label="Next"
                                {{ $permissionPager->hasMorePages() ? '' : 'aria-disabled=true tabindex=-1' }}>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
