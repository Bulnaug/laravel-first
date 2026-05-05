@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <h1 class="text-2xl text-white font-bold mb-6">Редактировать клиента</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Имя
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $contact->name }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ $contact->email }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Телефон
                </label>
                <input 
                    type="text" 
                    name="phone" 
                    value="{{ $contact->phone }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('contacts.show', $contact->id) }}"
                   class="text-sm text-gray-500 hover:underline">
                    ← Назад
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Обновить
                </button>

            </div>

        </form>

    </div>

</div>

@endsection