<h1>Клиенты</h1>

<a href="/contacts/create">Добавить клиента</a>

<ul>
@foreach($contacts as $contact)
    <li>
        {{ $contact->name }} ({{ $contact->email }})
        <a href="/contacts/{{ $contact->id }}/edit">Редактировать</a>
        <form method="POST" action="/contacts/{{ $contact->id }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Удалить клиента?')">
                Удалить
            </button>
        </form>
    </li>
@endforeach
</ul>