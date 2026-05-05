@extends('layouts.app')

@section('content')
    <div class="p-6">

        <h1 class="text-2xl text-white font-bold mb-6">{{ __('analytics.title') }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">{{ __('contacts.title') }}</div>
                <div class="text-2xl font-bold">{{ $contactsCount }}</div>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">{{ __('deals.title') }}</div>
                <div class="text-2xl font-bold">{{ $dealsCount }}</div>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">{{ __('deals.stats.won') }}</div>
                <div class="text-2xl font-bold text-green-600">
                    ${{ $wonAmount }}
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">{{ __('deals.stats.pipeline') }}</div>
                <div class="text-2xl font-bold text-blue-600">
                    ${{ $pipelineAmount }}
                </div>
            </div>

        </div>

        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('analytics.latest_deals') }}</h2>

            @foreach($latestDeals as $deal)
                <div class="border-t py-2 flex justify-between hover:bg-gray-50 transition">
                    <div>
                        <a href="{{ route('contacts.show', $deal->contact_id) }}?deal={{ $deal->id }}"
                        class="font-semibold text-blue-600 hover:underline">
                            {{ $deal->title }}
                        </a>
                        <div class="text-sm text-gray-500">
                            {{ $deal->contact->name ?? '-' }}
                        </div>
                    </div>

                    <div class="text-right">
                        <div>${{ $deal->amount }}</div>
                        <div class="text-xs text-gray-500">
                            {{ __('deals.statuses.' . $deal->status) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">{{ __('analytics.latest_contacts') }}</h2>

            @foreach($latestContacts as $contact)
                <div class="border-t py-2">
                    <a href="{{ route('contacts.show', $contact->id) }}"
                    class="text-blue-600 hover:underline">
                        {{ $contact->name }}
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection