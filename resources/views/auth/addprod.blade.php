<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="http://localhost/userloginregister/resources/css/app.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/all.css" rel="stylesheet">
    <link href="http://localhost/userloginregister/resources/css/dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.easing.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/sb-admin-2.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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

    #image {
        max-width: 100%;
        max-height: 100%;
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
                    <div class="text-center h1 mb-4">ADD PRODUCT</div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="croppedImageData" name="cropped_image_data">
                            <div class="row">
                                <!-- Product name -->
                                <div class="col-6 mb-3">
                                    <label for="product-name" class="form-label">Product name</label>
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                        id="product-name" name="product_name" value="{{ old('product_name') }}">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                                <!-- Product cost -->
                                <div class="col-6 mb-3">
                                    <label for="product-cost" class="form-label">Product cost</label>
                                    <input type="text" class="form-control @error('product_cost') is-invalid @enderror"
                                        id="product-cost" name="product_cost" value="{{ old('product_cost') }}">
                                    @if ($errors->has('product_cost'))
                                        <span class="text-danger">{{ $errors->first('product_cost') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <!-- Product type -->
                                <div class="col-4 mb-3">
                                    <label for="product-type-name" class="form-label">Product type</label>
                                    <select class="form-control @error('product_type_name') is-invalid @enderror"
                                        id="product-type-name" name="product_type_name">
                                        <option value="" selected>Select product</option>
                                        @foreach($productsType as $productType)
                                            <option value="{{ $productType->main_id }}">
                                                {{ $productType->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_type_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Release date -->
                                <div class="col-4 mb-3">
                                    <label for="release-date" class="form-label ">Release date</label>
                                    <input type="date" class="form-control @error('release_date') is-invalid @enderror"
                                        id="release-date" name="release_date" value="{{ old('release_date') }}">
                                    @if ($errors->has('release_date'))
                                        <span class="text-danger">{{ $errors->first('release_date') }}</span>
                                    @endif
                                </div>
                                <!-- Current version -->
                                <div class="col-4 mb-3">
                                    <label class="form-label d-block">Current version</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="current_version" id="radio-1"
                                            value="1.0" checked>
                                        <label class="form-check-label" for="radio-1">1.0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="current_version" id="radio-2"
                                            value="2.0">
                                        <label class="form-check-label" for="radio-2">2.0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="current_version" id="radio-3"
                                            value="3.0">
                                        <label class="form-check-label" for="radio-3">3.0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="current_version" id="radio-4"
                                            value="4.0">
                                        <label class="form-check-label" for="radio-4">4.0</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Available colors -->
                                <div class="col-6 mb-3">
                                    <label for="available-colors" class="form-label">Available colors</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="available_colors[]"
                                            id="color-black" value="Black" checked>
                                        <label class="form-check-label" for="color-black">Black</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="available_colors[]"
                                            id="color-white" value="White">
                                        <label class="form-check-label" for="color-white">White</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="available_colors[]"
                                            id="color-blue" value="Blue">
                                        <label class="form-check-label" for="color-blue">Blue</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="available_colors[]"
                                            id="color-orange" value="Orange">
                                        <label class="form-check-label" for="color-orange">Orange</label>
                                    </div>
                                </div>
                                <!-- Product image -->
                                <div class="col-6 mb-3">
                                    <div>
                                        <img class="img-profile rounded-circle" id="product-image"
                                            style="width: 75px; margin-left:13px;"
                                            src="http://localhost/userloginregister/resources/images/undraw_profile.svg">
                                    </div>
                                    <label for="product-image" class="form-label">Product image</label>
                                    <input type="file" class="form-control" id="product-image-upload"
                                        name="product_image">
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="product-description" class="form-label">Description</label>
                                <textarea class="form-control @error('product_description') is-invalid @enderror"
                                    id="product-description" name="product_description" rows="3"></textarea>
                                @if ($errors->has('product_description'))
                                    <span class="text-danger">{{ $errors->first('product_description') }}</span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-success me-2">Add</button>
                                <button type="button" class="btn btn-lg btn-danger ms-2"
                                    id="cancelButton">Cancel</button>
                            </div>
                            <script>
                                document.getElementById('cancelButton').onclick = function () {
                                    window.location.href = "{{ route('showprod') }}";
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

    <script>
    $(document).ready(function () {
        var image = document.getElementById('image');
        var input = $('#product-image-upload');
        var modalTitle = $('#cropModalLabel');
        var cropper;

        input.on('change', function (e) {
            var files = e.target.files;
            var reader = new FileReader();
            reader.onload = function () {
                var imgURL = reader.result;
                image.src = imgURL;
                if (cropper) {
                    cropper.replace(imgURL);
                } else {
                    $('#cropModal').on('shown.bs.modal', function () {
                        cropper = new Cropper(image, {
                            viewMode: 1,
                            dragMode: 'crop',
                            autoCropArea: 0.5,
                            restore: false,
                            guides: false,
                            center: false,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                        });
                    }).modal('show');
                }
                modalTitle.html('Crop Image');
            }
            reader.readAsDataURL(files[0]);
        });

        $('#cropModal').on('hidden.bs.modal', function () {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });

        $('#crop-button').on('click', function () {
            var canvas = cropper.getCroppedCanvas();
            canvas.toBlob(function (blob) {
                var formData = new FormData($('#productForm')[0]);

                // Convert blob to base64 to store as value
                var reader = new FileReader();
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $('#croppedImageData').val(base64data); // Set base64 data as value of hidden input
                    // Set the cropped image as the source of the product-image img tag
                    $('#product-image').attr('src', base64data);
                };
                reader.readAsDataURL(blob);

                $('#cropModal').modal('hide');
            });
        });
    });
</script>


</body>

</html>