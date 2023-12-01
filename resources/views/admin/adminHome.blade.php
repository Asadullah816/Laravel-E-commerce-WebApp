@include('admin.adminMaster')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        @include('admin.adminSidebar')

        @include('admin.adminNav')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-tab">

                            <div class="mt-5 row">
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Products</p>
                                    <h3 class="pt-2 rate-percentage">{{ $data }}</h3>
                                    {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span> --}}
                                    </p>
                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Processing Orders</p>
                                    <h3 class="pt-2 rate-percentage">{{ $order }}</h3>
                                    {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> --}}
                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Customers</p>
                                    <h3 class="rate-percentage">{{ $users }}</h3>
                                    {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</mt-3 span></p> --}}
                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Revenue</p>
                                    <h3 class="rate-percentage">{{ $totalrevenue }}</h3>
                                    {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span> --}}
                                    </p>

                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Delivered Orders</p>
                                    <h3 class="rate-percentage">{{ $deliveredorder }}</h3>
                                    {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span> --}}
                                    </p>

                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Cancelled Orders</p>
                                    <h3 class="rate-percentage">{{ $cancelorder }}</h3>
                                    {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span> --}}
                                    </p>

                                </div>
                                <div class="p-5 mt-3 border shadow col-md-3">
                                    <p class="statistics-title">Total Orders</p>
                                    <h3 class="rate-percentage">{{ $totalorders }}</h3>
                                    {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!--partial:partials/_footer.html-->
        </div>
    </div>
    @include('admin.adminFooter')
</div>
@include('admin.adminScript')
