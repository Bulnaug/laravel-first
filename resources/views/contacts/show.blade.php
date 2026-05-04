@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">{{ $contact->name }}</h1>

<div class="space-y-2">
    <p><strong>Email:</strong> {{ $contact->email ?? '—' }}</p>
    <p><strong>Телефон:</strong> {{ $contact->phone ?? '—' }}</p>
</div>

<div class="mt-6 space-x-2">
    <a href="/contacts/{{ $contact->id }}/edit"
       class="bg-yellow-400 px-4 py-2 rounded">
       ✏️ Редактировать
    </a>

    <a href="/contacts"
       class="bg-gray-300 px-4 py-2 rounded">
       ← Назад
    </a>
</div>

<h2 class="mt-6 font-bold">Сделки</h2>

<ul>
@foreach($contact->deals as $deal)
    <li>{{ $deal->title }} — ${{ $deal->amount }}</li>
@endforeach
</ul>

<form method="POST" action="/contacts/{{ $contact->id }}/deals">
    @csrf
    <input name="title" placeholder="Название сделки">
    <input name="amount" placeholder="Сумма">
    <button>Добавить</button>
</form>

@endsection