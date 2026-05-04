@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Канбан сделок</h1>

<div class="grid grid-cols-4 gap-4">

    @foreach(\App\Models\Deal::STATUSES as $status)
        <div class="bg-gray-100 rounded p-3">

            <h2 class="font-bold mb-3 uppercase">
                {{ $status }}
            </h2>

            @foreach($grouped[$status] ?? [] as $deal)
                <div class="bg-white p-3 mb-2 rounded shadow">

                    <div class="font-semibold">
                        {{ $deal->title }}
                    </div>

                    <div class="text-sm text-gray-500">
                        ${{ $deal->amount }}
                    </div>

                    <div class="text-xs mt-1">
                        {{ $deal->contact->name }}
                    </div>

                    {{-- смена статуса --}}
                    <form method="POST" action="/deals/{{ $deal->id }}/status">
                        @csrf
                        <select name="status"
                                onchange="this.form.submit()"
                                class="mt-2 w-full border rounded text-sm">

                            @foreach(\App\Models\Deal::STATUSES as $s)
                                <option value="{{ $s }}"
                                    {{ $deal->status === $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach

                        </select>
                    </form>

                </div>
            @endforeach

        </div>
    @endforeach

</div>

@endsection