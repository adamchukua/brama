<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sections = Section::all();
        $goods = Good::selectRaw('goods.id, goods.title, goods.price, count(reviews.id) number')
            ->join('reviews', 'reviews.good_id', 'goods.id')
            ->whereRaw('datediff(month, getdate(), goods.created_at) = 0')
            ->groupByRaw('goods.id, goods.title, goods.price')
            ->orderBy('number', 'desc')->take(12)->get();

        return view('home', compact('sections', 'goods'));
    }
}
