<div class="container cart-page py-5">

    <h4 class="fw-bold mb-4">Shopping Cart</h4>

    <div class="row g-4">
        {{-- CART --}}
        <div class="col-lg-8">
            <div class="card cart-card">
                <div class="card-body p-0">
                    <table class="table cart-table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart_items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ route('menu.image', ['id' => $item->id_menu]) }}" alt="{{ $item->nama_menu }}" class="cart-product-img">
                                        <div>
                                            <div class="fw-semibold">{{ $item->nama_menu }}</div>
                                                <small class="text-muted">{{ $item->desc_menu }}</small>
                                                <td>Rp {{ number_format($item->harga_menu,0,',','.') }}</td>
                                                <span>{{ $item->quantity }}</span>
                                                <td class="fw-semibold">
                                                    Rp {{ number_format($item->harga_menu * $item->quantity,0,',','.') }}
                                                </td>
                                        </div>
                                    </div>
                                </td>

                                <td>Rp {{ number_format($item->harga_menu,0,',','.') }}</td>

                                <td class="text-center">
                                    <div class="qty-box">
                                        <button>-</button>
                                        <span>{{ $item->quantity }}</span>
                                        <button>+</button>
                                    </div>
                                </td>

                                <td class="fw-semibold">
                                    Rp {{ number_format($item->harga_menu * $item->quantity,0,',','.') }}
                                </td>

                                <td>
                                    <a href="#" class="remove-btn">&times;</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Cart masih kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="cart-footer">
                        <a href="#" class="clear-cart ms-auto">Clear Shopping Cart</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="col-lg-4">
            <div class="card summary-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Order Summary</h6>

                    @php
                        $subtotal = collect($cart_items)->sum(fn($i) => $i->harga_menu * $i->quantity);
                        $total = $subtotal;
                    @endphp

                    <ul class="summary-list">
                        <li>
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
                        </li>
                        <li>
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </li>
                        <li class="total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total,0,',','.') }}</span>
                        </li>
                    </ul>

                    <a href="{{ route('checkout') }}" class="btn btn-checkout w-100">
                        Proceed to Checkout
                    </a>

                </div>
            </div>
        </div>
    </div>

    {{-- INFO --}}
    <div class="row text-center info-section mt-5">
        <div class="col-md-4">
            <div class="info-box">
                <i class="fas fa-truck-fast info-icon"></i>
                <strong>Free Shipping</strong>
                <p>Free shipping for order above Rp 50.000</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <i class="fas fa-credit-card info-icon"></i>
                <strong>Flexible Payment</strong>
                <p>Multiple secure payment options</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <i class="fas fa-headset info-icon"></i>
                <strong>24x7 Support</strong>
                <p>We support online all days</p>
            </div>
        </div>
    </div>

</div>
