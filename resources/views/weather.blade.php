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
                    <h1 class="flex items-center">Current Weather in <strong>&nbsp;{{ $weatherData['name'] }}&nbsp;</strong><img src="https://openweathermap.org/img/w/{{ $weatherData['weather'][0]['icon'] }}.png"></h1>
                    <p>Description: {{ $weatherData['weather'][0]['description'] }}</p>
                    <p>Temperature: {{ round($weatherData['main']['temp'], 0) }} &#8451; </p>
                    <p>Feels like: {{ round($weatherData['main']['feels_like'], 0) }} &#8451; </p>
                    <p>Min temp.: {{ round($weatherData['main']['temp_min'], 0) }} &#8451; </p>
                    <p class="pb-4">Max temp.: {{ round($weatherData['main']['temp_max'], 0) }} &#8451; </p>

                    <p>Cloudiness: {{ $weatherData['clouds']['all'] }} %</p>                    
                    <p>Rain 1h: 
                        @if(isset($weatherData['rain']['1h']))
                            {{ $weatherData['rain']['1h'] }}
                        @else
                            0
                        @endif mm</p>                    
                    <p class="pb-4">Snow 1h: 
                        @if(isset($weatherData['snow']['1h']))
                            {{ $weatherData['snow']['1h'] }}
                        @else
                            0
                        @endif mm</p>

                    <p>Visibility: {{ $weatherData['visibility']/1000.0 }} km</p>
                    <p>Pressure: {{ $weatherData['main']['pressure'] }} hPa</p>
                    <p>Humidity: {{ $weatherData['main']['humidity'] }} %</p>
                    <p>Windspeed: {{ round($weatherData['wind']['speed'],1) }} m/s</p>
                    @php
                        function degreeToDirection($degree) {
                            $directions = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW']; // https://uni.edu/storm/Wind%20Direction%20slide.pdf
                            $index = round(($degree % 360) / 22.5);
                            return $directions[$index];
                        }
                    @endphp
                    <p class="pb-4">Wind degree: {{ degreeToDirection($weatherData['wind']['deg']) }}</p>

                    <p>Sunrise: {{ Carbon\Carbon::createFromTimestamp($weatherData['sys']['sunrise'], 'UTC')->setTimezone('Europe/Tallinn')->format('H:i:s') }}</p>
                    <p class="pb-4">Sunset: {{ Carbon\Carbon::createFromTimestamp($weatherData['sys']['sunset'], 'UTC')->setTimezone('Europe/Tallinn')->format('H:i:s') }}</p>
                    <p><small>Data updated at: {{ $cachedAt->setTimezone('Europe/Tallinn')->format('Y-m-d H:i:s') }}</small></p>
                </div>
            </div>
        </div>
  </div>
</x-app-layout>
