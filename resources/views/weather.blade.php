<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Weather') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
            <h1>Current Weather in {{ $weatherData['name'] }}</h1>
            <p>Description: {{ $weatherData['weather'][0]['description'] }}</p>
            <p>Temperature: {{ round($weatherData['main']['temp'], 0) }} &#8451; </p>  
          </div>
      </div>
    </div>
  </div>
</x-app-layout>
