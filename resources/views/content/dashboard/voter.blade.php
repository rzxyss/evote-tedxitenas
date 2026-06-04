<style>
    .candidate-card {
        width: 100%;
        max-width: 320px;
        margin: 10px;
    }

    .candidate-image {
        width: 100%;
        height: 300px;
        object-fit: contain;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    @media (max-width: 768px) {
        .candidate-image {
            height: 220px;
        }
    }

    @media (max-width: 576px) {
        .candidate-image {
            height: 180px;
        }
    }
</style>
<section class="section">
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->has_voted == '0')
                <div class="row justify-content-center">
                    @foreach ($candidate as $c)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-flex justify-content-center">
                            <div class="card candidate-card shadow-sm">
                                <div class="card-content">
                                    @if ($c->user->photo)
                                        <img class="candidate-image"
                                            src="{{ asset('storage/profile/' . $c->user->photo) }}" alt="Card image cap">
                                    @else
                                        <img class="candidate-image" src="{{ asset('assets/images/default.png') }}"
                                            alt="Card image cap">
                                    @endif

                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $c->user->name }}</h4>

                                        {{-- <p class="card-text">
                                            This card has supporting text below as a natural lead-in to additional
                                            content.
                                        </p> --}}

                                        {{-- <small class="text-muted">
                                            Last updated 3 mins ago
                                        </small> --}}
                                        <div class="d-flex flex-md-row flex-column justify-content-center gap-2 mt-3">
                                            <button type="button" class="btn btn-outline-primary btn-sm block"
                                                data-bs-toggle="modal"
                                                data-bs-target="#bookletModal{{ $c->id }}">
                                                View Booklet
                                            </button>
                                            <div class="modal fade" id="bookletModal{{ $c->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="bookletModalLabel{{ $c->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <iframe src="{{ asset('storage/booklet/' . $c->booklet) }}"
                                                                width="100%" height="600px">
                                                            </iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><button type="button" class="btn btn-outline-primary btn-sm block"
                                                data-bs-toggle="modal" data-bs-target="#videoModal{{ $c->id }}">
                                                View Video
                                            </button>
                                            <div class="modal fade" id="videoModal{{ $c->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="videoModalLabel{{ $c->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            @php
                                                                $videoId = basename(parse_url($c->video, PHP_URL_PATH));
                                                            @endphp
                                                            <div class="ratio ratio-16x9">
                                                                <iframe
                                                                    src="https://www.youtube.com/embed/{{ $videoId }}"
                                                                    title="YouTube video player" frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @can('vote_create')
                                            <div class="mt-2 d-flex flex-md-row flex-column justify-content-center gap-2">
                                                <form action="{{ route('vote', encrypt($c->id)) }}" method="POST"
                                                    class="vote-form">
                                                    @csrf
                                                    <button type="button" class="btn btn-outline-success block btn-agree">
                                                        Agree
                                                    </button>
                                                </form>
                                                <form action="{{ route('vote-disagree', encrypt($c->id)) }}" method="POST"
                                                    class="vote-form">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-danger block btn-disagree">
                                                        Disagree
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    You have already voted. Thank you for your participation!
                </div>
            @endif
        </div>
    </div>
</section>
