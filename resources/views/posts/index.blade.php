<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mb-2 mt-2">
        <h1 class="text-center">All Feeds</h1>
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <!-- User Icon -->
                        <a href="{{ route('users.show', $post->user) }}" class="d-inline-block">
                            <img src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('storage/images/default-user.png') }}"
                                alt="User Icon" class="rounded-circle"
                                style="width: 40px; height: 40px; object-fit: cover; border: 2px solid black; margin-right: 8px;">
                        </a>

                        <!-- Username and Follow/Unfollow Button -->
                        <div class="ms-2 flex-grow-1">
                            <h5 class="card-title d-inline">{{ $post->user->name }}</h5>
                        </div>
                    </div>
                    <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>

                    <!-- Post Image -->
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mb-3">
                    @endif

                    <!-- Post Content -->
                    <p class="card-text">{{ $post->content }}</p>


                    <!-- Like/Unlike Buttons -->
                    @if ($post->likes->contains('user_id', auth()->id()))
                        <form action="{{ route('posts.unlike', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('posts.like', $post) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-heart"></i>
                            </button>
                        </form>
                    @endif

                    <!-- Edit/Delete Buttons (only for the post owner) -->
                    @if ($post->user_id == auth()->id())
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Pagination Links -->
        {{ $posts->links() }}
    </div>
@endsection
