<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate();

        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
        ]);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash('Task label was created!')->success();

        return redirect()
            ->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name,' . $label->id,
        ]);

        $label->fill($data);
        $label->save();

        flash('Task was updated!')->success();

        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label) {
            $label->delete();
        }

        flash('Task was deleted!')->success();

        return redirect()->route('labels.index');
    }
}
