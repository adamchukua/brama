<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use App\Models\Good;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    public function index(Good $good)
    {
        $this->authorize('viewAny', Characteristic::class);

        return view('admin.characteristics.index', compact('good'));
    }

    public function edit(Good $good, Characteristic $characteristic)
    {
        //$this->authorize('update', $characteristic);

        return view('admin.characteristics.edit', compact('good',
            'characteristic'));
    }

    public function update(Good $good)
    {
        //$this->authorize('update');


    }

    public function store(Good $good)
    {
        $this->authorize('create', Characteristic::class);

        $data = request()->validate([
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'value' => ['required', 'string', 'min:2', 'max:100']
        ]);

        $good->characteristics()->create($data);

        return redirect()->back();
    }

    public function delete(Characteristic $characteristic)
    {
        $this->authorize('delete', $characteristic);

        $characteristic->delete();

        return redirect()->back();
    }
}
