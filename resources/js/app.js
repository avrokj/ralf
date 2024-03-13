import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $(".add-to-cart-button").on("click", function () {
        var productId = $(this).data("product-id");

        $.ajax({
            type: "GET",
            url: "/add-to-cart/" + productId,
            success: function (data) {
                $("#adding-cart-" + productId).show();
                $("#add-cart-btn-" + productId).hide();
            },
            error: function (error) {
                console.error("Error adding to cart:", error);
            },
        });
    });
});

$(".remove-from-cart").click(function (e) {
    e.preventDefault();

    var ele = $(this);

    if (confirm("Are you sure want to remove product from the cart.")) {
        $.ajax({
            url: '{{ url("remove-from-cart") }}',
            method: "DELETE",
            data: {
                _token: "{{ csrf_token() }}",
                id: ele.attr("data-id"),
            },
            success: function (response) {
                window.location.reload();
            },
        });
    }
});
