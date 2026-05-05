@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Клиенты</h1>

        <a href="{{ route('contacts.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            + Добавить
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('contacts.index') }}" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Поиск по имени или email..."
                   class="flex-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition">
                Найти
            </button>
        </form>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        @if($contacts->isEmpty())
            <div class="p-6 text-center text-gray-500">
                Ничего не найдено
            </div>
        @else

            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left font-medium">Имя</th>
                        <th class="p-3 text-left font-medium">Email</th>
                        <th class="p-3 text-right font-medium">Действия</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="p-3">
                                <a href="{{ route('contacts.show', $contact->id) }}"
                                   class="text-gray-900 font-medium hover:underline">
                                    {{ $contact->name }}
                                </a>
                            </td>

                            <td class="p-3 text-gray-500">
                                {{ $contact->email }}
                            </td>

                            <td class="p-3 text-right space-x-2">

                                <a href="{{ route('contacts.edit', $contact->id) }}"
                                   class="inline-block bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg text-sm">
                                    ✏️
                                </a>

                                <form method="POST"
                                      action="{{ route('contacts.destroy', $contact->id) }}"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm"
                                            onclick="return confirm('Удалить?')">
                                        🗑
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

    </div>

</div>

@endsection