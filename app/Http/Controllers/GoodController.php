<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function show(Good $good)
    {
        return view('goods.show', compact('good'));
    }
}
