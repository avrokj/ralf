<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Product') }}
      </h2>
    </x-slot>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 flex-grow overflow-auto">
            <form method="POST" action="{{ route('shopapis.store') }}">
                @csrf
                @method('post')
                <x-input-label for="title" value="Title" class="pt-4" />
                    <x-text-input name="title" placeholder="Title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                
                <x-input-label for="description" value="Description" class="pt-4" />
                    <textarea name="description" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                
                <x-input-label for="price" value="Price" class="pt-4" />              
                    <x-text-input name="price" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                
                <x-input-label for="quantity" value="Quantity" class="pt-4" />              
                    <x-text-input name="quantity" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />                
                
                
                <x-input-label for="image" value="Image" class="pt-4" />              
                    <x-text-input name="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                <div class="mt-4 space-x-2">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    <a href="{{ route('shopapis.index') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>