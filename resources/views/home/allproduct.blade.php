@include('Home.master')
@include('Home.header')


<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                All <span>Products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $data)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('productDetail', ['id' => $data->id]) }}" class="option1">
                                    Details
                                </a>
                                <form action="/addtocart/{{ $data->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="" value="{{ $data->id }}" id="">
                                    <button class="butn " type="submit">
                                        Add To Cart
                                    </button>
                                </form>
                                <a href="" class="option2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('storage/' . $data->image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $data->title }}

                            </h5>
                            @if ($data->discount_price == !null)
                                <h6>discount Price "{{ $data->discount_price }}"</h6>
                                <h6 class="text-decoration-line-through" style="text-decoration: line-through">
                                    {{ $data->price }}
                                </h6>
                            @else
                                <h6>{{ $data->price }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@include('home.footer')
@include('home.script')
