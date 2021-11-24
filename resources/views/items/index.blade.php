<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div>
            <h3 class="mb-3 text-gray-400 text-sm">検索条件</h3>
            <form action="{{ route('items.index') }}" method="GET" class="rounded pt-3 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block mb-2" for="category_id">
                        カテゴリー
                    </label>
                    <select type="search" name="category"
                        class="rounded-md shadow-sm border-gray-300 focus:border-yellow-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3">
                        <option disabled selected value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == old('category')) selected @endif>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="lost_desc">
                        落ちていた場所
                    </label>
                    <input type="search" name="lost_desc"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3"
                        placeholder="近くの施設でもOK" value="{{ old('lost_desc') }}">
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="feature">
                        特徴
                    </label>
                    <input type="search" name="feature"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-yellow-500 w-full py-2 px-3"
                        placeholder="色など" value="{{ old('feature') }}">
                </div>

                <input type="submit" value="検索"
                    class="w-full flex justify-center bg-yellow-300 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
            </form>
        </div>

        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    カテゴリー</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    特徴</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    落ちていた場所</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    届いている場所</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    電話番号</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    詳細</th>

                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->id }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->category->name }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->feature }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->lost_desc }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $item->user->tel }}</div>
                                    </td>
                                    <td
                                        class="px-6 py-4 leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('items.show', $item) }}" class="px-1 py-1 text-sm text-yellow-400 bg-yellow-200 rounded-full">詳</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="block mt-3">
            {{ $items->links() }}
        </div>

    </div>
</x-app-layout>
