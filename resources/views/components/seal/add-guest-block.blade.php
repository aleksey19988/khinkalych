<div id="add-guest-block">
    <div class="new-phone-info">
        <p class="mt-10 mb-5 text-2xl text-white w-full text-center">Не нашли такой номер 🤔</p>
    </div>
    <div class="mt-5">
        <label for="first_name" class="
        block
        mb-2
        text-sm
        font-medium
        text-gray-900
        dark:text-white
        @error('name')
        text-red-900
        dark:text-red-500
        @enderror"
        >Как зовут гостя?</label>
        <input type="text" id="first_name" name="name" value="{{ old('name') }}" class="
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
        p-2.5
        my-2
        dark:bg-gray-700
        dark:border-gray-600
        dark:placeholder-gray-400
        dark:text-white
        dark:focus:ring-blue-500
        dark:focus:border-blue-500"
        placeholder="Например, Алексей"/>

        <label for="seals_count" class="
        block
        mb-2
        text-sm
        font-medium
        text-gray-900
        dark:text-white
        @error('name')
        text-red-900
        dark:text-red-500
        @enderror"
        >Кол-во печатей</label>
        <input type="number" id="seals_count" name="sealsCount" value="{{ old('sealsCount') }}" class="
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
        p-2.5
        my-2
        dark:bg-gray-700
        dark:border-gray-600
        dark:placeholder-gray-400
        dark:text-white
        dark:focus:ring-blue-500
        dark:focus:border-blue-500"
        placeholder="Например, 5"/>
    </div>
    @error('sealsCount')
    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Ой!</span> {{ $errors->first('sealsCount') }}</p>
    @enderror
    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Введи, если у гостя есть наша карточка</p>
</div>
