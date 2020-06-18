<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function store(LabelRequest $request)
    {
        $data = $request->validated();

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

    public function update(LabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash('Task was updated!')->success();

        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label) {
            try {
                $label->delete();
            } catch (\Illuminate\Database\QueryException  $e) {
                Log::info($e->getMessage());
                flash('This label can’t be deleted. It is used in other tasks!')->error();
                return back();
            }
        }

        flash('Task was deleted!')->success();

        return redirect()->route('labels.index');
    }
}
