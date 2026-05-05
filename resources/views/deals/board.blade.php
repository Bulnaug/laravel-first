@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">Канбан сделок</h1>
    
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('deals.board') }}" class="flex gap-2 items-center flex-wrap">

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Поиск сделки..."
                class="flex-1 border border-gray-300 rounded-lg p-2">

            <select name="contact_id"
                    class="border border-gray-300 rounded-lg p-2"
                    onchange="this.form.submit()">

                <option value="">Все клиенты</option>

                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}"
                        {{ request('contact_id') == $contact->id ? 'selected' : '' }}>
                        {{ $contact->name }}
                    </option>
                @endforeach

            </select>

            <!-- 💰 фильтр суммы -->
            <input type="number"
                name="min_amount"
                value="{{ request('min_amount') }}"
                placeholder="Мин $"
                class="w-28 border border-gray-300 rounded-lg p-2">

            <input type="number"
                name="max_amount"
                value="{{ request('max_amount') }}"
                placeholder="Макс $"
                class="w-28 border border-gray-300 rounded-lg p-2">

            <button class="btn btn-gray">
                Найти
            </button>

            @if(request()->hasAny(['search','contact_id','min_amount','max_amount']))
                <a href="{{ route('deals.board') }}"
                class="btn btn-red">
                    Сброс
                </a>
            @endif

        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

        @foreach(\App\Models\Deal::STATUSES as $status)

            <div class="kanban-column bg-gray-50 border border-gray-200 rounded-xl p-4 transition"
                data-status="{{ $status }}">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-sm font-semibold text-gray-600 uppercase">
                        {{ str_replace('_', ' ', $status) }}
                    </h2>

                    <span class="text-xs text-gray-400">
                        {{ count($grouped[$status] ?? []) }}
                    </span>
                </div>

                <div class="space-y-3">

                    @foreach($grouped[$status] ?? [] as $deal)

                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm 
                                    hover:shadow-md hover:-translate-y-0.5 hover:scale-[1.01]
                                    transition duration-200 ease-in-out cursor-move"
                        draggable="true"
                        data-id="{{ $deal->id }}">

                            <div class="font-semibold text-gray-900">
                                {{ $deal->title }}
                            </div>

                            <div class="text-sm text-gray-500 mt-1">
                                ${{ $deal->amount }}
                            </div>

                            <div class="text-xs text-gray-400 mt-1">
                                {{ $deal->contact->name }}
                            </div>

                            <form method="POST"
                                  action="{{ route('deals.updateStatus', $deal->id) }}"
                                  class="mt-3">
                                @csrf

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="w-full border border-gray-300 rounded-lg text-sm p-1 focus:ring-2 focus:ring-blue-500">

                                    @foreach(\App\Models\Deal::STATUSES as $s)
                                        <option value="{{ $s }}"
                                            {{ $deal->status === $s ? 'selected' : '' }}>
                                            {{ str_replace('_', ' ', $s) }}
                                        </option>
                                    @endforeach

                                </select>
                            </form>

                        </div>

                    @endforeach

                    @if(empty($grouped[$status]))
                        <div class="empty-text text-sm text-gray-400 text-center py-6">
                            Нет сделок
                        </div>
                    @endif

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection