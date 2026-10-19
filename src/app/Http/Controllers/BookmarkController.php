<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Job;

class BookmarkController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobListings()->paginate(9);

        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        if($user->bookmarkedJobListings()->find($job->id)) {
            return back()->with('error', 'You have already bookmarked this job');
        }

        $user->bookmarkedJobListings()->attach($job);

        return back()->with('success', 'Bookmarked job successfully');
    }

    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();

        if($user->bookmarkedJobListings()->find($job->id)) {
            $user->bookmarkedJobListings()->detach($job);

            return back()->with('success', 'Bookmarked job successfully removed');
        }

        return back()->with('error', 'You have not bookmarked this job');
    }
}
