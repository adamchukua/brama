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
}
