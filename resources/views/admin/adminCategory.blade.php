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
                <h4 class="card-title">Add Category</h4>
                <p class="card-description">
                    Add a category of the Product.
                </p>
                <form class="forms-sample" action="/dashboard/add_category" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Category</label>
                        <input type="text" class="form-control" name="category_name" id="exampleInputUsername1"
                            placeholder="Username">
                        @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Add</button>

                </form>
            </div>

            <div class="card-body w-100">
                <h4 class="card-title">Basic Table</h4>
                <p class="card-description">
                    Add class <code>.table</code>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->category_name }}</td>
                                    <td><a class="text-decoration-none text-danger"
                                            href="{{ route('deleteCategory', ['id' => $item->id]) }}">Delete</a></td>
                                </tr>
                            @empty
                                NO data found
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
