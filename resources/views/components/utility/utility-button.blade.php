<a href="{{ $route }}" class="w-full sm:max-w-96 block">
    <button id="" class="
            transition
            ease-in-out
            duration-500
            flex
            justify-center
            mt-5
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
        <span id="">{{ $title }}</span>
    </button>
</a>
