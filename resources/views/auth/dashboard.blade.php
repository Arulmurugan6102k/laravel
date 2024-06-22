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
<style>
    /* Hide the default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .container {
        display: block;
        position: relative;
        cursor: pointer;
        font-size: 20px;
        user-select: none;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: relative;
        top: 0;
        left: 0;
        height: 1em;
        width: 1em;
        background-color: #ccc;
        border-radius: 50%;
        transition: .4s;
    }

    .checkmark:hover {
        box-shadow: inset 17px 17px 16px #b3b3b3,
            inset -17px -17px 16px #ffffff;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        box-shadow: none;
        background-color: limegreen;
        transform: rotateX(360deg);
    }

    .container input:checked~.checkmark:hover {
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 0.35em;
        top: 0.2em;
        width: 0.25em;
        height: 0.5em;
        border: solid white;
        border-width: 0 0.15em 0.15em 0;
        box-shadow: 0.1em 0.1em 0em 0 rgba(0, 0, 0, 0.3);
        transform: rotate(45deg);
    }
</style>

<body>
    @if(session('success'))
        <div class="alert dark alert-icon alert-success alert-dismissible alertDismissible z-index-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="icon wb-check" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif

    <div id="alertBox" class="alert dark alert-icon alert-success alert-dismissible alertDismissible z-index-1 d-none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="icon wb-check" aria-hidden="true"></i> {{ session('success') }}
    Item deleted successfully.
</div>

    
    <!-- Modal for Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Excel File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="fileDetails">No file selected.</p>
                <div id="filePreview"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="importForm" class="btn btn-primary" id="importBtn">Import Data</button>
            </div>
        </div>
    </div>
</div>
    <!-- Page Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

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
                            <a class="dropdown-item " href="{{ route('showprod') }}" data-target="#logoutModal">
                                PRODUCT
                            </a>
                            <a class="dropdown-item" href="{{ route('showprodtype') }}" data-target="#logoutModal">
                                PRODUCT TYPE
                            </a>

                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle"
                                src="http://localhost/userloginregister/resources/images/undraw_profile.svg">
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
            <!-- delete Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
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
            <!-- list product Modal-->
            <div class="modal fade" id="productListModal" tabindex="-1" role="dialog"
                aria-labelledby="productListModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productListModalLabel">Product List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">id</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product image</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1">Product cost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productDetailsContainer">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

                <!-- Page Heading -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="mt-2 m-0 font-weight-bold text-primary">Order list</h6>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex justify-content-center">
                                <div>
                                <form id="importForm" action="{{route('orders.import')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" id="file-input" style="display: none;" accept=".xlsx,.xls">
                                <button type="button" class="btn btn-success btn-sm shadow-sm"
                                        style="margin-left: 16px; height: 37.22222px; width: 130px;"
                                        onclick="document.getElementById('file-input').click();">
                                    <span><i class="fa-solid fa-file-import"></i> Import</span>
                                </button>
                                </form>
                                </div>

                                <div class="me-3">
                                    <button id="export" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"
                                        style="margin-left: 16px;height: 37.22222px;width: 130px;">
                                        <a style="text-decoration: none; color: inherit;"
                                            >
                                            <span><i class="fa-solid fa-file-export"></i>
                                                Export</a></button><a style="text-decoration: none; color: inherit;"
                                        href="http://localhost/userloginregister/addprod">
                                    </a>
                                </div>

                                <form method="GET" action="http://localhost/test/userloginregister/dashboard"
                                    id="filter-form" class="form-inline">
                                    <select style="height:100%;margin-right: 16px;" name="price_range"
                                        aria-controls="dataTable"
                                        class="custom-select custom-select-sm form-control form-control-sm"
                                        onchange="submitForm()">
                                        <option value="">By price range</option>
                                        <option value="10000" {{ request('price_range') == '10000' ? 'selected' : '' }}>
                                            10,000+
                                        </option>
                                        <option value="15000" {{ request('price_range') == '15000' ? 'selected' : '' }}>
                                            15,000+
                                        </option>
                                        <option value="20000" {{ request('price_range') == '20000' ? 'selected' : '' }}>
                                            20,000+
                                        </option>
                                        <option value="30000" {{ request('price_range') == '30000' ? 'selected' : '' }}>
                                            30,000+
                                        </option>
                                    </select>

                                    <div class="input-group">
                                        <input type="text" name="product_search" class="form-control border-1 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2" value="" style="
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
                                        <a style="text-decoration: none; color: inherit;"
                                            href="http://localhost/test/userloginregister/orders/create">
                                            <span><i class="fas fa-add"></i></span>
                                            Add order</a></button><a style="text-decoration: none; color: inherit;"
                                        href="http://localhost/userloginregister/addprod">
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
                                    <form id="exportForm" action="{{ route('orders.export') }}" method="get">
                                    @csrf
                                        <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                            cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                            style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        <div>
                                                            <div>
                                                                <label class="container"
                                                                    style="padding-right: 0px;width: 73px;">
                                                                    <p style="
                                                                            margin-bottom: 5px;
                                                                            padding-left: 5px;
                                                                            width: 75px;
                                                                            font-size:15px;
                                                                            margin-right: 0px;
                                                                            margin-left: -25;
                                                                        ">Select All</p>
                                                                    <input id="selectAll" type="checkbox">
                                                                    <div class="checkmark"></div>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </th>
                                                    <th>no.</th>
                                                    <th>order number</th>
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Customer
                                                        <br> name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Customer <br> email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Customer <br> mob no</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Customer <br> country</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Product <br> type name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Products</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Total amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1">Action</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $counter = 1; // Initialize counter
                                            @endphp
                                            <tbody id="table-body-content">
                                                @foreach($paginatedResults as $order) 
                                                                                                <tr id="item-{{$order->id}}">
                                                                                               
                                                                                                    <td style="
                                                                                                        width: 56px;
                                                                                                    ">
                                                                                                        <label class="container" style="
                                                                                                        margin-left: 10px;
                                                                                                        padding-left: 15px;
                                                                                                    ">
                                                                                                    
                                                                                                    <input value="{{$order->id}}" name="order_ids[]" class="checkmark" type="checkbox" >
                                                                                                    
                                                                                                            <div class="checkmark" style="
                                                                                                        margin-top: 10px;
                                                                                                    "></div>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    
                                                                                                    <td>{{ $counter }}</td>
                                                                                                    <td>{{$order->order_no}}</td>
                                                                                                    <td>{{$order->customer_name}}</td>
                                                                                                    <td>{{$order->customer_email}}</td>
                                                                                                    <td>{{$order->customer_mob_no}}</td>
                                                                                                    <td>{{ $countries[$order->customer_country_id] ?? 'Unknown' }}</td>
                                                                                                    <td>{{$order->product_type_name}}</td>
                                                                                                    <td>

                                                                                                        <button
                                                                                                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                                                                            style="height: 37.22222px; width: 130px;"
                                                                                                            onclick="fetchOrderProductData('{{ $order->products_id }}')">
                                                                                                            <a style="text-decoration: none; color: inherit;"
                                                                                                                data-toggle="modal" data-target="#productListModal">
                                                                                                                <span><i class="fas fa-eye"></i></span> View products
                                                                                                            </a>
                                                                                                        </button>

                                                                                                    </td>
                                                                                                    <td>₹ {{$order->order_amount}}.Rs</td>
                                                                                                    <td>
                                                                                                        <div class="d-flex jsutify-content-center align-itmes-center">
                                                                                                            <div class="">
                                                                                                                <a href="{{route('orders.edit', [$order->id])}}"
                                                                                                                    class="btn btn-primary btn-circle me-2" id="">
                                                                                                                    <i class="fas fa-edit"></i>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                            <a href="{{ route('orders.generatePdf', [$order->id, $order->products_id,]) }}"
                                                                                                                class="btn btn-warning btn-circle me-2" id="">
                                                                                                                <i class='fa-solid fa-file-pdf'></i>
                                                                                                            </a>
                                                                                                            <a href="#" class="btn btn-danger btn-circle delete-button"
                                                                                                                id="{{ $order->id }}">
                                                                                                                <i class="fas fa-trash"></i>
                                                                                                            </a>
                                                                                                        </div>
                                                                                    </div>
                                                                                    </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $counter++; // Increment counter after each row
                                                                                    @endphp
                                               
                                                @endforeach
                                    </tbody>
                                    </table>
                                    </form>
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
    </div>

    </div>


    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/bootstrap.bundle.js"></script>

    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.easing.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/sb-admin-2.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        $('#export').click(function() {
        $('#exportForm').submit();
        console.log($('#exportForm').val());
    });

        // reset the filter 
        function resetForm() {
            $('select[name="price_range"]').val('');
            $('input[name="product_search"]').val('');
            $('#filter-form').submit();
        }

        // submit form after change
        function submitForm() {
            $('#filter-form').submit();
        }

        // fetching the view products button data
        function fetchOrderProductData(productIds) {
            // Split the comma-separated IDs into an array
            var idsArray = productIds.split(',').map(id => id.trim());
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // AJAX call to fetch data
            $.ajax({
                url: '{{ route("fetchProducts") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    ids: idsArray
                },
                success: function (response) {
                    console.log('Response received:', response);
                    $('#productDetailsContainer').empty(); // Clear 
                    // Iterate over products and prepare rows
                    $.each(response.products, function (index, product) {
                        var row = `
                    <tr>
                        <td>${product.id}</td>
                        <td><img src="data:image/jpeg;base64, ${product.product_image}" alt="${product.product_name}" style="width: 70px; height: auto;" /></td>
                        <td>${product.product_name}</td>
                        <td>${product.product_cost}</td>
                    </tr>
                `;
                        $('#productDetailsContainer').append(row);
                    });
                    // Calculate total product cost
                    var totalProductCost = response.products.reduce((total, product) => total + parseFloat(product.product_cost), 0);
                    // Append total row after iterating through products
                    var totalRow = `
                <tr>
                    <td colspan="2"></td>
                    <td>Total Product Cost:</td>
                    <td>${totalProductCost.toFixed(2)}</td>
                </tr>
            `;
                    $('#productDetailsContainer').append(totalRow);
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error fetching products:', error);
                    $('#productDetailsContainer').html('<p>Error fetching products. Please try again later.</p>');
                }
            });
        }

        $(document).ready(function () {

            $('#selectAll').click(function(){
            if (this.checked) {
                $(".checkmark").prop("checked", true);
            } else {
                $(".checkmark").prop("checked", false);
            }	
        });

        $('.delete-button').on('click', function() {
            var id = $(this).attr('id')
            // console.log(id)
            var row = $('#item-' + id);

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({ 
                    url: 'orders/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        row.remove();
                        $('#alertBox').removeClass('d-none')
                           
                    },
                    error: function(xhr) {
                        
                        alert('Failed to delete item.');
                    }
                });
            }
        });

        });
    </script>

<script>
   // Show preview modal and file details when file is selected
    $('#file-input').change(function(e) {
        var file = e.target.files[0];
        if (file) {
            var fileName = file.name;
            var fileSize = file.size;
            var fileType = file.type;
            $('#fileDetails').html(`
                File: ${fileName}<br>
                Size: ${fileSize} bytes<br>
                Type: ${fileType}
            `);
            

            var reader = new FileReader();
            reader.onload = function(e) {
                var data = e.target.result;
                // Display preview if needed
                // Example: $('#filePreview').html('<pre>' + data + '</pre>');
            };
            reader.readAsText(file);

            // Show the modal
            $('#previewModal').modal('show');
        } else {
            $('#fileDetails').html('No file selected.');
        }
    });

    // Handle form submission when Import Data button is clicked
    $('#importBtn').click(function() {
        $('#importForm').submit(); // Submit the form
    });

    // Close modal on cancel button click
    $('#previewModal').on('hidden.bs.modal', function (e) {
        $('#file').val(''); // Clear file input
    });

</script>



</body>

</html>