<x-layouts.porto title="Tickets" header="Tickets" username={{$username}}>    
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