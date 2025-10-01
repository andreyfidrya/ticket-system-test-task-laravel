<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WidgetRequest extends FormRequest
{
    // Разрешаем выполнение запроса
    public function authorize(): bool
    {
        return true; // можно добавить авторизацию, если нужно
    }

    // Правила валидации
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'topic'   => 'required|string|max:200',
            'phone'   => [
                'required',
                'regex:/^\+?[1-9]\d{1,14}$/' // формат E.164
            ],
            'text' => 'required|string|max:500',
        ];
    }

    // Кастомные сообщения ошибок
    public function messages(): array
    {
        return [
            'name.required'    => 'Введите имя',
            'email.required'   => 'Укажите email',
            'email.email'      => 'Неверный формат email',
            'topic.required'    => 'Введите тему',
            'phone.required'    => 'Введите номер телефона',
            'phone.regex'      => 'Телефон должен быть в международном формате, например: +380671234567',
            'text.required' => 'Введите сообщение',
        ];
    }
}

