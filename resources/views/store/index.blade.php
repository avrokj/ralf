<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex">
                    @if(!empty($products)) @foreach($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="card mb-4">
                        <img
                        src="{{ $product->photo }}"
                        class="card-img-top img-size"
                        alt="{{ $product->name }}"
                        />
                        <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit(strtolower($product->description),
                            50) }}
                        </p>
                        <p class="card-text">
                            <strong>Price: </strong> ${{ $product->price }}
                        </p>
                        <a
                            href="javascript:void(0);"
                            data-product-id="{{ $product->id }}"
                            id="add-cart-btn-{{ $product->id }}"
                            class="btn btn-warning btn-block text-center add-cart-btn add-to-cart-button"
                            >Add to cart</a
                        >
                        <span
                            id="adding-cart-{{ $product->id }}"
                            class="btn btn-warning btn-block text-center added-msg"
                            style="display: none"
                            >Added.</span
                        >
                        </div>
                    </div>
                    </div>
                    @endforeach @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

    