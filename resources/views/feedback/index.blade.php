@extends('layouts.app')
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
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data->count() === 0)
                        <tr>
                            <td colspan="6" class="text-center">No record found</td>
                        </tr>
                    @endif
                    @foreach($data->items() as $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                            <td><span class="badge {{ $item->category_class }} text-monospace">{{ $item->category }}</span></td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">{{ $item->author->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-vote mx-2" onclick="event.preventDefault();
                                                     document.getElementById('voteValue').value = '{{ \App\Enums\VoteTypeEnum::UpVote->value }}';
                                                     document.getElementById('feedbackId').value = '{{ $item->id }}';
                                                     document.getElementById('voteForm').submit();">
                                    <span class="icn fa-duotone fa-thumbs-up {{ $item->up_voted ? 'selected-icn' : '' }}"></span>
                                    <small class="v-count-number  {{ $item->up_voted ? 'selected-icn' : '' }}">{{ $item->up_votes_count }}</small>
                                </button>
                                <button class="btn btn-vote mx-2" onclick="event.preventDefault();
                                                     document.getElementById('voteValue').value = '{{ \App\Enums\VoteTypeEnum::DownVote->value }}';
                                                     document.getElementById('feedbackId').value = '{{ $item->id }}';
                                                     document.getElementById('voteForm').submit();">
                                    <span class="icn icn-danger fa-duotone fa-thumbs-down {{ $item->down_voted ? 'selected-icn-danger' : '' }}"></span>
                                    <small class="v-count-number  {{ $item->down_voted ? 'selected-icn-danger' : '' }}">{{ $item->down_votes_count }}</small>
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('feedback.show', $item->id) }}" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
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
    <form id="voteForm" action="{{ route('feedback.storeVote') }}" method="POST" class="d-none">
        @csrf
        <input id="voteValue" type="hidden" name="type" />
        <input id="feedbackId" type="hidden" name="feedback_id" />
    </form>
@endsection
