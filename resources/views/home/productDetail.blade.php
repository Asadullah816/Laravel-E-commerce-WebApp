@include('Home.master')
@include('Home.header')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
<div class="container mt-5">
    <style>
        .show {
            display: block !important;
        }
    </style>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">

                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img
                                src="{{ asset('storage/' . $productDetail->image) }}" />
                        </div>
                    </div>


                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{ $productDetail->title }}</h3>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <p class="product-description">{{ $productDetail->discrition }}
                    </p>
                    @if ($productDetail->discount_price == !null)
                        <h4 class="price">Actual Price: <span>${{ $productDetail->price }}</span></h4>
                        <h4 class="price">Discount Price: <span>${{ $productDetail->discount_price }}</span></h4>
                    @endif
                    <h4 class="price">current price: <span>${{ $productDetail->price }}</span></h4>

                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87
                            votes)</strong></p>
                    <h5>Quantity:
                        <span class="size">{{ $productDetail->quantity }}</span>
                    </h5>
                    <h5 class="sizes">sizes:
                        <span class="size" data-toggle="tooltip" title="small">s</span>
                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                    </h5>
                    <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                    </h5>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<section class="">
    <div class="container py-5 my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="p-4 card-body">
                        <h4 class="pb-2 mb-4 text-center">Nested comments section</h4>
                        @forelse ($allcom as $com)
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-start">
                                        <img class="rounded-circle shadow-1-strong me-5 "
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                                            alt="avatar" width="65" height="65" />
                                        <div class=" flex-grow-1 flex-shrink-1">
                                            <div class="ms-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        {{ $com->name }} <span class="small">- 2 hours
                                                            ago</span>
                                                    </p>
                                                    <a href="#!"><i class="fas fa-reply fa-xs"></i><span
                                                            class="small reply" data-comment-id="{{ $com->id }}">
                                                            reply</span></a>
                                                </div>
                                                <p class="mb-0 small">
                                                    {{ $com->comment }}
                                                </p>
                                            </div>
                                            <div class="hiddensec d-none">
                                                <form style="width: 36rem; margin:auto;"
                                                    action="{{ route('reply', $com->id) }}" method="POST">
                                                    @csrf
                                                    @php
                                                        $commentId = $com->id;
                                                    @endphp
                                                    {{-- <input type="hidden" name="" value="{{ $com->id }}"> --}}
                                                    <div data-mdb-input-init class="mb-4 form-outline">
                                                        <textarea class="form-control" id="form4Example3" name="reply" rows="4"></textarea>
                                                        <label class="form-label" for="form4Example3">Reply</label>
                                                    </div>
                                                    <div class="mb-4 form-check d-flex justify-content-center">
                                                        <label class="form-check-label" for="form4Example4">
                                                            Type your reply here
                                                        </label>
                                                    </div>
                                                    <button data-mdb-ripple-init type="submit"
                                                        class="mb-4 btn btn-primary btn-block">Reply</button>
                                                </form>
                                            </div>

                                            @forelse ($reply as $data)
                                                <div class="mt-4 d-flex flex-start">
                                                    <a class="me-3" href="#">
                                                        <img class="rounded-circle shadow-1-strong"
                                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                                                            alt="avatar" width="65" height="65" />
                                                    </a>
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    {{ $data->name }}<span class="small">- 3
                                                                        hours
                                                                        ago</span>
                                                                </p>
                                                            </div>
                                                            <p class="mb-0 small">
                                                                {{ $data->replay }};
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <form style="width: 36rem; margin:auto;" action="{{ route('comment', $productDetail->id) }}" method="POST">
        @csrf
        <div data-mdb-input-init class="mb-4 form-outline">
            <textarea class="form-control" id="form4Example3" name="comment" rows="4"></textarea>
            <label class="form-label" for="form4Example3">Comment</label>
        </div>
        <div class="mb-4 form-check d-flex justify-content-center">
            <label class="form-check-label" for="form4Example4">
                Type your comment here
            </label>
        </div>
        <button data-mdb-ripple-init type="submit" class="mb-4 btn btn-primary btn-block">Post</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script>
    // const btn = document.querySelector('.');
    const hiddensec = document.querySelector('.hiddensec');
    $('.reply').click(function() {
        const comment_id = this.getAttribute('data-comment-id');
        // $('.reply'), preventDefault();
        $(hiddensec).toggleClass('show')
        if (!$(this).data('hiddensec')) {
            $(hiddensec).addClass('show').insertAfter($(this));

            // Mark this element to indicate that hiddensec is shown for this comment_id
            $(this).data('hiddensec', true);
        }

    });
    console.log('this function is working');
</script>
@include('Home.footer')
@include('Home.script')
