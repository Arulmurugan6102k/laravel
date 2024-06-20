<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="http://localhost/userloginregister/resources/css/app.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/all.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.easing.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/sb-admin-2.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--  cropper css     -->
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet">
    <!--  cropper js     -->
    <script src="https://unpkg.com/cropperjs"></script>

</head>
<style>
    .img-container {
        width: 100%;
        height: 70vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

      select {
            width: 200px;
            padding: 5px;
        }

        option {
            padding: 5px;
            background-repeat: no-repeat;
            background-position: left center;
            padding-left: 25px; /* Adjust based on image size */
        }

    .modal-dialog {
        max-width: 90vw;
    }

    .modal-body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }

    #profile-image {
        width: 400px;
        height: 400px;
    }
</style>

<body>
    @if(session('success'))
        <div class="alert dark alert-icon alert-success alert-dismissible alertDismissible z-index-100" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="icon wb-check" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 shadow-lg bg-body" style="border-radius:18px;">
                <div class="p-5">
                    <div class="text-center h1 mb-4">ADD ORDER</div>
                    <div class="card-body">
                        <form  id="orderForm" action="{{ route('orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
                        @csrf  
                        
                        <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <!-- Product name -->
                                <div class="col-6 mb-3">
                                    <label for="customer-name" class="form-label">customer name</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                        id="customer-name" name="customer_name" value="{{ $order->customer_name}}">
                                    @if ($errors->has('customer_name'))
                                        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                                    @endif
                                </div>
                                <!-- Product cost -->
                                <div class="col-6 mb-3">
                                    <label for="customer-email" class="form-label">customer email</label>
                                    <input type="text" class="form-control @error('customer_email') is-invalid @enderror"
                                        id="customer-email" name="customer_email" value="{{ $order->customer_email}}">
                                    @if ($errors->has('customer_email'))
                                        <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <!-- Product type -->
                                <div class="col-6 mb-3">
                                    <label for="mobile-no" class="form-label">mobile number</label>
                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                        id="mobile-no" name="mobile_no" value="{{ $order->customer_mob_no}}">
                                    @if ($errors->has('mobile_no'))
                                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                    @endif
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="country-id" class="form-label">country</label>
                                    <select class="form-control @error('country_id') is-invalid @enderror"
                                        id="country-id" name="country_id">
                                        <option value="" selected>Select country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $country->id == $order->customer_country_id ? 'selected' : '' }}>
                                        {{ $country->name }} - {{ $country->code }}
                                    </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- Product type -->
                                <div class="col-6 mb-3">
                                    <label for="prod-type-id" class="form-label">product types</label>
                                    <select class="form-control @error('prod_type_id') is-invalid @enderror"
                                        id="prod-type-id" name="prod_type_id">
                                        <option value="" selected>Select type</option>
                                        @foreach ($productTypesName as $productTypeName)
                                            <option value="{{$productTypeName->main_id}}" {{ $productTypeName->main_id == $order->product_type_id ? 'selected' : '' }}>
                                                {{$productTypeName->product_type_name}}</option>
                                        @endforeach
                                    </select>

                                    @error('prod_type_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- avaialbe products -->
                                <div class="col-6 mb-3">
                                    <label for="products-id" class="form-label">available products</label>
                                    <select class="form-control @error('products_id') is-invalid @enderror"
                                        id="products-id" name="products_id[]" multiple="multiple">
                                        <option value="">Select product</option>

                                    </select>
                                    @error('products_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row d-flex justify-content-center align-items-center mb-3"
                                    style="margin-left:2px;">
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <label for="product_cost" class="form-label">Total amount</label>
                                        </div>
                                        <input type="number" class="form-control" id="product-cost" name="product_cost">
                                       </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-success me-2"
                                        style="width:100px;">Update</button>
                                    <button type="button" class="btn btn-lg btn-danger ms-2"
                                        id="cancelButton">Cancel</button>
                                </div>
                                <script>
                                    document.getElementById('cancelButton').onclick = function () {
                                        window.location.href = "{{ route('gotodashboard') }}";
                                    };
                                </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop-button">Crop</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('#products-id').select2({
        placeholder: "Select product"
    });

    $(document).ready(function () {
        var storedProductIds = @json($storedProductIds);
        console.log('is' + storedProductIds)
    // Function to populate the products based on the selected prod-type-id
    function populateProducts(prod_type_name_id, ) {
        $.ajax({
            url: "{{ route('orders.create') }}", // Ensure this route is correct
            type: "GET",
            data: {
                prod_type_name_id: prod_type_name_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (result) {
                $('#products-id').empty(); // Clear existing options
                console.log(result);
                $.each(result, function (index, product) {
                    var isSelected = storedProductIds.includes(product.id.toString()) ? 'selected' : '';
                    $('#products-id').append('<option data-price="' + product.product_cost + '" value="' + product.id + '" ' + isSelected + '>' + product.product_name + ' </option>');
                });
                // Trigger change to update other dependent fields if necessary
                $('#products-id').trigger('change');
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
            }
        });
    }

    // On document ready, check if there is a selected prod-type-id and populate products
    var initialProdTypeId = $('#prod-type-id').val();
    if (initialProdTypeId) {
        populateProducts(initialProdTypeId);
    }

    // Event handler for change event on prod-type-id
    $('#prod-type-id').on('change', function () {
        var prod_type_name_id = $(this).val();
        console.log(prod_type_name_id);
        populateProducts(prod_type_name_id);
    });

    // Event handler for change event on products-id to calculate the total price
    $('#products-id').on('change', function () {
        console.log($(this).val())
        var selectedOptions = $(this).find('option:selected').map(function () {
            return $(this).data('price');
        }).get();
        var total = selectedOptions.reduce(function (a, b) {
            return a + b;
        }, 0);
        $('#product-cost').val(total);
    });
});
});

</script>

<script>
    document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault();
        this.submit();
    });
</script>
