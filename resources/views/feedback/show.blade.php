@extends('layouts.app')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="mt-4">
            @include('layouts.partials.alerts')
        </div>
        <section class="feedback-item-single">
            <div class="container mt-4 mt-sm-0">
                <div class="tp-row d-flex justify-content-between align-items-center mb-3 mb-md-4">
                    <div class="tp-i-left">
                        <h1 class="h3 mb-0">{{ $feedback->title }}</h1>
                        <span class="badge badge-info text-monospace">{{ $feedback->category }}</span>
                    </div>
                    <div class="tp-i-right">
                        <button class="btn btn-vote mx-1" onclick="submitVote(event, '{{ $feedback->id }}', '{{ \App\Enums\VoteTypeEnum::UpVote->value }}')">
                            <span class="icn fa-duotone fa-thumbs-up {{ $feedback->up_voted ? 'selected-icn' : '' }}"></span>
                            <small class="v-count-number">{{ $feedback->up_votes_count }}</small>
                        </button>
                        <button class="btn btn-vote mx-1" onclick="submitVote(event, '{{ $feedback->id }}', '{{ \App\Enums\VoteTypeEnum::DownVote->value }}')">
                            <span class="icn icn-danger fa-duotone fa-thumbs-down {{ $feedback->down_voted ? 'selected-icn-danger' : '' }}"></span>
                            <small class="v-count-number">{{ $feedback->down_votes_count }}</small>
                        </button>
                    </div>
                </div>
                <div class="description">
                    {{ $feedback->description }}
                </div>
                <div class="comments-block mt-5 pt-5">
                    <div class="row">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <h5 class="h5 mb-3">Add a Comment</h5>
                            <form class="comment-form" method="POST" action="{{ route('feedback.storeComment') }}">
                                @csrf
                                <input type="hidden" name="feedback_id" value="{{ $feedback->id }}"/>
                                <div class="form-group">
                                    <label for="comment"></label>
                                    <textarea type="text" id="comment" class="form-control @error('content') is-invalid @enderror" placeholder="Enter your comment" rows="5" name="content">{{ old('content') }}</textarea>
                                </div>
                                <div class="text-right">
                                    <span class="mr-1">Login to add comment</span>
                                    <button type="submit" class="btn btn-primary btn-submit" {{ Auth::check() ? '' : 'disabled' }}>Submit</button>
                                </div>
                            </form>
                            <h2>Feedback Discussion</h2>
                            <ul class="comments-list list-unstyled m-0">
                                @if($comments->count() === 0)
                                    <li>
                                        <div>
                                            <p>No comment for this feedback. Be the first to leave the comment.</p>
                                        </div>
                                    </li>
                                @endif
                                @foreach($comments->items() as $comment)
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <span class="user-name">{{ $comment->author->name }}</span>
                                            <time datetime="2008-02-14 20:00" class="time">{{ $comment->created_at->diffForHumans() }}</time>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                                <div class="col-6 ml-sm-auto col-lg-10 px-4 mt-2">
                                    {{ $comments->onEachSide(2)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <form id="voteForm" action="{{ route('feedback.storeVote') }}" method="POST" class="d-none">
        @csrf
        <input id="voteValue" type="hidden" name="type" />
        <input id="feedbackId" type="hidden" name="feedback_id" />
    </form>
@endsection
<script>
    const submitVote = (event, feedbackId, voteType) => {
        event.preventDefault()
        document.getElementById('feedbackId').value = feedbackId
        document.getElementById('voteValue').value = voteType
        document.getElementById('voteForm').submit()
    }
</script>
