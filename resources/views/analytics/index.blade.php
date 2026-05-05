@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">{{ __('analytics.title') }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">{{ __('analytics.stats.total') }}</div>
            <div class="text-2xl font-bold">{{ $totalDeals }}</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">{{ __('analytics.stats.amount') }}</div>
            <div class="text-2xl font-bold">${{ number_format($totalAmount, 0, ',', ' ') }} $</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">{{ __('deals.stats.won') }}</div>
            <div class="text-2xl font-bold text-green-600">${{ $wonAmount }}</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">{{ __('deals.stats.pipeline') }}</div>
            <div class="text-2xl font-bold text-blue-600">${{ $pipelineAmount }}</div>
        </div>

    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">{{ __('analytics.by_status') }}</h2>

        @foreach($dealsByStatus as $row)
            <div class="flex justify-between border-b py-2">
                <div>{{ __('deals.statuses.' . $row->status) }}</div>
                <div>{{ $row->count }} {{ __('analytics.units') }} — ${{ $row->total }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">{{ __('analytics.top_contacts') }}</h2>

        @foreach($topContacts as $contact)
            <div class="flex justify-between border-b py-2">
                <div>{{ $contact->name }}</div>
                <div>${{ $contact->deals_sum_amount ?? 0 }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">{{ __('analytics.charts.status') }}</h2>

        <canvas id="statusChart"></canvas>
    </div>
    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">{{ __('analytics.charts.money') }}</h2>

        <canvas id="moneyPieChart"></canvas>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('statusChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(
                $dealsByStatus->pluck('status')->map(fn($s) => __('deals.statuses.' . $s))
            ),
            datasets: [{
                label: '{{ __("analytics.charts.count") }}',
                data: @json($dealsByStatus->pluck('count')),
                backgroundColor: [
                    '#9ca3af', // new
                    '#3b82f6', // in_progress
                    '#22c55e', // won
                    '#ef4444'  // lost
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

});
document.addEventListener('DOMContentLoaded', function () {

    const ctxPie = document.getElementById('moneyPieChart');

    if (!ctxPie) return;

    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: @json(
                $dealsByStatus->pluck('status')->map(fn($s) => __('deals.statuses.' . $s))
            ),
            datasets: [{
                data: @json($dealsByStatus->pluck('total')),
                backgroundColor: [
                    '#9ca3af', // new
                    '#3b82f6', // in_progress
                    '#22c55e', // won
                    '#ef4444'  // lost
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

});
</script>
@endsection