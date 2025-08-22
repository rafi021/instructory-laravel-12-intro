@extends('welcome')
@section('main-content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Our Products</h1>
            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col">
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="https://prd.place/400?id={{ $loop->index + 1 }}" alt="{{ $product['name'] }}"
                                class="object-cover rounded-t-2xl w-full h-48">
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2 truncate">{{ $product['name'] }}</h2>
                            <div class="text-teal-600 font-bold text-xl mb-4">${{ number_format($product['price'], 2) }}
                            </div>
                            <div class="mt-auto">
                                <button
                                    class="buy-now-btn inline-block w-full text-center bg-teal-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition"
                                    data-product='@json($product)'
                                    data-img="https://prd.place/400?id={{ $loop->index + 1 }}">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Modal -->
        <div id="orderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative">
                <button id="closeModalBtn"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                <h2 class="text-2xl font-bold mb-6 text-center text-teal-700">Complete Your Order</h2>
                {{-- Validation Errors --}}
                <form id="orderForm" method="POST" action="{{ route('order.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" id="modal_product_id">
                    <input type="hidden" name="total_amount" id="modal_total_amount">
                    <div class="flex items-center gap-4 mb-2">
                        <img id="modal_product_img" src="" alt=""
                            class="rounded-lg w-20 h-20 object-cover border">
                        <div>
                            <div class="font-semibold text-lg" id="modal_product_name"></div>
                            <div class="text-teal-600 font-bold" id="modal_product_price"></div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Order Quantity</label>
                        <input type="number" name="order_qty" min="1" max="99" id="modal_order_qty"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400" value="1"
                            required>
                        @error('order_qty')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Customer Name</label>
                        <input type="text" name="customer_name"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400" required>
                        @error('customer_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400" required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                        <input type="email" name="email"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Delivery Address</label>
                        <textarea name="delivery_address" rows="2"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400" required></textarea>
                        @error('delivery_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <div class="text-lg font-bold text-gray-700">
                            Total: <span class="text-teal-600" id="modal_total"></span>
                        </div>
                        <button type="submit"
                            class="bg-teal-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition text-lg shadow">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Modal logic
        const modal = document.getElementById('orderModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const orderForm = document.getElementById('orderForm');
        const productIdInput = document.getElementById('modal_product_id');
        const totalAmountInput = document.getElementById('modal_total_amount');
        const productImg = document.getElementById('modal_product_img');
        const productName = document.getElementById('modal_product_name');
        const productPrice = document.getElementById('modal_product_price');
        const orderQtyInput = document.getElementById('modal_order_qty');
        const totalText = document.getElementById('modal_total');

        let currentProduct = null;

        document.querySelectorAll('.buy-now-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const product = JSON.parse(this.dataset.product);
                const img = this.dataset.img;
                currentProduct = product;
                productIdInput.value = product.id;
                productImg.src = img;
                productName.textContent = product.name;
                productPrice.textContent = '$' + Number(product.price).toFixed(2);
                orderQtyInput.value = 1;
                updateTotal();
                modal.classList.remove('hidden');
            });
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Close modal on background click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Update total on quantity change
        orderQtyInput.addEventListener('input', updateTotal);

        function updateTotal() {
            const qty = parseInt(orderQtyInput.value) || 1;
            const price = currentProduct ? Number(currentProduct.price) : 0;
            const total = qty * price;
            totalText.textContent = '$' + total.toFixed(2);
            totalAmountInput.value = total;
        }
    </script>
@endsection
