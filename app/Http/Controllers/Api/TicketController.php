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
        
        $customerByEmail = Customer::where('email', $data['email'])->first();
        if ($customerByEmail) {
            if ($customerByEmail->phone !== $data['phone'] || $customerByEmail->name !== $data['name']) {
                return response()->json([
                    'errors' => [
                        'customer' => ['Клиент с таким email уже существует, но имя или телефон не совпадают.']
                    ]
                ], 422);
            }
            $customer = $customerByEmail;
        } else {            
            $customerByPhone = Customer::where('phone', $data['phone'])->first();
            if ($customerByPhone) {
                if ($customerByPhone->email !== $data['email'] || $customerByPhone->name !== $data['name']) {
                    return response()->json([
                        'errors' => [
                            'customer' => ['Клиент с таким телефоном уже существует, но имя или email не совпадают.']
                        ]
                    ], 422);
                }
                $customer = $customerByPhone;
            } else {                
                $customer = Customer::create([
                    'name'  => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                ]);
            }
        }
        
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

        return response()->json([
            'success' => true,
            'message' => 'Тикет создан успешно',
        ]);
    }
}
