<div>
    <h3 style="text-align: center">Форма обратной связи</h3>
    <div>
        Тема: {{ $data['subject'] }}
    </div>
    <div>
        Имя: {{ $data['name'] }}</div>
    <div>
        Почта: {{ $data['email'] }}
    </div>
    <div>
        Номер: {{ $data['tel']}}
    </div>
    <br>
    <div>
        {{ $data['text'] }}
    </div>
</div>