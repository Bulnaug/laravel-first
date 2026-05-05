@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">{{ __('activity.title') }}</h1>

    @forelse($activities as $date => $items)

        <div class="text-gray-400 text-sm mb-2 mt-6">
            @php $dateObj = \Carbon\Carbon::parse($date); @endphp

            @if($dateObj->isToday())
                {{ __('activity.today') }}
            @elseif($dateObj->isYesterday())
                {{ __('activity.yesterday') }}
            @else
                {{ $dateObj->translatedFormat('d M Y') }}
            @endif
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            @foreach($items as $activity)
                <div class="p-4 border-b text-sm flex justify-between hover:bg-gray-50 transition">

                    <div class="flex items-center gap-2">

                        @if($activity->type === 'created')
                            <span class="text-green-500">🟢</span>
                        @elseif($activity->type === 'status_changed')
                            <span class="text-blue-500">🔄</span>
                        @elseif($activity->type === 'note_updated')
                            <span class="text-yellow-500">📝</span>
                        @endif

                        <span>
                            {{ str_replace(
                                ['new', 'in_progress', 'won', 'lost'],
                                [
                                    __('deals.statuses.new'),
                                    __('deals.statuses.in_progress'),
                                    __('deals.statuses.won'),
                                    __('deals.statuses.lost'),
                                ],
                                $activity->description
                            ) }}
                        </span>

                    </div>

                    <div class="text-xs text-gray-400">
                        {{ $activity->created_at->format('H:i') }}
                    </div>

                </div>
            @endforeach

        </div>

    @empty
        <div class="text-gray-500">
            {{ __('activity.empty') }}
        </div>
    @endforelse

</div>

@endsection