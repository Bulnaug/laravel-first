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

@foreach($contact->deals as $deal)
<div class="border p-3 mb-2 rounded">

    <div class="flex justify-between items-center">
        <div>
            <strong>{{ $deal->title }}</strong>
            <div class="text-sm text-gray-500">
                ${{ $deal->amount }}
            </div>
            <div class="
                text-sm font-bold
                @if($deal->status === 'new') text-gray-500 @endif
                @if($deal->status === 'in_progress') text-blue-500 @endif
                @if($deal->status === 'won') text-green-500 @endif
                @if($deal->status === 'lost') text-red-500 @endif
            ">
                {{ $deal->status }}
            </div>
        </div>

        <form method="POST" action="/deals/{{ $deal->id }}/status">
            @csrf

            <select name="status" onchange="this.form.submit()"
                    class="border p-1 rounded">

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

@endsection