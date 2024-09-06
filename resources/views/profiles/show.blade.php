
@if(auth()->user()->isFollowing($user)) 
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
