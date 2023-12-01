@include('home.master')
@include('home.header')

<div class="container cart-section">
    <h1 class="card-heading">Cart</h1>
</div>
<div class="container d-flex justify-content-center align-items-center flex-column">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr class="table-head">
                <th class="text-center">
                    PRODUCT
                </th>
                <th>
                    PRICE
                </th>

                <th>
                    Operation
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
                $totalprice = 0;
                $dis_price = 0;
            @endphp
            @forelse ($cart as $cart)
                <tr class="table-row ">
                    <td class="tb-img">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                        <img src="{{ asset('storage/' . $cart->image) }}" alt="">
                        <p>{{ $cart->title }}</p>
                        <p class="sm-price">${{ $cart->price }}</p>
                    </td>
                    <td class="price pe-5">
                        <p>${{ $cart->discount_price ? $cart->discount_price : $cart->price }}</p>
                    </td>

                    <td class="total">

                        <div class="t-btn">
                            <button class="m-2 update-btn"><a class="text-light"
                                    href="{{ route('deleteCart', ['id' => $cart->id]) }}">Delete
                                    Cart</a></button>


                            @if ($cart->discount_price != null)
                                @php
                                    $dis_price = $dis_price + $cart->discount_price;
                                @endphp
                            @else
                                @php
                                    $totalprice = $totalprice + $cart->price;
                                @endphp
                            @endif

                            @php
                                $subtotal = $dis_price + $totalprice;

                            @endphp



                        </div>
                    </td>
                </tr>

            @empty
            @endforelse
        </tbody>
    </table>
    <div class="table-last">
        <div class="text-area ">
            <input type="text" name="" id="" placeholder="Coupon code">
            <button class="inp-btn"><a class="text-light" href="{{ route('stripe', $subtotal) }}">Pay using
                    Card</a></button>
        </div>

        <div class="t-btn">
            <button class="update-btn"><a class="text-light" href="{{ route('order') }}">Order
                    Now</a></button>
        </div>
    </div>
</div>
<div class="container card-container">
    <div class="c-card">
        {{-- @php
            $subtotal = 0;
        @endphp --}}


        <div class="s-total">
            <p>SUBTOTAL</p>
            <p>
                @isset($subtotal)
                    {{ $subtotal }}
                    @php
                        $total = $subtotal;
                    @endphp
                @endisset
                {{-- @if (!$subtotal)
                @else
                    {{ $subtotal }}

                @endif --}}


            </p>
        </div>




        <div class="c-total">
            <p class="para">
                TOTAL
            </p>
            <p class="c-price">

            </p>
        </div>

        <div class="card-btn">
            <button>PROCEED TO CHECKOUT</button>
        </div>
    </div>
</div>
@include('home.footer')
@include('home.script')
