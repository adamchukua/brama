<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Image;
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
            return view('admin.goods.index', compact('goods', 'request_all'));
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

    public function edit(Good $good)
    {
        $this->authorize('update', $good);

        return view('goods.edit', compact('good'));
    }

    public function update(Good $good)
    {
        $this->authorize('update', $good);

        $data = request()->validate([
            'title' => ['string', 'min:5', 'max:250'],
            'description' => ['string', 'max:1000'],
            'price' => ['numeric', 'min:0', 'not_in:0'],
            'section_id' => ['number'],
            'seller_id' => ['number'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'mimes:jpg,jpeg,png,bmp', 'max:5120'],
        ]);

        if (request('images')) {
            $good->images->each->delete();

            foreach(request('images') as $image)
            {
                $imagePath = $image->store('images/' . $good->id, 'public');

                Image::create([
                    'good_id' => $good->id,
                    'path' => $imagePath,
                ]);
            }
        }

        $good->update($data);
    }
}
