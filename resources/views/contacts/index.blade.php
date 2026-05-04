<h1>Клиенты</h1>

<a href="/contacts/create">Добавить клиента</a>

<ul>
@foreach($contacts as $contact)
    <li>{{ $contact->name }} ({{ $contact->email }})</li>
@endforeach
</ul>