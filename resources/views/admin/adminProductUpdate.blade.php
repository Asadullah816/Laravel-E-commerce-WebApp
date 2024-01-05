@include('admin.adminMaster')
<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        @include('admin.adminSidebar')

        @include('admin.adminNav')


        <div class="d-flex justify-content-center w-100 align-items-center flex-column">
            <div class="card-body w-100">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h4 class="card-title">Add Product</h4>
                <p class="card-description">
                    Add the products
                </p>
                <form class="forms-sample" action="/dashboard/updateproduct/{{ $data->id }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1"> Product Title</label>
                        <input type="text" class="form-control" value="{{ $data->title }}" name="title"
                            id="exampleInputUsername1" placeholder="Product Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" value="{{ $data->description }}" class="form-control" name="description"
                            id="exampleInputEmail1" placeholder="Discription">
                    </div>
                    <div class="form-group">
                        <div class="img ">
                            <img style="width: 50px; height:50px;" src="{{ asset('storage/' . $data->image) }}"
                                alt="">
                        </div>
                        <label for="exampleInputPassword1">Image</label>
                        <input type="file" value="{{ asset('storage' . $data->image) }}" name="image">
                    </div>
                    <div class="form-group">
                        <select name="category" class="form-select" aria-label="Default select example">
                            <option selected>{{ $data->category_id }}</option>
                            @foreach ($catData as $item)
                                <option>{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1"> Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $data->quantity }}"
                            id="exampleInputUsername1" placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1"> Price</label>
                        <input type="number" class="form-control" value="{{ $data->price }}" name="price"
                            id="exampleInputUsername1" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Discount Price</label>
                        <input type="number" class="form-control" id="exampleInputUsername1"
                            value="{{ $data->discount_price }}" name="discount_price" placeholder="discount Price">
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>

    </div>
    @include('admin.adminFooter')
</div>
@include('admin.adminScript')
