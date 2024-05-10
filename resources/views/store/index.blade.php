<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
          </h2> 
        </div>
      </div>
    </x-slot>
  
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 flex-grow overflow-auto">
            <table class="relative w-full rounded-lg">            
              <thead class="bg-neutral-100">
                <tr>
                  <th class="text-left py-2 rounded-t-md">Image</th>
                  <th class="text-left py-2 rounded-t-md">Name</th>
                  <th class="text-left py-2 rounded-t-md">Description</th>
                  <th class="text-left py-2 rounded-t-md">Qty</th>
                  <th class="text-left py-2 rounded-t-md">Price</th>
                  <th class="text-left py-2 rounded-t-md">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($products)) @foreach($products as $product)
                <tr class="border-b justify-between items-center transition duration-300 ease-in-out hover:bg-neutral-50">
                  <td>
                      <img src="{{ $product->image_path }}" class="w-8 aspect-square">
                  </td>
                  <td>
                    {{ $product->name }} 
                  </td>
                  <td>
                    {{ $product->description }} 
                  </td>
                  <td>
                    {{ $product->stock_saldo }} 
                  </td>
                  <td>
                    {{ $product->price }} 
                  </td>
                  <td>
                    <div class="flex">
                    <a href="{{route('store.edit', $product)}}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md text-sm px-2 py-1 mr-2 focus:outline-none uppercase font-semibold tracking-widest text-xs">
                      {{ __('Edit') }}
                    </a>
                    <form method="POST" action="{{ route('store.destroy', $product) }}">
                      @csrf
                      @method('delete')
                      <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Delete') }}
                      </x-danger-button>
                  </form></div>
                  </td>
                </tr>
                @endforeach @endif      
              </tbody>
            </table>
          <div class="pt-4">
            {{-- {{ $product->links() }} --}}
          </div>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>