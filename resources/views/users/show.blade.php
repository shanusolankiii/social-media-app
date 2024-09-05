@extends('layouts.app')

<style>
    .fixed-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
</style>

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        @if (auth()->user()->id !== $user->id)
            @if (auth()->user()->isFollowing($user->id, auth()->user()->id))
                <form action="{{ route('unfollow', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-end">Unfollow</button>
                </form>
            @else
                <form action="{{ route('follow', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm float-end">Follow</button>
                </form>
            @endif
        @endif

        <p><strong>Followers:</strong> {{ $user->followers->count() }}</p>
        <p><strong>Following:</strong> {{ $user->following->count() }}</p>

        <h3>Posts by {{ $user->name }}</h3>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid ">
                        @endif
                        <div class="card-body">
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </p>
                            <p><strong>Likes:</strong> {{ $post->likes->count() }}</p>
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
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        {{ $posts->links() }}
    </div>
@endsection
