<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Product') }}: {{ $product->name }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
      </h2>
    </x-slot>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 flex-grow overflow-auto">
            <div class="grid grid-cols-4 gap-4">
                <div><img src="{{ $product->image_path }}" class="object-contain w-full sm:rounded-lg"></div>
                <div class="col-span-3">
                <form method="POST" action="{{ route('store.update', $product->id) }}" class="flex flex-col">
                    @csrf
                    @method('patch')
                    <x-input-label for="name" value="Title" class="pt-4" />
                    <x-text-input name="name" value="{{ old('title', $product->name) }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    
                    <x-input-label for="image_path" value="Image" class="pt-4" />
                    <x-text-input name="image_path" value="{{ old('image_path', $product->image_path) }}" />
                    <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                        
                    <x-input-label for="stock_saldo" value="Stock saldo" class="pt-4" />              
                        <x-text-input name="stock_saldo" value="{{ old('stock_saldo', $product->stock_saldo) }}" />
                    <x-input-error :messages="$errors->get('stock_saldo')" class="mt-2" />
                        
                    <x-input-label for="price" value="Price" class="pt-4" />              
                        <x-text-input name="price" value="{{ old('price', $product->price) }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                    
                    <x-input-label for="description" value="Description" class="pt-4" />
                        <textarea name="description" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    <div class="mt-4 space-x-2">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{ route('store.index') }}" class="text-white bg-red-500 hover:bg-red-600 rounded-md text-sm px-4 py-2 focus:outline-none uppercase font-semibold">{{ __('Cancel') }}</a>
                    </div>
                </form> 
            </div>
            </div>
        </div>
      </div>
    </div>
  </x-app-layout>