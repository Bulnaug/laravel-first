@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Редактировать клиента</h1>

<form method="POST" action="/contacts/{{ $contact->id }}" class="space-y-4">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $contact->name }}"
           class="w-full border p-2 rounded">

    <input type="email" name="email" value="{{ $contact->email }}"
           class="w-full border p-2 rounded">

    <input type="text" name="phone" value="{{ $contact->phone }}"
           class="w-full border p-2 rounded">

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Обновить
    </button>
</form>

@endsection