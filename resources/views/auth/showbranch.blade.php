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

                <h1 class="h3 mb-0 text-gray-800">branch</h1>

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
                <h6 class="mt-2 m-0 font-weight-bold text-primary">Branch list</h6>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                    <form method="GET" action="{{ route('showprodtype') }}" id="filter-form" class="form-inline">
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
                                <a style="text-decoration: none; color: inherit;" href="{{ route('branches.create') }}">
                                <span><i class="fas fa-add"></i></span>
                                Add Branch</button>
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
                                            <th>no.</th>
                                            <th>branch name</th>
                                            <th>branch prefix</th>
                                            <th>Action</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                         @foreach($branches as $branch )
                                                        <tr>
                                                       
                                                            <td>1</td>
                                                            <td>{{$branch->branch_name}}</td>
                                                            <td>{{$branch->branch_prefix}}</td>
                                                            <td>
                                                                <div class="d-flex jsutify-content-center align-itmes-center">
                                                                    <div class="">
                                                                        <a id="{{$branch->id}}" href="{{ route('branches.edit', $branch->id ) }}"
                                                                            class="btn btn-primary btn-circle me-2">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                    <a href="" class="btn btn-danger btn-circle delete-product" data-product-id="{{ $branch->id }}"
                                                                    id="delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                </div>
                                                                </td>
                                            </td>
                                            </tr>
                                            @endforeach
                            </tbody>
                            </table>
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



</body>

</html>

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }
</script>
<script>
  $(document).ready(function () {
        $('.delete-product').on('click', function (e) {
            e.preventDefault(); 
            let productId = $(this).data('product-id');
            let deleteUrl = "{{ url('/branches') }}" + '/' + productId;

            if (confirm('Are you sure you want to delete?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>



