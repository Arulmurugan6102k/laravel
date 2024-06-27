<html lang="en">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
<link type="text/css" rel="stylesheet" id="dark-mode-general-link">
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

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
    /* The switch - the box around the slider */
    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 62px;
        height: 35px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 1;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0px;
        background: #fff;
        transition: .4s;
        border-radius: 30px;
        border: 1px solid #ccc;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.9em;
        width: 1.9em;
        border-radius: 16px;
        left: 1.2px;
        top: 0;
        bottom: 0;
        background-color: white;
        box-shadow: 0 2px 5px #999999;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #5fdd54;
        border: 1px solid transparent;
    }

    input:checked+.slider:before {
        transform: translateX(1.5em);
    }
</style>

<body class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->

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
    <div class="container-fluid" style="margin-top: 30px;">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-center">
                <h6 class="mt-2 m-0 font-weight-bold text-primary">Edit branch products</h6>
                <div class="d-flex justify-content-center"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form id="product-branch-form">
                        @csrf
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                        cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>no.</th>
                                                <th>products name</th>
                                                @foreach ($branchName as $branch)
                                                    <th>{{ $branch->branch_prefix }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productTypeName as $index => $productType)
                                                                                    <tr>
                                                                                        <td>{{$index+1}}</td>
                                                                                        <td>{{ $productType->product_type_name }}</td>
                                                                                        @foreach ($branchName as $branch)
                                                                                                                                    <td>
                                                                                                                                        <label class="switch">
                                                                                                                                            @php
                                                                                                                                                $status = $ProductBranches->first(function ($status) use ($productType, $branch) {
                                                                                                                                                    return $status->product_type_id === $productType->main_id && $status->branch_id === $branch->id;
                                                                                                                                                });
                                                                                                                                            @endphp
                                                                                                                                            <input
                                                                                                                                                id="product-{{ $productType->main_id }}-branch-{{ $branch->id }}"
                                                                                                                                                type="checkbox"
                                                                                                                                                data-product-id="{{ $productType->main_id }}"
                                                                                                                                                data-branch-id="{{ $branch->id }}"
                                                                                                                                                {{ $status && $status->status == 1 ? 'checked' : '' }}>
                                                                                                                                            <span class="slider">
                                                                                                                                            </span>
                                                                                                                                        </label>
                                                                                                                                    </td>
                                                                                        @endforeach
                                                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center ">
                                <div class="text-center ">
                                    <input type="submit" class="text-center btn btn-lg btn-success mt-4 "
                                        style="margin-right:10px; width:100px;" value="Add">
                                </div>
                                <div class="text-center">
                                    <input id="cancelButton" class="text-center btn btn-lg btn-danger mt-4 "
                                        style="margin-left:10px; width:100px;" value="Cancel">
                                </div>
                                <script>
                                    document.getElementById('cancelButton').onclick = function () {
                                        window.location.href = "http://localhost/test/userloginregister/productsbranches";
                                    };
                                </script>
                            </div>
                        </div>
                    </form>
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







    <script>
        function submitForm() {
            document.getElementById('filter-form').submit();
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#delete').on('click', function () {
                
                let id = $(this).data('product-id'); 
                if (confirm('Are you sure you want to delete?')) {
                    
                    $("a").attr("href", "http://localhost/userloginregister/deleteproducts/" + id);
                } else {
                    return false;
                }
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#product-branch-form').on('submit', function (event) {
                event.preventDefault();

                var products = [];

                $('input[type=checkbox]').each(function () {
                    var product_id = $(this).data('product-id');
                    var branch_id = $(this).data('branch-id');
                    var status = $(this).is(':checked') ? 1 : 0;

                    products.push({
                        product_id: product_id,
                        branch_id: branch_id,
                        status: status
                    });


                });
                console.log(products)
                $.ajax({
                    url: '{{ route("productsbranches.store") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        products: products
                    },
                    success: function (response) {
                        alert('Product branches updated successfully!');
                        $(location).attr('href', 'http://localhost/test/userloginregister/productsbranches');
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        alert('An error occurred while updating product branches.');
                    }
                });
            });
        });
    </script>
</body>

</html>