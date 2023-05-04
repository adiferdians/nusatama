<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- Axios CDN-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Sweetalert CDN-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" value="admin" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" value="sapiii" id="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button id="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>


<script>
    $('#submit').on('click', function(submit) {
        const email = $('#email').val();
        const password = $('#password').val();

        axios.post('/login', {
            email,
            password
        }).then(response => {
            if (response.data.OUT_STAT) {
                localStorage.setItem('token', response.data.token);
                Swal.fire({
                    text: response.data.MESSAGE,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000,
                    customClass: {
                        icon: 'my-custom-icon-class'
                    }
                }).then((result) => {
                    window.location.href = "dashboard";
                })
            } else {
                Swal.fire({
                    text: response.data.MESSAGE,
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                    width: '400px',
                })
            }
        });
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="{{ URL::asset('/assets/vendor/jquery/jquery.min.js' ) }}"></script>
<script src="{{ URL::asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('/assets/vendor/jquery-easing/jquery.easing.min.js' ) }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ URL::asset('/assets/js/sb-admin-2.min.js' ) }}"></script>

</html>