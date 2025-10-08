<x-layouts.porto title="Tickets" header="Tickets" username={{$username}}>    
    
    <form method="GET" action="{{ route('admin.index') }}" class="mb-4 d-flex flex-wrap align-items-end gap-3">
        <div>
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" value="{{ request('email') }}" class="form-control" placeholder="Введите email">
        </div>

        <div>
            <label for="phone" class="form-label">Телефон:</label>
            <input type="text" name="phone" id="phone" value="{{ request('phone') }}" class="form-control" placeholder="Введите телефон">
        </div>

        <div>
            <label for="status" class="form-label">Статус:</label>
            <select name="status" id="status" class="form-select">
                <option value="">Все</option>
                <option value="новый" {{ request('status') == 'новый' ? 'selected' : '' }}>Новый</option>
                <option value="в работе" {{ request('status') == 'в работе' ? 'selected' : '' }}>В работе</option>
                <option value="обработан" {{ request('status') == 'обработан' ? 'selected' : '' }}>Обработан</option>
            </select>
        </div>

        <div>
            <label class="form-label">Дата с:</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
        </div>

        <div>
            <label class="form-label">Дата по:</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Фильтровать</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Сброс</a>
        </div>
    </form>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Имя Клиента</th>
                <th scope="col">Телефон</th>
                <th scope="col">Эмейл</th>                	
                <th scope="col">Тема</th>
                <th scope="col">Текст</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата ответа</th>
                <th scope="col">Файлы</th>
                <th scope="col">Изменить статус</th>           
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->customer->phone }}</td>
                <td>{{ $ticket->customer->email }}</td>
                <td>{{ $ticket->topic }}</td>
                <td>{{ $ticket->text }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->response_date }}</td>
                <td>
                    @foreach($ticket->getMedia('attachments') as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" download>
                            {{ $media->file_name }}
                        </a><br>
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select" style="width: 140px;" onchange="this.form.submit()">
                            <option value="новый" {{ $ticket->status == 'новый' ? 'selected' : '' }}>Новый</option>
                            <option value="в работе" {{ $ticket->status == 'в работе' ? 'selected' : '' }}>В работе</option>
                            <option value="обработан" {{ $ticket->status == 'обработан' ? 'selected' : '' }}>Обработан</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.porto>