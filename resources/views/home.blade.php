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
                        <th scope="col" class="text-center">Vote(s)</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            <span class="badge badge-danger text-monospace">Bug Report</span>
                        </td>
                        <td>
                            Example Title
                        </td>
                        <td class="text-center">
                            <button class="btn btn-vote mx-2">
                                <span class="icn fa-duotone fa-thumbs-up"></span>
                                <small class="v-count-number">54</small>
                            </button>
                            <button class="btn btn-vote mx-2">
                                <span class="icn icn-danger fa-duotone fa-thumbs-down"></span>
                                <small class="v-count-number">3</small>
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="/" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            <span class="badge badge-info text-monospace">Feature Request</span>
                        </td>
                        <td>
                            Example Title
                        </td>
                        <td class="text-center">
                            <button class="btn btn-vote mx-2">
                                <span class="icn fa-duotone fa-thumbs-up"></span>
                                <small class="v-count-number">54</small>
                            </button>
                            <button class="btn btn-vote mx-2">
                                <span class="icn icn-danger fa-duotone fa-thumbs-down"></span>
                                <small class="v-count-number">3</small>
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="/" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            <span class="badge badge-success text-monospace">Improvement</span>
                        </td>
                        <td>
                            Example Title
                        </td>
                        <td class="text-center">
                            <button class="btn btn-vote mx-2">
                                <span class="icn fa-duotone fa-thumbs-up"></span>
                                <small class="v-count-number">54</small>
                            </button>
                            <button class="btn btn-vote mx-2">
                                <span class="icn icn-danger fa-duotone fa-thumbs-down"></span>
                                <small class="v-count-number">3</small>
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="/" class="action-btn btn-view"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
