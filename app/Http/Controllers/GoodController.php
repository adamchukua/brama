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
        if ($request->path() == 'admin' &&
            auth()->user() == null ||
            $request->path() == 'admin' &&
            auth()->user()->is_admin == 0)
        {
            abort(403);
        }

        $request_all = http_build_query($request->all());

        $goods = Good::selectRaw('goods.title, goods.price, goods.id, goods.quantity, goods.created_at, goods.updated_at')
            ->join('sections', 'sections.id', '=', 'goods.section_id');

        if ($request['search']) {
            $goods = $goods->where('goods.title', 'LIKE', "%{$request['search']}%")
                ->orWhere('goods.description', 'LIKE', "%{$request['search']}%")
                ->orWhere('sections.title', 'LIKE', "%{$request['search']}%");
        }

        if ($request['seller'] == 'brama') {
            $goods = $goods->where('goods.seller_id', '=', '1');
        } else if ($request['seller'] == 'other') {
            $goods = $goods->where('goods.seller_id', '!=', '1');
        }

        $goods = $goods->get();

        if ($request->path() == 'admin')
        {
            return view('admin.index', compact('goods', 'request_all'));
        }
        else {
            return view('goods.index', compact('goods', 'request_all'));
        }
    }

    public function delete(Good $good)
    {
        $this->authorize('delete', $good);

        $good->delete();

        return redirect()->back();
    }
}
