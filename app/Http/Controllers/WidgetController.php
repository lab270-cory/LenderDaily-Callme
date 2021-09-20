<?php

namespace App\Http\Controllers;

use App\Models\CallWidget;

class WidgetController extends Controller
{
    public function create()
    {
        return view('widgets.create');
    }

    public function edit(CallWidget $callWidget)
    {
        return view('widgets.edit', compact('callWidget'));
    }

    public function destroy(CallWidget $callWidget)
    {
        $callWidget->delete();
        return redirect()->back()->with(SUCCESS, 'Deleted Successfully');
    }
}
