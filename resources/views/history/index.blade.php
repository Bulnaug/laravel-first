@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">История действий</h1>

    <div class="bg-white rounded-xl shadow">

        @forelse($activities as $activity)
            <div class="p-4 border-b text-sm flex justify-between">
                <div>{{ $activity->description }}</div>
                <div class="text-gray-400">
                    {{ $activity->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="p-4 text-gray-500">
                Нет действий
            </div>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $activities->links() }}
    </div>

</div>

@endsection