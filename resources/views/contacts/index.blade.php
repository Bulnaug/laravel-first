@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Клиенты</h1>

        <a href="{{ route('contacts.create') }}"
          class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition shadow-sm">
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
            
            <select name="has_deals"
                    class="border border-gray-300 rounded-lg p-2"
                    onchange="this.form.submit()">

                <option value="">Все</option>

                <option value="yes" {{ request('has_deals') === 'yes' ? 'selected' : '' }}>
                    Есть сделки
                </option>

                <option value="no" {{ request('has_deals') === 'no' ? 'selected' : '' }}>
                    Без сделок
                </option>

            </select>

            <button class="btn btn-gray">
                Найти
            </button>
            @if(request('search') || request('has_deals'))
                <a href="{{ route('contacts.index') }}"
                class="btn btn-red">
                    Сброс
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        @if($contacts->isEmpty())

            <div class="p-10 text-center text-gray-400">
                <div class="text-3xl mb-2">👤</div>
                <div class="text-sm">Нет клиентов</div>
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
                        <tr class="border-t hover:bg-gray-50 transition duration-150">

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

                                    <button class="btn btn-red"
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
<div class="mt-6 flex justify-center">
    {{ $contacts->links() }}
</div>
</div>


@endsection