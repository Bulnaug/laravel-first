@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">Аналитика</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">Всего сделок</div>
            <div class="text-2xl font-bold">{{ $totalDeals }}</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">Общая сумма</div>
            <div class="text-2xl font-bold">${{ $totalAmount }}</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">Выиграно</div>
            <div class="text-2xl font-bold text-green-600">${{ $wonAmount }}</div>
        </div>

        <div class="bg-white p-4 rounded-xl">
            <div class="text-gray-500 text-sm">В процессе</div>
            <div class="text-2xl font-bold text-blue-600">${{ $pipelineAmount }}</div>
        </div>

    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">Сделки по статусам</h2>

        @foreach($dealsByStatus as $row)
            <div class="flex justify-between border-b py-2">
                <div>{{ $row->status }}</div>
                <div>{{ $row->count }} шт. — ${{ $row->total }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">Топ клиенты</h2>

        @foreach($topContacts as $contact)
            <div class="flex justify-between border-b py-2">
                <div>{{ $contact->name }}</div>
                <div>${{ $contact->deals_sum_amount ?? 0 }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">Сделки по статусам (график)</h2>

        <canvas id="statusChart"></canvas>
    </div>
    <div class="bg-white p-4 rounded-xl mb-6">
        <h2 class="font-bold mb-4">Распределение денег по статусам</h2>

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
            labels: @json($dealsByStatus->pluck('status')),
            datasets: [{
                label: 'Колличество сделок',
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
            labels: @json($dealsByStatus->pluck('status')),
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