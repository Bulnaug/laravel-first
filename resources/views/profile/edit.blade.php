@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">
        {{ __('app.profile') }}
    </h1>

    <div class="bg-white rounded-xl shadow p-6 space-y-6">

        <div>
            <h2 class="text-sm text-gray-500 mb-2">{{ __('app.user') }}</h2>

            <div class="text-lg font-medium">
                {{ auth()->user()->name }}
            </div>

            <div class="text-sm text-gray-500">
                {{ auth()->user()->email }}
            </div>
        </div>

        <div>
            <h2 class="text-sm text-gray-500 mb-2">{{ __('app.language') }}</h2>

            <div class="flex gap-2">

                <a href="{{ route('lang.switch', 'ru') }}"
                   class="btn btn-secondary {{ app()->getLocale() === 'ru' ? 'ring-2 ring-blue-500' : '' }}">
                    🇷🇺 {{ __('app.lang_ru') }}
                </a>

                <a href="{{ route('lang.switch', 'en') }}"
                   class="btn btn-secondary {{ app()->getLocale() === 'en' ? 'ring-2 ring-blue-500' : '' }}">
                    🇬🇧 {{ __('app.lang_en') }}
                </a>

                <a href="{{ route('lang.switch', 'de') }}"
                   class="btn btn-secondary {{ app()->getLocale() === 'de' ? 'ring-2 ring-blue-500' : '' }}">
                    🇩🇪 {{ __('app.lang_de') }}
                </a>

            </div>

            <div class="text-xs text-gray-400 mt-2">
                {{ __('app.current') }}: {{ strtoupper(app()->getLocale()) }}
            </div>
        </div>

    </div>

</div>

@endsection