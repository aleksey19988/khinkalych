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
            <label for="phone-input" class="
            block
            mb-2
            text-sm
            font-medium
            text-gray-900
            dark:text-white
            @error('phone')
            text-red-900
            dark:text-red-500
            @enderror"
            >Номер телефона</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                        <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                    </svg>
                </div>
                <input type="text" id="phone-input" name="phone" aria-describedby="helper-text-explanation" class="
            bg-gray-50
            border
            border-gray-300
            text-gray-900
            text-sm
            rounded-lg
            focus:ring-blue-500
            focus:border-blue-500
            block
            w-full
            ps-10
            p-2.5
            dark:bg-gray-700
            dark:border-gray-600
            dark:placeholder-gray-400
            dark:text-white
            dark:focus:ring-blue-500
            dark:focus:border-blue-500
            @error('phone')
            bg-red-50
            border-red-500
            text-red-900
            placeholder-red-700
            focus:ring-red-500
            focus:border-red-500
            dark:text-red-500
            dark:placeholder-red-500
            dark:border-red-500
            @enderror"
               pattern="[0-9]{10}"
               placeholder="9012345678"
               value="{{ old('phone') }}"
               @if(session('show-name-block')) readonly @endif
               required />
            </div>
            @error('phone')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Ой!</span> Номер не соответствует формату (строго 10 цифр)</p>
            @enderror
            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Введи номер телефона в соответствии с форматом</p>
            @if(session('show-name-block'))
                <x-seal.add-guest-block/>
            @endif
            <button type="submit" id="add-seal-form-submit-btn" class="
            transition
            ease-in-out
            duration-500
            flex
            justify-center
            align-middle
            mt-10
            h-10
            w-full
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
            >
                <x-loading-spinner/>
                <span id="add-seal-form-submit-btn-text">Добавить</span>
            </button>
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
