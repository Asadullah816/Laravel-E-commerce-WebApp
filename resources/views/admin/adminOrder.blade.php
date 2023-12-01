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
                <h3 class="mb-4 text-center h5">Orders table</h3>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                {{-- <th>&nbsp;</th>
                                <th>&nbsp;</th> --}}
                                <th>Name</th>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delievery Status</th>
                                <th>Image</th>
                                <th>Operations</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order as $data)
                                <tr class="alert" role="alert">


                                    <td>
                                        <div class="email">
                                            <span>{{ $data->name }}</span>

                                        </div>
                                    </td>
                                    <td>{{ $data->title }}</td>

                                    <td>${{ $data->discount_price ? $data->discount_price : $data->price }} </td>
                                    <td>{{ $data->payment_status }} </td>
                                    <td>{{ $data->delivery }} </td>
                                    <td>
                                        <div class="img">
                                            <img src="{{ asset('storage/' . $data->image) }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <button type="button" class="btn close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                        <div class="btn"> --}}
                                        <a class="text-success"
                                            href="{{ route('deliverd', ['id' => $data->id]) }}">Deliverd<i
                                                class="fa-solid fa-pen-fancy"></i></a>
                                        <a class="text-danger"
                                            href="{{ route('download_pdf', ['id' => $data->id]) }}">DownLoad<i
                                                class=""></i></a>
                                        <a class="text-primary" href="{{ route('sendemail', $data->id) }}">Send Email<i
                                                class=""></i></a>

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
