import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart-button");
    const cartCountElement = document.querySelector(".cart-count");

    addToCartButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const productId = button.dataset.productId;

            fetch("/add-to-cart/" + productId)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    document.getElementById(
                        "adding-cart-" + productId
                    ).style.display = "block";
                    document.getElementById(
                        "add-cart-btn-" + productId
                    ).style.display = "none";

                    // Update cart count
                    fetch("/get-cart-count")
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error("Network response was not ok");
                            }
                            return response.json();
                        })
                        .then((cartCount) => {
                            cartCountElement.textContent = cartCount;
                        })
                        .catch((error) => {
                            console.error("Error getting cart count:", error);
                        });
                })
                .catch((error) => {
                    console.error("Error adding to cart:", error);
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const removeFromCartButtons =
        document.querySelectorAll(".remove-from-cart");

    removeFromCartButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const ele = e.target;

            if (confirm("Are you sure want to remove product from the cart.")) {
                fetch("/remove-from-cart", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        id: ele.getAttribute("data-id"),
                    }),
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        window.location.reload();
                    })
                    .catch((error) => {
                        console.error("Error removing from cart:", error);
                    });
            }
        });
    });
});

// Button

$(document).ready(function () {
    $("#plus-btn").click(function () {
        $("#quantity").val(parseInt($("#quantity").val()) + 1);
    });

    $("#minus-btn").click(function () {
        var currentValue = parseInt($("#quantity").val());
        if (currentValue > 1) {
            $("#quantity").val(currentValue - 1);
        }
    });
});
