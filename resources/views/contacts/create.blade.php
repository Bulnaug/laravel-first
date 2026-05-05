@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <h1 class="text-2xl text-white font-bold mb-6">{{ __('contacts.add') }}</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <form method="POST" action="{{ route('contacts.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('contacts.name') }}
                </label>
                <input 
                    type="text" 
                    name="name" 
                    placeholder="{{ __('app.enter_name') }}"
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
                    placeholder="example@mail.com"
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
                    placeholder="+49..."
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('contacts.index') }}"
                   class="text-sm text-gray-500 hover:underline">
                    ← {{ __('app.back') }}
                </a>

                <button class="btn btn-blue">
                    {{ __('app.save') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection