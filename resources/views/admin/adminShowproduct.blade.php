@include('admin.adminMaster')
<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        @include('admin.adminSidebar')

        @include('admin.adminNav')


        <div class="d-flex justify-content-start w-100 align-items-center flex-column">
            @if (session()->has('message'))
                <div class="w-100 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('delete'))
                <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-12">
                <h3 class="mb-4 text-center h5">Product Table</h3>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product as $data)
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" checked="">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="img">
                                            <img src="{{ asset('storage/' . $data->image) }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="email">
                                            <span>{{ $data->title }}</span>
                                            <span>{{ $data->discription }}</span>
                                        </div>
                                    </td>
                                    <td>${{ $data->price }}</td>
                                    <td class="quantity">
                                        <div class="input-group">
                                            <input type="text" name="quantity"
                                                class="quantity form-control input-number" value="{{ $data->quantity }}"
                                                min="1" max="100">
                                        </div>
                                    </td>
                                    <td>${{ $data->discount_price }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button> --}}
                                        <div class="btn">
                                            <a class="text-success"
                                                href="{{ route('updateProduct', ['id' => $data->id]) }}"><i
                                                    class="fa-solid fa-pen-fancy"></i></a>
                                            <a class="text-danger"
                                                href="{{ route('productDelete', ['id' => $data->id]) }}"><i
                                                    class="fa fa-close"></i></a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                No Product Available
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('admin.adminFooter')
</div>
@include('admin.adminScript')


{{-- ================= --}}
