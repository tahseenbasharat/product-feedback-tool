@extends('layouts.app')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="mt-4">
            @include('layouts.partials.alerts')
        </div>
        <h1 class="h3 mb-3">Users Listing</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-listing">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Username</th>
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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td class="text-center">
                            <button class="action-btn btn-del" onclick="deleteUser(event, {{ $item->id }})"><i class="fa-solid fa-trash"></i></button>
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
    <form id="deleteUserForm" action="#" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
@push('scripts')
    <script>
        const deleteUser = (event, userId) => {
            event.preventDefault()
            const deleteUserForm = document.getElementById('deleteUserForm')
            deleteUserForm.action = `{{ route('user.destroy', '__userId__') }}`.replace('__userId__', userId)
            deleteUserForm.submit()
        }
    </script>
@endpush
