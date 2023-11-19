@extends('layouts.app')
@section('content')
    <form class="form-section mt-5 py-5" method="POST" action="{{ route('feedback.store') }}">
        @csrf
        <div class="container mt-4 mt-sm-0">
            <h1 class="h1 text-center mb-3 mb-md-5">Write Feedback</h1>
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" aria-label="Select Category">
                            <option selected>Select Category</option>
                            <option value="bug-report" {{ old('category') === 'bug-report' ? 'selected': '' }}>Bug Report</option>
                            <option value="feature-request" {{ old('category') === 'feature-request' ? 'selected': '' }}>Feature Request</option>
                            <option value="improvement"{{ old('category') === 'improvement' ? 'selected': '' }}>Improvement</option>
                        </select>
                        @error('category')
                        <div class="invalid-feedback" id="categoryError">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter your title" value="{{ old('title') }}" autocomplete="title" />
                        @error('title')
                        <div class="invalid-feedback" id="titleError">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter your description" autocomplete="description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback" id="descriptionError">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsectionå
