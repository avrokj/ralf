<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Product') }}: {{ $product->title }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
      </h2>
    </x-slot>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 flex-grow overflow-auto">
            <form method="POST" action="{{ route('store.update', $product) }}" class="flex flex-col">
                @csrf
                @method('patch')
                <x-input-label for="title" value="Title" class="pt-4" />
                <x-text-input name="title" value="{{ old('title', $product->title) }}" />
                  <x-input-error :messages="$errors->get('title')" class="mt-2" />
                
                <x-input-label for="language" value="Language" class="pt-4" />
                <x-text-input name="language" value="{{ old('language', $product->language) }}" />
                  <x-input-error :messages="$errors->get('language')" class="mt-2" />
                    
                <x-input-label for="price" value="Price" class="pt-4" />              
                    <x-text-input name="price" value="{{ old('price', $product->price) }}" />
                  <x-input-error :messages="$errors->get('price')" class="mt-2" />
                  <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                    
                <x-input-label for="release_date" value="Released" class="pt-4" />              
                    <x-text-input name="release_date" value="{{ old('release_date', $product->release_date) }}" />
                  <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                    
                <x-input-label for="pages" value="Pages" class="pt-4" />              
                    <x-text-input name="pages" value="{{ old('pages', $product->pages) }}" />
                  <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                  <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                    
                <x-input-label for="stock_saldo" value="Stock saldo" class="pt-4" />              
                    <x-text-input name="stock_saldo" value="{{ old('stock_saldo', $product->stock_saldo) }}" />
                  <x-input-error :messages="$errors->get('stock_saldo')" class="mt-2" />
                    
                <x-input-label for="type" value="Type" class="pt-4" />
                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="type" id="type">
                      <option value="new" {{ $product->type == "new" ? "selected" : "" }}>new</option>
                      <option value="eproduct" {{ $product->type == "eproduct" ? "selected" : "" }}>eproduct</option>
                      <option value="used" {{ $product->type == "used" ? "selected" : "" }}>used</option>
                    </select>
                
                    <x-input-label for="pages" value="Pages" class="pt-4" />              
                    <x-text-input name="pages" value="{{ old('pages', $product->pages) }}" />
                  <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                  <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                
                <x-input-label for="summary" value="Summary" class="pt-4" />
                    <textarea name="summary" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('summary', $product->summary) }}</textarea>
                  <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                <div class="mt-4 space-x-2">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    <a href="{{ route('products.index') }}" class="text-white bg-red-500 hover:bg-red-600 rounded-md text-sm px-4 py-2 focus:outline-none uppercase font-semibold text-xs">{{ __('Cancel') }}</a>
                </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>