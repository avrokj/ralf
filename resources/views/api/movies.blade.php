<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="/api" class="px-4"> {{__('My Shop') }}</a>
            <a href="/api/records" class="px-4">{{ __('Records') }}</a>
            <a href="/api/movies" class="border-b-2 border-indigo-400 px-4">{{ __('Movies') }}</a>
            <a href="/api/makeup" class="px-4">{{ __('Make Up') }}</a>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="bg-slate-50 shadow-sm sm:rounded-lg hover:shadow-md">
                        <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="sm:rounded-lg w-full aspect-square object-cover">
                        <div class="text-center p-4">
                            <h2 class="font-semibold text-2xl">{{ $product['title'] }}</h2>
                            <p>Rating: {{ $product['movie_rating'] }}</p>
                            <p>Rank: {{ $product['rank'] }}</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>