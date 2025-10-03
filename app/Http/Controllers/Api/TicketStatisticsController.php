<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketStatisticsController extends Controller
{
    public function index()
    {
        return response()->json([
            'today'      => Ticket::today()->count(),
            'this_week'  => Ticket::thisWeek()->count(),
            'this_month' => Ticket::thisMonth()->count(),
        ]);
    }
}