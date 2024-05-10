<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ralf Shop - Cart</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white p-4">
            
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 flex-grow overflow-auto">
                <div class="">
                    <h2 class="font-semibold text-xl leading-tight">
                        {{ __('Cart') }}
                    </h2>
                    <table class="relative w-full rounded-lg my-8">            
                    <thead class="bg-neutral-100">
                        <tr>
                        <th class="text-left py-2">Image</th>
                        <th class="text-left py-2">Name</th>
                        <th class="text-left py-2">Qty</th>
                        <th class="text-left py-2">Price</th>
                        <th class="text-left py-2"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0 ?>

                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)

                        <?php $total += $details['price'] * $details['quantity'] ?>

                        <tr class="even:bg-gray-50 odd:bg-white py-2">
                            <td >
                                <img src="{{ $details['photo'] }}" class="w-12 h-12" />
                            </td>
                            <td>
                                {{ $details['name'] }}
                            </td>
                            <td>
                                <div class="custom-number-input h-10 w-32">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" min="0" max="100" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="quantity" value="{{ $details['quantity'] }}"></input>
                                    <button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                                </div>
                            </td>
                            <td data-th="Subtotal" class="text-center">{{ $details['price'] * $details['quantity'] }} €</td>
                            <td>
                                <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('x') }}
                                  </x-danger-button>
                            </td>
                        </tr>

                        @endforeach
                        @endif

                    </tbody>
                    <tfoot>
                        @if(!empty($details))
                        <tr class="visible-xs">
                            <td class="text-right" colspan="3"><strong>Total: </strong></td>
                            <td class="text-center">{{ $total }} €</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center" colspan="4">Your Cart is Empty.....</td>
                        <tr>
                            @endif
                    </tfoot>

                </table>
            </div>
            <div class="flex justify-between">
                <a href="{{ URL::previous() }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Continue Shopping</a>
                <a href="" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Proceed Checkout</a>
            </div>
        </div>
    </div>
  @vite(['resources/js/app.js'])
  </body>
</html>
