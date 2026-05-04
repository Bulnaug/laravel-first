@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Клиенты</h1>

<a href="/contacts/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
    + Добавить клиента
</a>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Имя</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2">Действия</th>
        </tr>
    </thead>
    <tbody>
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