@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css">
@endpush
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="mt-4">
            @include('layouts.partials.alerts')
        </div>
        <h1 class="h3 mb-3">Feedback Listing</h1>
        <div class="table-responsive">
                <table class="table table-striped table-hover table-listing">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-center">Author</th>
                        <th scope="col" class="text-center">Vote(s)</th>
                        @if (Auth::check() && Auth::user()->is_admin)
                            <th scope="col" class="text-center">Comments</th>
                        @endif
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data->count() === 0)
                        <tr>
                            <td colspan="{{ Auth::check() && Auth::user()->is_admin ? '7' : '6' }}" class="text-center">No record found</td>
                        </tr>
                    @endif
                    @foreach($data->items() as $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                            <td><span class="badge {{ $item->category_class }} text-monospace">{{ $item->category }}</span></td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">{{ $item->author->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-vote mx-2" onclick="submitVote(event, '{{ $item->id }}', '{{ \App\Enums\VoteTypeEnum::UpVote->value }}')">
                                    <span class="icn fa-duotone fa-thumbs-up {{ $item->up_voted ? 'selected-icn' : '' }}"></span>
                                    <small class="v-count-number  {{ $item->up_voted ? 'selected-icn' : '' }}">{{ $item->up_votes_count }}</small>
                                </button>
                                <button class="btn btn-vote mx-2" onclick="submitVote(event, '{{ $item->id }}', '{{ \App\Enums\VoteTypeEnum::DownVote->value }}')">
                                    <span class="icn icn-danger fa-duotone fa-thumbs-down {{ $item->down_voted ? 'selected-icn-danger' : '' }}"></span>
                                    <small class="v-count-number  {{ $item->down_voted ? 'selected-icn-danger' : '' }}">{{ $item->down_votes_count }}</small>
                                </button>
                            </td>
                            @if (Auth::check() && Auth::user()->is_admin)
                                <td class="text-center">
                                    <input type="checkbox" data-toggle="switch" data-id="{{ $item->id }}" {{ $item->is_comment_enabled ? 'checked' : '' }} />
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('feedback.show', $item->id) }}" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
                                @if (Auth::check() && Auth::user()->is_admin)
                                    <button onclick="deleteFeedback(event, {{ $item->id }})" class="action-btn btn-del"><i class="fa-solid fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-6 ml-sm-auto col-lg-10 px-4 mt-2">
                {{ $data->onEachSide(2)->links() }}
            </div>
        </div>
    </main>
    <form id="deleteFeedbackForm" action="#" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
    <form id="toggleCommentForm" action="#" method="POST" class="d-none">
        @csrf
        @method('PUT')
        <input id="toggleCommentValue" type="hidden" name="type" />
        <input id="feedbackId" type="hidden" name="feedback_id" />
    </form>
    <form id="voteForm" action="{{ route('feedback.storeVote') }}" method="POST" class="d-none">
        @csrf
        <input id="voteValue" type="hidden" name="type" />
        <input id="feedbackId" type="hidden" name="feedback_id" />
    </form>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
    <script>
        $(document).ready(function(){
            $("[data-toggle='switch']").bootstrapSwitch()

            $("[data-toggle='switch']").on('switchChange.bootstrapSwitch', function (event, state) {
                const toggleCommentForm = document.getElementById('toggleCommentForm')
                toggleCommentForm.action = `{{ route('feedback.toggleComment', '__feedbackId__') }}`.replace('__feedbackId__', $(this).data('id'))
                toggleCommentForm.submit()
            });
        })
        const deleteFeedback = (event, feedbackId) => {
            event.preventDefault()
            const deleteFeedbackForm = document.getElementById('deleteFeedbackForm')
            deleteFeedbackForm.action = `{{ route('feedback.destroy', '__feedbackId__') }}`.replace('__feedbackId__', feedbackId)
            deleteFeedbackForm.submit()
        }

        const submitVote = (event, feedbackId, voteType) => {
            event.preventDefault()
            document.getElementById('feedbackId').value = feedbackId
            document.getElementById('voteValue').value = voteType
            document.getElementById('voteForm').submit()
        }
    </script>
@endpush
