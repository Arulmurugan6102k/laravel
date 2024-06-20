@extends('auth.layouts')
@if(session('success'))
    <div class="alert dark alert-icon alert-success alert-dismissible alertDismissible z-index-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="icon wb-check" aria-hidden="true"></i> {{ session('success') }}
    </div>
@endif
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12 col-md-12 shadow-lg bg-body" style="border-radius:18px;">
        <div class="p-5">
            <div class="text-center h1 mb-4">EDIT PRODUCT TYPE</div>
            <div class="card-body ">
            <form action="{{ route('products.type.update', $productType->main_id) }}" method="post"id="product-form">
                    @csrf
           
            <div class="row">
                <div class="col-6 input-group-lg">
                    <label for="product-name" class="form-label">Product name</label>
                    <input type="text" class="form-control" id="product-name" name="product_type_name"
                        value="{{$productType->product_type_name}}">
                </div>
                <div class="col-6 input-group-lg">
                    <label for="product-code" class="form-label">Product code</label>
                    <input type="text" class="form-control" id="product-code" name="product_type_code"
                        value="{{$productType->product_type_code}}">
                </div>

                <div class="mt-4">
                    <div class="checkbox">
                        <label class="checkbox__container">
                            <input class="checkbox__toggle" type="checkbox" {{ $productType->is_active == '1' ? 'checked' : '' }}>
                            <span class="checkbox__checker anim"></span>
                            <label for="password_confirmation" class="form-label text-nowrap"
                                style="margin-top:50px;">Product status</label>
                            <svg class="checkbox__path" id="checkbox__path" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 248.868 99.876">
                                <path class="path path--top"
                                    d="M194.27,59.599l42.438-42.028 c-9.086-10.419-22.443-17.006-37.215-17.006c-35.529,0-46.643,27.712-75.047,27.712s-38-27.712-75.072-27.712 c-13.45,0-25.621,5.355-34.514,14.045l48.098,48.113"
                                    stroke="skyblue" stroke-width="2" />
                                <path class="path path--bottom"
                                    d="M183.561,48.822l42.521,42.794 c-7.649,4.874-16.759,7.697-26.589,7.697c-34.914,0-46.643-30.202-75.06-30.202s-35.527,30.202-75.06,30.202 c-13.431,0-25.502-5.255-34.346-13.8l47.93-48.18"
                                    stroke="skyblue" stroke-width="2" />
                            </svg>
                            <svg class="checkbox__bg" id="checkbox__bg" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 248.868 99.876">
                                <path class="shape-bg"
                                    d="M199.493,99.087c27.504,0,49.374-22.106,49.374-49.374S226.552,0.338,199.493,0.338c-35.529,0-46.643,27.712-75.047,27.712 s-38-27.712-75.072-27.712C22.048,0.338,0,22.444,0,49.713s21.826,49.374,49.374,49.374c39.533,0,46.643-30.202,75.06-30.202 S164.58,99.087,199.493,99.087z"
                                    fill="skyblue" />
                            </svg>
                        </label>
                    </div>
                </div>

                <input type="hidden" id="hidden_product_status" name="product_status" value="1">

            </div>
            <div class="d-flex justify-content-center ">
                <div class="text-center ">
                    <input type="submit" class="text-center btn btn-lg btn-success mt-4 "
                        style="margin-right:10px; width:100px;" value="Edit">
                </div>
                <div class="text-center">
                    <input id="cancelButton" type="button" class="text-center btn btn-lg btn-danger mt-4 "
                        style="margin-left:10px; width:100px;" value="Cancel">
                </div>
                <script>
                    document.getElementById('cancelButton').onclick = function () {
                        window.location.href = "{{ route('addprodtype') }}";
                    };
                </script>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.checkbox__toggle').change(function () {
            if ($(this).is(':checked')) {
                $('#hidden_product_status').val(1); // Set value to 1 when checkbox is checked
            } else {
                $('#hidden_product_status').val(0); // Set value to 0 when checkbox is unchecked
            }
        });
    });  
</script>