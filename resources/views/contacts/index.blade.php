@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Клиенты</h1>

<a href="/contacts/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
    + Добавить клиента
</a>

<form method="GET" action="/contacts" class="mb-4">
    <input type="text" name="search"
           placeholder="Поиск..."
           value="{{ request('search') }}"
           class="border p-2 rounded w-1/3">

    <button class="bg-gray-800 text-white px-4 py-2 rounded">
        Найти
    </button>
</form>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Имя</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2">Действия</th>
        </tr>
    </thead>
    <tbody>
        @if($contacts->isEmpty())
                    <p class="text-red-500 my-2">Ничего не найдено</p>
                @endif
        @foreach($contacts as $contact)
        <tr class="border-t">
            <td class="p-2">{{ $contact->name }}</td>
            <td class="p-2">{{ $contact->email }}</td>
            <td class="p-2 space-x-2">

                <a href="/contacts/{{ $contact->id }}/edit"
                   class="bg-yellow-400 px-3 py-1 rounded">
                   ✏️
                </a>

                <form method="POST" action="/contacts/{{ $contact->id }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded"
                            onclick="return confirm('Удалить?')">
                        🗑
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection