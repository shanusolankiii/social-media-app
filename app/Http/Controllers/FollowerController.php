<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        // Prevent users from following themselves
        if ($user->id !== Auth::id()) {
            $checkAlreadyFollowing = Follower::where("user_id", $user->id)->where("follower_id", Auth::id())->first();
            if (empty($checkAlreadyFollowing) || is_null($checkAlreadyFollowing) || !is_object($checkAlreadyFollowing)) {
                // dd($checkAlreadyFollowing);
                Follower::create([
                    'user_id' => $user->id,
                    'follower_id' => Auth::id(),
                ]);

                return redirect()->back()->with('success', 'You are now following ' . $user->name);
            } else {
                return redirect()->back()->with('error', 'You are already following ' . $user->name);
            }
        }

        return redirect()->back()->with('error', 'You cannot follow yourself.');
    }
    public function destroy(User $user)
    {
        // dd($user->id, Auth::id());
        $follower = Follower::where('user_id', $user->id)
            ->where('follower_id', Auth::id())
            ->first();

        if ($follower) {
            $follower->delete();
            return redirect()->back()->with('success', 'You have Unfollowed ' . $user->name);
        }

        return redirect()->back()->with('error', 'You are not following this user.');
    }

}
