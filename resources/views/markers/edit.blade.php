<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Edit markers') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <form method="POST" class="w-full max-w-lg" action="{{ route('markers.update', $marker->id) }}">
                  @csrf
                  @method('PUT')

                  <div>
                    <x-input-label for="email" :value="__('Name')" />
                    <x-text-input type="text" class="block mt-1 w-full" id="name" name="name" value="{{ $marker->name }}" required />
                  </div>

                  
                  <div class="mt-4">
                    <x-input-label for="email" :value="__('Description')" />
                    <x-text-input type="text" class="block mt-1 w-full" id="description" name="longitude" value="{{ $marker->description }}" required />
                  </div>

                  
                  <div class="flex flex-wrap -mx-3 mt-4 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-input-label for="email" :value="__('Latitude')" />
                      <x-text-input type="text" class="form-control" id="latitude" name="latitude" value="{{ $marker->latitude }}" required />
                    </div>
                    
                    <div class="w-full md:w-1/2 px-3">
                      <x-input-label for="email" :value="__('Longitude')" />
                      <x-text-input type="text" class="form-control" id="longitude" name="longitude" value="{{ $marker->longitude }}" required />
                    </div>
                  </div>

                  <div class="flex justify-between mt-4 mb-6">
                    <x-secondary-button onclick="window.location='{{ URL::previous() }}'"> 
                      <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                      </svg>
                      &nbsp;{{ __('Go back') }}
                    </x-primary-button>

                    <x-primary-button>
                      {{ __('Update map marker') }}
                    </x-primary-button>
                  </div>
              </form>
            </div>
          </div>
      </div>
  </div>
</x-app-layout>
