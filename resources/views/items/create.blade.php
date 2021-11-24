<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-yellow-50 shadow-md rounded-md">
        <h2 class="text-center text-lg text-yellow-500 font-bold pt-6 tracking-widest">落とし物情報登録</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('items.store') }}" enctype="multipart/form-data" method="POST" class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block mb-2" for="category_id">
                    カテゴリー
                </label>
                <select name="category_id"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3">
                    <option disabled selected value="">選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2" for="feature">
                    特徴
                </label>
                <input type="text" name="feature"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3"
                    required placeholder="カンマ区切りで記入" value="{{ old('feature') }}">
            </div>
            <div class="mb-4">
                <label class="block mb-2" for="lost_desc">
                    落ちていた場所
                </label>
                <input type="text" name="lost_desc"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3"
                    required placeholder="近くの施設名など" value="{{ old('lost_desc') }}">
            </div>
            <div class="mb-4">
                <label class="block mb-2" for="file">
                    ファイルを選択してください
                </label>
                <input type="file" name="file"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3"
                    value="{{ old('file') }}">
            </div>
            <input type="submit" value="登録"
                class="w-full flex justify-center bg-yellow-300 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
        </form>
    </div>
</x-app-layout>
