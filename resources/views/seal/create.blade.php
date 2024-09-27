@extends('layouts.app')

@section('title', $title)

@section('content')
    <x-section-header :title="$title"/>
    @if(session('is-seal-cancel'))
        @if(!session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ой!</span> {{ session('error-alert-message') }}
                </div>
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Успешно!</span> {{ session('success-alert-message') }}
                </div>
            </div>
        @endif
    @endif
    @if(
        !session('seal-is-saved') && !session('is-seal-cancel')
        ||
        (session('is-seal-cancel') && session('success'))
    )
        <form method="post" action="{{ route('seals.store') }}" class="max-w-sm mx-auto" id="add-seal-form">
            @csrf
            <x-phone-number-input/>
            @if(session('show-name-block'))
                <x-seal.add-guest-block/>
            @endif
            <x-send-form-button :id="'add-seal-form-submit-btn'" :title="'Добавить'"/>
        </form>
    @else
        <div class="saved-info">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Success</span>
                <div>
                    <span class="font-medium">Гость: {{ session('guest-name') }}</span><br/>Запомнили 🤓
                </div>
            </div>
            <p class="mt-10 mb-5 text-2xl text-white w-full text-center">Не забудь сказать гостю, что это его {{ session('seals-count') }}-я печать 💫</p>
            <div class="buttons w-full flex justify-center pt-10">
                <a class="
                    transition
                    ease-in-out
                    duration-500
                    h-10
                    focus:outline-none
                    text-white
                    bg-red-950
                    hover:bg-red-800
                    focus:ring-4
                    focus:ring-red-300
                    font-medium
                    rounded-lg
                    text-sm
                    px-5
                    py-2.5
                    me-2
                    mb-2
                    dark:bg-red-900
                    dark:hover:bg-red-700
                    dark:focus:ring-red-900"
                    href="{{ route('seals.create') }}"
                >Отлично!</a>
                <form method="post" action="{{ route('seals.destroy', session('seal-id') ?? 0) }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="sealId" value="{{ session('seal-id') ?? 0 }}">
                    <input type="hidden" name="pastSealsCount" value="{{ session('past-seals-count') ?? 0 }}">
                    <button type="submit" class="
                    transition
                    ease-in-out
                    duration-500
                    h-10
                    focus:outline-none
                    text-white
                    bg-red-950
                    hover:bg-red-800
                    focus:ring-4
                    focus:ring-red-300
                    font-medium
                    rounded-lg
                    text-sm
                    flex flex-col justify-center items-center
                    px-5
                    py-2.5
                    dark:bg-red-900
                    dark:hover:bg-red-700
                    dark:focus:ring-red-900"
                    >Отменить</button>
                </form>
            </div>
        </div>
    @endif
@endsection
