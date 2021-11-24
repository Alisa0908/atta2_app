<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-4 py-4 bg-white shadow-md">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <article class="mb-2">
            <div class="flex justify-between text-sm">
                <div class="flex item-center">
                    <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">No.{{ $item->id }}</div>
                </div>
            </div>
            <div class="mt-1 mb-3 inline-block">
                <div><img src="{{ $item->image_url }}" alt="" class="h-100 w-100 rounded-full object-cover mr-3"></div>
            </div>


            <ul class="rounded-md shadow-md bg-white left-0 right-0 -bottom-18 mt-3 p-3">
            <li class="text-xs uppercase text-gray-400 border-b border-gray border-solid py-2 px-5 mb-2">
                落とし物情報
            </li>
            <li class="grid grid-cols-10 gap-4 justify-center items-center cursor-pointer px-4 py-2 rounded-lg hover:bg-gray-50">
                <div class="flex justify-center items-center">
                    <h3 class="text-gray-900 font-medium text-md">届いた日</h3>
                </div>
                <div class="col-start-2 col-end-11 pl-8 border-l-2 border-solid border-gray">
                    <h3 class="text-gray-900 font-medium text-md">{{ $item->created_at->format('Y/m/d') }}</h3>
                </div>
            </li>
            <li class="grid grid-cols-10 gap-4 justify-center items-center cursor-pointer px-4 py-2 rounded-lg hover:bg-gray-50">
                <div class="flex justify-center items-center">
                    <h3 class="text-gray-900 font-medium text-md">カテゴリー</h3>
                </div>
                <div class="col-start-2 col-end-11 pl-8 border-l-2 border-solid border-gray">
                    <h3 class="text-gray-900 font-medium text-md">{{ $item->category->name }}</h3>
                </div>
            </li>
            <li class="grid grid-cols-10 gap-4 justify-center items-center cursor-pointer px-4 py-2 rounded-lg hover:bg-gray-50">
                <div class="flex justify-center items-center">
                    <h3 class="text-gray-900 font-medium text-md">特徴</h3>
                </div>
                <div class="col-start-2 col-end-11 pl-8 border-l-2 border-solid border-gray">
                    <h3 class="text-gray-900 font-medium text-md">{{ $item->feature }}</h3>
                </div>
            </li>
            <li class="grid grid-cols-10 gap-4 justify-center items-center cursor-pointer px-4 py-2 rounded-lg hover:bg-gray-50">
                <div class="flex justify-center items-center">
                    <h3 class="text-gray-900 font-medium text-md">場所</h3>
                </div>
                <div class="col-start-2 col-end-11 pl-8 border-l-2 border-solid border-gray">
                    <h3 class="text-gray-900 font-medium text-md">{{ $item->lost_desc }}</h3>
                </div>
            </li>
            </ul>
        </article>

        <div class="flex flex-col sm:flex-row items-center sm:justify-end text-center my-4">
            <a href="{{ route('items.edit', $item) }}"
                class="bg-gradient-to-r from-yellow-300 to-yellow-400 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32 sm:mr-2 mb-2 sm:mb-0">編集</a>
            <form action="{{ route('items.destroy', $item) }}" method="post" class="w-full sm:w-32">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
            </form>
        </div>
    </div>
</x-app-layout>
