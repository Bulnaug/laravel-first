@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <h1 class="text-2xl text-white font-bold mb-6">Добавить клиента</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <form method="POST" action="{{ route('contacts.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Имя
                </label>
                <input 
                    type="text" 
                    name="name" 
                    placeholder="Введите имя"
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
                    placeholder="example@mail.com"
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
                    placeholder="+49..."
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('contacts.index') }}"
                   class="text-sm text-gray-500 hover:underline">
                    ← Назад
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Сохранить
                </button>

            </div>

        </form>

    </div>

</div>

@endsection