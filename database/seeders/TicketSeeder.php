<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'customer_id' => 1,
            'topic' => 'Проблема с оплатой',
            'text' => 'Клиент сообщил, что не прошла оплата через систему.',
            'status' => 'новый',
            'response_date' => NULL,
        ]);

        Ticket::create([
            'customer_id' => 2,
            'topic' => 'Вопрос по доставке',
            'text' => 'Клиент интересуется сроками доставки.',
            'status' => 'в работе',
            'response_date' => Carbon::now()->subDays(2),
        ]);

        Ticket::create([
            'customer_id' => 3,
            'topic' => 'Техническая ошибка',
            'text' => 'Клиент сообщает об ошибке на сайте при входе.',
            'status' => 'обработан',
            'response_date' => Carbon::now()->subDay(),
        ]);
    }
}
