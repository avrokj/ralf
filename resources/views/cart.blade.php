<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ralf Shop - Card</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
    <table id="cart" class="table table-bordered table-hover table-condensed mt-3">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
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
  <a href="{{ URL::previous() }}" class="btn shopping-btn">Continue Shopping</a>
  <a href="" class="btn btn-warning check-btn">Proceed Checkout</a>
  <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
