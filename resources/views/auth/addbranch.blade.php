<html lang="en">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
<link type="text/css" rel="stylesheet" id="dark-mode-general-link">
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

<head>
    <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
    <link type="text/css" rel="stylesheet" id="dark-mode-general-link">
    <style lang="en" type="text/css" id="dark-mode-custom-style"></style>
    <style lang="en" type="text/css" id="dark-mode-native-style"></style>
    <style lang="en" type="text/css" id="dark-mode-native-sheet"></style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User registration</title>
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
    <div class="container" style="
    margin-top: 5%;
">

        <div class="row justify-content-center mt-5">
            <div class="col-md-12 col-md-12 shadow-lg bg-body" style="border-radius:18px;">
                <div class="p-5">
                    <div class="text-center h1 mb-4">ADD BRANCH</div>
                    <form action="{{ route('branches.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 input-group-lg">
                            <label for="branch-name" class="form-label">Branch name</label>
                            <input type="text" class="form-control" id="branch-name" name="branch_name">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: 30px;">
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
                                window.location.href = "http://localhost/test/userloginregister/branches";
                            };
                        </script>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/jquery.easing.js"></script>
    <script type="text/javascript" src="http://localhost/userloginregister/resources/js/sb-admin-2.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


</body>

</html>