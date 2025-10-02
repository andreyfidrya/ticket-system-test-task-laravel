<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма обратной связи</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 10px;
        }
        .widget-container {
            max-width: 350px;
            margin: auto;
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h3 {
            margin-top: 0;
            font-size: 18px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 10px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
        }
        input, textarea, button {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        button {
            background: #3498db;
            color: #fff;
            border: none;
            margin-top: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #2980b9;
        }
        .alert {
            font-size: 14px;
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="widget-container">
    <h3>Обратная связь</h3>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{url('/api/tickets')}}" enctype="multipart/form-data"  id="addtickets">
        @csrf
        <div class="content"></div>
        <div class="form-group">
            <label>Имя</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+380671234567">
            @error('phone') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Тема</label>
            <input type="topic" name="topic" value="{{ old('topic') }}">
            @error('topic') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Сообщение</label>
            <textarea name="text" rows="4">{{ old('text') }}</textarea>
            @error('text') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Прикрепить файл</label>
            <input type="file" name="attachment">
            @error('attachment') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

    $(document).ready(function()
        {
            
           $('#addtickets').on('submit', function(event)        
            {

                event.preventDefault();

                jQuery.ajax({

                    url:"{{url('/api/tickets')}}",
                    context: $(".content"),
                    data:jQuery('#addtickets').serialize(),
                    type:'post',
                    
                    success:function(result)
                    {
                        $(".content").text("Сообщение было доставленно успешно. Мы будем работать над Вашей проблемой.");
                        jQuery('#addtickets')[0].reset();
                    }

                })

            });

        }); 

</script>


