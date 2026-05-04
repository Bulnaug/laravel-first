@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Добавить клиента</h1>

<form method="POST" action="/contacts" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Имя"
           class="w-full border p-2 rounded">

    <input type="email" name="email" placeholder="Email"
           class="w-full border p-2 rounded">

    <input type="text" name="phone" placeholder="Телефон"
           class="w-full border p-2 rounded">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Сохранить
    </button>
</form>

@endsection