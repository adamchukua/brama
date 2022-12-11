<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Good $good)
    {
        $user = auth()->user();

        $data = request()->validate([
            'text' => ['string', 'min:10', 'max:2000']
        ]);

        $good->reviews()->create(array_merge([
            'user_id' => $user->id
        ], $data));

        return redirect('/good/' . $good->id);
    }

    public function delete(Review $review)
    {
        $this->authorize('delete', $review);

        $user = $review->user->id;

        $review->delete();

        return redirect('/user/' . $user . '/reviews');
    }

    public function index(User $user)
    {
        return view('reviews.index', compact('user'));
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Review $review)
    {
        $data = request()->validate([
            'text' => ['string', 'min:10', 'max:2000']
        ]);

        $review->update($data);

        return redirect('/user/' . $review->user->id . '/reviews');
    }
}
