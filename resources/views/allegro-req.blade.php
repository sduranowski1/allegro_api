@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1>Send Product Offer to Allegro</h1>
        <form id="productOfferForm">
            <div class="mb-3">
                <label for="productId" class="form-label">Product ID (GTIN)</label>
                <input type="text" class="form-control" id="productId" placeholder="Enter Product ID" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="productPrice" placeholder="Enter Price" required>
            </div>
            <div class="mb-3">
                <label for="productCurrency" class="form-label">Currency</label>
                <input type="text" class="form-control" id="productCurrency" value="PLN" readonly>
            </div>
            <div class="mb-3">
                <label for="productStock" class="form-label">Available Stock</label>
                <input type="number" class="form-control" id="productStock" placeholder="Enter Available Stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Product Offer</button>
        </form>
        <p id="responseMessage" class="mt-3"></p>
    </div>

    <script>
        document.getElementById('productOfferForm').addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent the form from submitting normally

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const productId = document.getElementById('productId').value;
            const productPrice = document.getElementById('productPrice').value;
            const productStock = document.getElementById('productStock').value;

            // Prepare the data to send
            const requestData = {
                productSet: [{
                    product: {
                        id: productId,
                        idType: "GTIN"
                    }
                }],
                sellingMode: {
                    price: {
                        amount: productPrice,
                        currency: "PLN"
                    }
                },
                stock: {
                    available: productStock
                }
            };

            fetch('/send-product-offer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(requestData)
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('responseMessage').textContent = `Response: ${JSON.stringify(data)}`;
                })
                .catch(error => {
                    document.getElementById('responseMessage').textContent = `Error: ${error}`;
                });
        });
    </script>
@endsection
