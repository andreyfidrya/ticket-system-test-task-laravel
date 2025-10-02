<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WidgetRequest;
use App\Models\Customer;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function store(WidgetRequest $request)
    {
        $data = $request->validated();
        
        $customer = Customer::firstOrCreate(
            ['email' => $data['email']],
            [
                'name'  => $data['name'],
                'phone' => $data['phone'],
            ]
        );
        
        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'topic'       => $data['topic'],
            'text'        => $data['text'],
            'status'      => 'новый',
        ]);

        if ($request->hasFile('attachment')) {
            $ticket
                ->addMedia($request->file('attachment'))
                ->toMediaCollection('attachments');
        }

        return response()->json([]);
    }
}
