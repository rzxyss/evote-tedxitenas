@extends('layouts.app')

@section('content')
    @if (auth()->user()->hasRole('superadmin'))
        @include('content.dashboard.admin')
    @else
        @include('content.dashboard.voter')
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function(e) {
            const voteButton = e.target.closest('.btn-agree, .btn-disagree');
            if (voteButton) {
                e.preventDefault();
                const form = voteButton.closest('.vote-form');

                Swal.fire({
                    title: 'Confirm Your Vote',
                    text: 'Are you sure you want to vote for this candidate?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Vote',
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
