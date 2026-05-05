@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <h1 class="text-2xl text-white font-bold mb-6">{{ __('contacts.edit_client') }}</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('contacts.name') }}
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $contact->name }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('contacts.email') }}
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ $contact->email }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('contacts.phone') }}
                </label>
                <input 
                    type="text" 
                    name="phone" 
                    value="{{ $contact->phone }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('contacts.show', $contact->id) }}"
                   class="btn btn-red">
                    ← {{ __('app.back') }}
                </a>

                <button class="btn btn-blue">
                    {{ __('app.update') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection