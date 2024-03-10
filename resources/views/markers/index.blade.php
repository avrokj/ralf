<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Map Markers') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <div class="flex flex-col md:flex-row h-dvh"> 

                    <div id="map" class="flex-1"></div>                
                    <div class="pl-4 overflow-auto md:w-1/3 lg:w-1/4 h-full">
                        <div class="space-y-2 mb-4">
                            @php $limitedMarkers = array_slice($markers->toArray(), -10); @endphp
                            
                            @foreach($limitedMarkers as $marker)
                                <div class="flex items-center justify-between p-2 rounded shadow">
                                    <div>
                                        <div class="font-semibold text-gray-600">{{ $marker['name'] }}</div>
                                        <small class="ml-2 text-sm text-gray-600">{{ $marker['description'] }}</small>
                                    </div>

                                    <x-dropdown>
                                      <x-slot name="trigger">
                                          <button>
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                  <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                              </svg>
                                          </button>
                                      </x-slot>    
                                      
                                      <x-slot name="content">
                                        <x-dropdown-link :href="route('markers.edit', $marker['id'])">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>

                                        <form method="POST" action="{{ route('markers.destroy', $marker['id']) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('markers.destroy', $marker['id'])" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                      </x-slot>  
                                    </x-dropdown>
                                </div>
                            @endforeach
                        </div>
                    </div>                
                </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Google Maps API -->
  <script>
    // Prepare marker data
    const markersData = @json($markers);

    function initMap() {
        // Define map options
        const mapOptions = {
            zoom: 8,
            center: new google.maps.LatLng(0, 0) // Default center if no markers
        };
        
        // Initialize map
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);
        const bounds = new google.maps.LatLngBounds();

        // Place markers
        markersData.forEach((data) => {
            const mapMarker = new google.maps.Marker({
                position: new google.maps.LatLng(data.latitude, data.longitude),
                map: map,
                title: data.name
            });

            // Extend the bounds to include this marker's position
            bounds.extend(mapMarker.getPosition());
        });

        // Only fit the bounds if there are markers
        if (markersData.length > 0) {
            map.fitBounds(bounds);
        } else {
            map.setCenter(mapOptions.center);
        }

        // Add map click event listener
        google.maps.event.addListener(map, 'click', function(event) {
            const markerName = prompt("Enter marker name:", "");
            if (markerName) {
                const markerDescription = prompt("Enter marker description:", "");
                const clickMarker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    title: markerName
                });

                const markerData = {
                    name: markerName,
                    latitude: event.latLng.lat(),
                    longitude: event.latLng.lng(),
                    description: markerDescription,
                    _token: '{{ csrf_token() }}'
                };

                fetch('{{ route('markers.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(markerData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Marker saved:', data);
                })
                .catch(error => {
                    console.error('Error saving marker:', error);
                });
            }
        });
    }
  </script>
  <script async defer 
      src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&callback=initMap">
  </script>
</x-app-layout>