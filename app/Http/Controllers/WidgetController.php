<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WidgetRequest;

class WidgetController extends Controller
{
    public function index()
    {
        $response = response()->view('widget');

        $response->headers->remove('X-Frame-Options');
        $response->headers->set('X-Frame-Options', 'ALLOWALL');

        $response->headers->set('Content-Security-Policy', "frame-ancestors *");

        return $response;
    }

    public function send(WidgetRequest $request)
    {
        $data = $request->validated();       

        return back()->with('success', 'Спасибо! Ваше сообщение отправлено.');
    }
}

