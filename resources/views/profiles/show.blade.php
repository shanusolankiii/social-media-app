<!-- resources/views/profiles/show.blade.php or user list view -->
<!-- Display follow/unfollow button for a user -->

@if(auth()->user()->isFollowing($user)) <!-- Assuming you have a method to check if the user is following -->
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
