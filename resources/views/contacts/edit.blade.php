<h1>Редактировать клиента</h1>

<form method="POST" action="/contacts/{{ $contact->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $contact->name }}"><br>
    <input type="email" name="email" value="{{ $contact->email }}"><br>
    <input type="text" name="phone" value="{{ $contact->phone }}"><br>

    <button type="submit">Обновить</button>
</form>