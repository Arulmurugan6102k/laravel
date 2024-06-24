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
                <h1 class="h3 mb-0 text-gray-800">Manage Produdct</h1>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                style="margin-left: -13;">Manage</button>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-center"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('showprodtype') }}" data-target="#logoutModal">
                                PRODUCT TYPE
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
                        <form method="GET" action="{{ route('showprod') }}" id="filter-form" class="form-inline">
                            <select style="height:100%; margin-left:25px;" name="price_range" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm"
                                onchange="submitForm()">
                                <option value="">By price range</option>
                                <option value="10000" {{ request('price_range') == '10000' ? 'selected' : '' }}>10,000+
                                </option>
                                <option value="15000" {{ request('price_range') == '15000' ? 'selected' : '' }}>15,000+
                                </option>
                                <option value="20000" {{ request('price_range') == '20000' ? 'selected' : '' }}>20,000+
                                </option>
                                <option value="30000" {{ request('price_range') == '30000' ? 'selected' : '' }}>30,000+
                                </option>
                            </select>

                            <select style="height:100%;margin-left:16px;margin-right: 16px;" name="prod_status"
                                aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm"
                                onchange="submitForm()">
                                <option value="">By product status</option>
                                <option value="1" {{ request('prod_status') == '1' ? 'selected' : '' }}>active</option>
                                <option value="0" {{ request('prod_status') == '0' ? 'selected' : '' }}>
                                    <div class="status-indicator inactive">
                                        <span class="status-dot"></span>
                                        Inactive
                                    </div>
                                </option>
                            </select>

                            <div style="margin-right: 16px;" class="form-outline custom-header-content"
                                data-mdb-input-init>
                                <input type="date" onchange="submitForm()" class="form-control" name="prod_date"
                                    id="filter-form" value="{{ request('prod_date') }}" />
                            </div>

                            <div class="input-group">
                                <input type="text" name="product_search" class="form-control border-1 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                                    value="" style="
    padding-right: -30;
    padding-right: -35;
    padding-right: -40;
    margin-right: -29;
">
                                <button type="button" class="btn btn-gray" onclick="resetForm()"
                                    style="margin-left: 10px;padding-left: 0px;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;margin-right: 5px;">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                style="margin-left: 16px;height: 37.22222px;width: 130px;">
                                <a style="text-decoration: none; color: inherit;" href="{{ route('addprod') }}">
                                    <span><i class="fas fa-add"></i></span>
                                    Add Product</button>
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
                                                aria-label="Name: activate to sort column descending">No.
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Product <br> image
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product <br> name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product <br> cost</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Prod type <br> name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Release <br> date</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Current <br> version</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product <br> description</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Available <br> colors</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-content">
                                        @foreach($paginatedResults as $product)

                                                            <tr>
                                                                <td>{{ $product->id }}</td>
                                                                <td>

                                                                    <img src="{{ $product->product_image ? 'data:image/jpeg;base64,' . base64_encode($product->product_image) : asset('/resources/images/no_product.jpg') }}"
                                                                        alt="{{ $product->product_name }}" style="max-width: 50px;">
                                                                </td>
                                                                <td style="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        {{ $product->product_name }}
                                                                    </div>
                                                                </td>
                                                                <td style="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        {{ $product->product_cost }}
                                                                    </div>
                                                                </td>
                                                                <td style="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        {{ $product->product_type_name }}

                                                                    </div>
                                                                </td>
                                                </div>
                                                <td>{{ $product->release_date }}</td>
                                                <td>{{ $product->version_id }}</td>
                                                <td style="font-size:10px;">{{ $product->product_description }}</td>
                                                <td>{{ $product->available_colors }}</td>
                                                <td>
                                                    @if($product->is_active == 0)
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
                                                            <a href="{{ route('editprod', ['id' => $product->id]) }}"
                                                                class="btn btn-primary btn-circle me-2" id="{{ $product->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                        <a href="" class="btn btn-danger btn-circle" data-product-id="{{ $product->id }}"
                                                            id="delete">
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
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        {{ $paginatedResults->links() }}
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

    function resetForm() {
        // Clear all input fields
        document.querySelector('select[name="price_range"]').value = '';
        document.querySelector('input[name="product_search"]').value = '';
        document.querySelector('select[name="prod_status"]').value = '';
        document.querySelector('input[name="prod_date"]').value = '';
        // Submit the form to apply the reset
        document.getElementById('filter-form').submit();
    }

</script>
<script>
    $(document).ready(function () {
        $('#delete').on('click', function () {

            let id = $(this).data('product-id'); // Use data attribute to store product id
            if (confirm('Are you sure you want to delete?')) {
                // Assuming your delete URL structure is correct
                $("a").attr("href", "http://localhost/userloginregister/deleteproducts/" + id);
            } else {
                return false;
            }
        });
    });

</script>