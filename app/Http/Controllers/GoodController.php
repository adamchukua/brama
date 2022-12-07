<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class GoodController extends Controller
{
    public function show($id)
    {
        $good = Good::findOrFail(intval($id));

        return view('goods.show', compact('good'));
    }

    public function index(Request $request)
    {
        if ($request['search']) {
            $goods = Good::where('title', 'LIKE', "%{$request['search']}%")
                ->orWhere('description', 'LIKE', "%{$request['search']}%")->get();
                //->orWhere('sections.title', 'LIKE', "%{$request['search']}%")->get();

            $goods = Good::selectRaw('goods.title, goods.price, goods.id')
                ->join('sections', 'sections.id', '=', 'goods.section_id')
                ->where('goods.title', 'LIKE', "%{$request['search']}%")
                ->orWhere('goods.description', 'LIKE', "%{$request['search']}%")
                ->orWhere('sections.title', 'LIKE', "%{$request['search']}%")->get();
        } else {
            $goods = Good::all();
        }

        return view('goods.index', compact('goods'));
    }
}
