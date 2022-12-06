<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Good $good)
    {
        $user = auth()->user();

        $data = request()->validate([
            'text' => ['string', 'max:2000']
        ]);

        $good->reviews()->create(array_merge([
            'name' => $user->name
        ], $data));

        return redirect('/good/' . $good->id);
    }
}
