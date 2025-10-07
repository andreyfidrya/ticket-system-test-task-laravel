<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $username = Auth::user()->name;
        $tickets = Ticket::with(['customer', 'media'])->get();
        //dd($tickets);
        return view('admin.index', compact('username', 'tickets'));
    }
}
