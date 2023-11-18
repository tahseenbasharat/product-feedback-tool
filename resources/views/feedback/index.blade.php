@extends('layouts.app')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="pt-3">
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
                    @foreach($data->items() as $key => $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                            <td><span class="badge {{ $item->category_class }} text-monospace">{{ $item->category }}</span></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->author->name }}</td>
                            <td>
                                <button class="btn btn-vote mx-2">
                                    <span class="icn fa-duotone fa-thumbs-up"></span>
                                    <small class="v-count-number">{{ $item->up_votes_count }}</small>
                                </button>
                                <button class="btn btn-vote mx-2">
                                    <span class="icn icn-danger fa-duotone fa-thumbs-down"></span>
                                    <small class="v-count-number">{{ $item->down_votes_count }}</small>
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="/" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
        {{ $data->links() }}
    </div>
@endsection
