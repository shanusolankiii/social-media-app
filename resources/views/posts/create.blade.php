<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Post</button>
        </form>
    </div>
@endsection
