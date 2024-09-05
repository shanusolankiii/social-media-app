<!-- resources/views/posts/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $post->content) }}</textarea>
                <div class="form-group mt-3">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Post</button>
        </form>
    </div>
@endsection
