<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WidgetRequest;

class WidgetController extends Controller
{
    public function index()
    {
        return view('widget');
    }

    public function send(WidgetRequest $request)
    {
        $data = $request->validated();       

        return back()->with('success', 'Спасибо! Ваше сообщение отправлено.');
    }
}

