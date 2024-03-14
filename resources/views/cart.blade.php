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
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white p-4">
            <table id="cart" class="table-auto p-6 text-gray-900 dark:text-white bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
            <thead>
                <tr>
                    <th style="w-7/12">Product</th>
                    <th style="w-3/12">Quantity</th>
                    <th style="w-2/12" class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>

                <?php $total = 0 ?>

                @if(session('cart'))
                @foreach(session('cart') as $id => $details)

                <?php $total += $details['price'] * $details['quantity'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="50" height="" class="img-responsive" />

                            </div>

                            <div class="col-sm-9">
                                <p class="nomargin">{{ $details['name'] }}</p>
                                <p class="remove-from-cart cart-delete" data-id="{{ $id }}" title="Delete">Remove</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                </tr>

                @endforeach
                @endif

            </tbody>
            <tfoot>
                @if(!empty($details))
                <tr class="visible-xs">
                    <td class="text-right" colspan="2"><strong>Total</strong></td>
                    <td class="text-center"> ${{ $total }}</td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">Your Cart is Empty.....</td>
                <tr>
                    @endif
            </tfoot>

        </table>
    </div>
  <a href="{{ URL::previous() }}" class="btn shopping-btn">Continue Shopping</a>
  <a href="" class="btn btn-warning check-btn">Proceed Checkout</a>
  @vite(['resources/js/app.js'])
  </body>
</html>
