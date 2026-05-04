<h1>Клиенты</h1>

<a href="/contacts/create">Добавить клиента</a>

<ul>
@foreach($contacts as $contact)
    <li>
        {{ $contact->name }} ({{ $contact->email }})
        <a href="/contacts/{{ $contact->id }}/edit">Редактировать</a>
    </li>
@endforeach
</ul>