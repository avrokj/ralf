<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Map Markers') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 max-h-[860px]">
              <small>Please find a location on the map that you want to mark, click on it, and fill in the fields!</small>
              <!-- Modal -->
                <div id="markerModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="markerModalLabel" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <!-- Modal content -->
                        <div id="modalContent" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-labelledby="modal-headline">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            {{ __('Enter Marker Details') }}
                                        </h3>
                                        <div class="mt-2">
                                            <x-input-label for="password" :value="__('Marker Name')" />
                                            <x-text-input id="markerName" />
                                            <x-input-label for="markerDescription" :value="__('Marker Description')" />
                                            <x-text-input id="markerDescription" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <x-primary-button class="ms-3" onclick="saveMarkerDetails()">{{ __('Save') }}</x-primary-button>
                                <x-secondary-button class="ms-3" onclick="closeModal()">{{ __('Cancel') }}</x-secondary-button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for marker data -->
                <input type="hidden" id="markerNameInput" name="markerName">
                <input type="hidden" id="markerDescriptionInput" name="markerDescription">
                <input type="hidden" id="clickLatLng" name="clickLatLng">

              <div class="flex flex-col md:flex-row h-dvh"> 
                  <div id="map" class="flex-1 sm:rounded-md max-h-[800px]"></div>
                  <div id="marker-list" class="pl-4 overflow-y-auto md:w-1/3 lg:w-1/4 max-h-[860px]">
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
                                            <x-dropdown-link :href="route('markers.destroy', $marker['id'])" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this map marker?')) { this.closest('form').submit(); }">
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
    const mapOptions = {
        zoom: 3,
        center: new google.maps.LatLng(0, 0), // Default center if no markers
        mapId: "DEMO_MAP_ID"
    };

    // Initialize map
    const map = new google.maps.Map(document.getElementById('map'), mapOptions); // The new google.maps.marker.AdvancedMarkerElement won´t work
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

        // Add click event listener to markers
        mapMarker.addListener('click', function() {
            // Create an InfoWindow instance
            const infoWindow = new google.maps.InfoWindow({
                content: `<strong>${data.name}</strong><br>${data.description}`
            });
            // Open the InfoWindow on the marker
            infoWindow.open(map, mapMarker);
        });
    });

    // Only fit the bounds if there are markers
    if (markersData.length > 0) {
        map.fitBounds(bounds);
    } else {
        map.setCenter(mapOptions.center);
    }

    // Add map click event listener
    google.maps.event.addListener(map, 'click', function(event) {
        // Open the modal programmatically
        openModal();

        // Set the click event's latLng to a hidden input for later retrieval
        document.getElementById('clickLatLng').value = JSON.stringify(event.latLng.toJSON());
    });
}

// Function to open the modal
function openModal() {
    document.getElementById('markerModal').classList.remove('hidden');
}

// Function to close the modal
function closeModal() {
    document.getElementById('markerModal').classList.add('hidden');
    window.location.reload();
}

// Function to handle saving marker details
function saveMarkerDetails() {
    var markerName = document.getElementById('markerName').value;
    var markerDescription = document.getElementById('markerDescription').value;
    var clickLatLng = JSON.parse(document.getElementById('clickLatLng').value);

    const clickMarker = new google.maps.Marker({
        position: clickLatLng,
        map: map,
        title: markerName
    });

    const markerData = {
        name: markerName,
        latitude: clickLatLng.lat,
        longitude: clickLatLng.lng,
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

    // Close the modal programmatically
    closeModal();
}

  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.map.key') }}&loading=async&callback=initMap"></script>
</x-app-layout>a