<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post->user->name }}</h5>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mt-3">
                @endif
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>

                <!-- Like/Unlike Buttons -->
                @if ($post->likes->contains('user_id', auth()->id()))
                    <form action="{{ route('posts.unlike', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unlike</button>
                    </form>
                @else
                    <form action="{{ route('posts.like', $post) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Like</button>
                    </form>
                @endif

                <!-- Edit/Delete Buttons (only for the post owner) -->
                @if ($post->user_id == auth()->id())
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif

                <!-- resources/views/profiles/show.blade.php or user list view -->
                <!-- Display follow/unfollow button for a user -->

                @if (auth()->user()->isFollowing($post->user))
                    <!-- Assuming you have a method to check if the user is following -->
                    <form action="{{ route('unfollow', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('follow', $user) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
