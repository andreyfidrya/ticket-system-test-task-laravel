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

    // Обратите внимание: принимаем Request $request
    public function index(Request $request)
    {
        $username = Auth::user()->name;

        // Инициализируем $query заранее — это важно
        $query = Ticket::with(['customer', 'media']);

        // Фильтрация по email клиента
        if ($request->filled('email')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        // Фильтрация по телефону
        if ($request->filled('phone')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('phone', 'like', '%' . $request->phone . '%');
            });
        }

        // Фильтрация по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Фильтрация по диапазону дат
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Выполняем запрос — если фильтров нет, вернёт все тикеты (как раньше)
        $tickets = $query->latest()->get();

        return view('admin.index', compact('username', 'tickets'));
    }
}
