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

        $characteristics = $good->characteristics()->paginate(10);

        return view('admin.characteristics.index', compact('good', 'characteristics'));
    }

    public function edit(Good $good, Characteristic $characteristic)
    {
        $this->authorize('update', $characteristic);

        $characteristic_edit = $characteristic;

        return view('admin.characteristics.edit', compact('good',
            'characteristic_edit'));
    }

    public function update(Characteristic $characteristic)
    {
        $this->authorize('update', $characteristic);

        $data = request()->validate([
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'value' => ['required', 'string', 'min:2', 'max:100']
        ]);

        $characteristic->update($data);

        return redirect('/good/' . $characteristic->good->id . '/characteristics');
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
