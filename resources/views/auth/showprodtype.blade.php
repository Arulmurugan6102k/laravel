<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/all.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="http://localhost/userloginregister/resources/css/app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/all.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>
    @if(session('success'))
        <div class="alert dark alert-icon alert-success alert-dismissible alertDismissible z-index-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="icon wb-check" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <!-- Page Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <h1 class="h3 mb-0 text-gray-800">product type</h1>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-center"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item " href="{{ route('addprod') }}" data-target="#logoutModal">
                            ADD ORDER
                            </a>
                            <a class="dropdown-item" href="{{ route('addprodtype') }}" data-target="#logoutModal">
                                MANAGE ORDER
                            </a>

                        </div>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button href="#"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="margin-left: -13;" >Manage</button>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-center"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('showprod') }}" data-target="#logoutModal">
                            PRODUCT
                            </a>
                            <a class="dropdown-item" href="{{ route('dashboard') }}" data-target="#logoutModal">
                                DASHBOARD
                            </a>

                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle"
                                src="http://localhost/userloginregister/resources/images/undraw_profile.svg ">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- delete Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="mt-2 m-0 font-weight-bold text-primary">Product list</h6>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                    <form method="GET" action="{{ route('showprodtype') }}" id="filter-form" class="form-inline">
                            <select style="height:100%;margin-left:16px;margin-right: 16px;" name="prod_status" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm"
                                onchange="submitForm()">
                                <option value="">By product status</option>
                                <option value="1" {{ request('prod_status') == '1' ? 'selected' : '' }}>active</option>
                                <option value="0" {{ request('prod_status') == '0' ? 'selected' : '' }}>inactive</option>
                            </select>

                            <div class="input-group">
                                <input type="text" name="product_search" class="form-control border-1 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                                    value="{{ request('product_search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div>
                        <button
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="margin-left: 16px;height: 37.22222px;width: 155px;" >
                                <a style="text-decoration: none; color: inherit;" href="{{ route('addprodtype') }}">
                                <span><i class="fas fa-add"></i></span>
                                Add Product type</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Product name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product code</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productsType as $productType)
                                                        <tr>
                                                            <td>{{ $productType->product_type_name }}</td>
                                                            <td>{{ $productType->product_type_code }}</td>
                                                            <td>
                                                                @if($productType->is_active === 0)
                                                                    <div class="status-indicator inactive">
                                                                        <span class="status-dot"></span>
                                                                        Inactive
                                                                    </div>
                                                                @else
                                                                    <div class="status-indicator active">
                                                                        <span class="status-dot"></span>
                                                                        active
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex jsutify-content-center align-itmes-center">
                                                                    <div class="">
                                                                        <a href="{{ route('editprodtype', ['id' => $productType->main_id]) }}"
                                                                            class="btn btn-primary btn-circle me-2">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                    <a href="{{ route('products.type.delete', ['id' => $productType->main_id]) }}"
                                                                        class="btn btn-danger btn-circle">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                            </div>
                                            </td>
                                            </tr>
                                        @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-7 ">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                <ul class="pagination d-flex justify-content-center align-items-center">

                                    <li class="paginate_button page-item active "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item  "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item  "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="1" tabindex="0" class="page-link">3</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>



    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.easing.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/sb-admin-2.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>



</body><!-- Bootstrap core JavaScript-->

</html>

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }
</script>
<script>
$(document).ready(function() {
    $('#delete').on('click', function() {
        // Assuming you want to get the id of the product to be deleted
        let id = $(this).data('product-id'); // Use data attribute to store product id
        if(confirm('Are you sure you want to delete?')) {
            // Assuming your delete URL structure is correct
            $("a").attr("href", "http://localhost/userloginregister/deleteproducts/" + id);
        } else {
            return false;
        }
    });
});

</script>



