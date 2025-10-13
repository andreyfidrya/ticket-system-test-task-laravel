<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Customer;

class TicketFormTest extends TestCase
{
    public function test_ticket_form_creates_ticket()
    {
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->postJson('/api/tickets', [
            'name'  => 'Канарей',
            'email' => 'kanarey@example.com',
            'phone' => '+380999999991',
            'topic' => 'Проверка тикета',
            'text'  => 'Тестовое сообщение',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Тикет создан успешно',
        ]);

        $this->assertDatabaseHas('customers', [
            'email' => 'andrey@example.com',
        ]);

        $this->assertDatabaseHas('tickets', [
            'topic' => 'Проверка тикета',
        ]);
    }
}
