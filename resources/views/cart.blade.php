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
                        <th class="text-left py-2">Total</th>
                        <th class="text-left py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0 ?>
                        @foreach(session('cart') as $id => $details)

                            <?php $total += $details['price'] * $details['quantity'] ?>

                            <tr class="even:bg-gray-50 odd:bg-white py-2" data-product-id="{{ $id }}">
                                <td class="pr-2">
                                    <img src="{{ $details['image_path'] }}" class="w-12 h-12 rounded-md" />
                                </td>
                                <td class="pr-2">
                                    {{ $details['name'] }}
                                </td>
                                <td class="pr-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex gap-1">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" max="100" class="rounded-md h-8 w-16 outline-none focus:outline-none text-center font-semibold text-md md:text-basecursor-default flex items-center outline-none quantity-input">
                                            <x-secondary-button type="submit" class="!px-1 py-1">
                                                {{ __('Update') }}
                                            </x-secondary-button>
                                        </div>
                                    </form>
                                </td>
                                <td class="pr-4">
                                    {{ $details['price'] }}
                                </td>
                                <td class="text-center subtotal pr-4">
                                    {{ $details['price'] * $details['quantity'] }} €
                                </td>
                                <td>
                                    <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" title="{{ __('Remove') }}">
                                            {{ __('X') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                    @if($total > 0)
                        <tr class="visible-xs">
                            <td class="text-right" colspan="4"><strong>Total: </strong></td>
                            <td class="text-center total">{{ $total }} €</td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <td class="text-center" colspan="5">Your Cart is Empty.....</td>
                        <tr>
                    @endif
                    </tfoot>
                </table>

            </div>
            <div class="flex justify-between">
                <a href="../" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Continue Shopping</a>
                <form action="{{ route('checkout.checkout') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
  @vite(['resources/js/app.js'])
  </body>
</html>
