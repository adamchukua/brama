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

        return redirect()->back();
    }

    public function show(User $user)
    {
        $reviews = $user->reviews()->paginate(10);

        return view('reviews.show', compact('user', 'reviews'));
    }

    public function edit(Review $review)
    {
        $this->authorize('update', $review);

        return view('reviews.edit', compact('review'));
    }

    public function update(Review $review)
    {
        $this->authorize('update', $review);

        $data = request()->validate([
            'text' => ['string', 'min:10', 'max:2000']
        ]);

        $review->update($data);

        return redirect('/user/' . $review->user->id . '/reviews');
    }

    public function index()
    {
        $reviews = Review::paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }
}
