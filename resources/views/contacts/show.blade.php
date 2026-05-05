@extends('layouts.app')

@section('content')

@php
    $activeDeal = request('deal');

    $colors = [
        'new' => 'bg-gray-100 text-gray-700',
        'in_progress' => 'bg-blue-100 text-blue-700',
        'won' => 'bg-green-100 text-green-700',
        'lost' => 'bg-red-100 text-red-700',
    ];
@endphp

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $contact->name }}</h1>

        <div class="text-gray-500 space-y-1 text-sm">
            <p><span class="font-medium text-gray-700">Email:</span> {{ $contact->email ?? '—' }}</p>
            <p><span class="font-medium text-gray-700">Телефон:</span> {{ $contact->phone ?? '—' }}</p>
        </div>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('contacts.edit', $contact->id) }}"
               class="bg-yellow-400 px-4 py-2 rounded-lg hover:bg-yellow-500 transition text-sm font-medium">
               ✏️ Редактировать
            </a>

            <a href="{{ route('contacts.index') }}"
               class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
               ← Назад
            </a>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3 text-white">Сделки</h2>

        @foreach($contact->deals as $deal)
            <div class="bg-white border rounded-xl p-4 mb-3 transition hover:shadow
                {{ $activeDeal == $deal->id ? 'ring-2 ring-yellow-400' : '' }}">

                <div class="flex justify-between items-center">

                    <div>
                        <div class="font-semibold text-gray-900">
                            {{ $deal->title }}
                        </div>

                        <div class="text-sm text-gray-500">
                            ${{ $deal->amount }}
                        </div>

                        <span class="inline-block mt-1 px-2 py-1 text-xs rounded
                            {{ $colors[$deal->status] ?? 'bg-gray-100' }}">
                            {{ $deal->status }}
                        </span>
                    </div>

                    <form method="POST" action="{{ route('deals.updateStatus', $deal->id) }}">
                        @csrf

                        <select name="status"
                                onchange="this.form.submit()"
                                class="border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                            
                            @foreach(\App\Models\Deal::STATUSES as $status)
                                <option value="{{ $status }}"
                                    {{ $deal->status === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach

                        </select>
                    </form>

                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Добавить сделку</h3>

        <form method="POST"
              action="{{ route('deals.store', $contact->id) }}"
              class="space-y-3">
            @csrf

            <input 
                name="title" 
                placeholder="Название сделки"
                class="border border-gray-300 p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required
            >

            <input 
                name="amount" 
                placeholder="Сумма"
                class="border border-gray-300 p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >

            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition font-medium">
                Добавить
            </button>
        </form>
    </div>

</div>

@endsection