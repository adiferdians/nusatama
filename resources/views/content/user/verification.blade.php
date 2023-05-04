<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nusatama</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logo1.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Axios CDN-->
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('/assets/css/certificate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div>
                    <img class="inverted" src="{{ asset('assets/img/logo/logo white.png') }}" alt="">
                </div>
            </nav>
            <div class="contentVerif">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Masukan Data Peserta</h1>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama Peserta" id="nama" aria-label="Nama Peserta" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nomor Sertifikat" id="nomor" aria-label="Nomor Sertifikat" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-id-card"></i></span>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="send">Verifikasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6 mb-4" id="dataPeserta">
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Informasi Peserta</h1>
                        </div>
                        <div class="card shadow mb-4" id="sapi">
                            <div class="card-body">
                                <table class="table table-responsive" id="dataTable" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>Tipe Training</th>
                                            <th>Title Training</th>
                                            <th>Nomor Sertifikat</th>
                                            <th>Training Mulai</th>
                                            <th>Training Selesai</th>
                                            <th>Tanggal Sertifikat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($certificate))
                                        <tr>
                                            <td>{{$certificate[0]['name']}}</td>
                                            <td>{{$certificate[0]['type']}}</td>
                                            <td>{{$certificate[0]['title']}}</td>
                                            <td>{{$certificate[0]['number']}}</td>
                                            <td>{{$certificate[0]['start']}}</td>
                                            <td>{{$certificate[0]['end']}}</td>
                                            <td>{{$certificate[0]['date']}}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer bg-white" style="height: 100px;">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Nusatama Corp</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</body>
<script>
    $('#send').click(function() {
        let nama = $('#nama').val();
        let nomor = $('#nomor').val();
        let newNumber = nomor.split("/");
        axios.post(`/verifikasi`, {
            nama,
            newNumber
        }).then((response) => {
            if (response.data.OUT_STAT) {
                Swal.fire({
                    title: response.data.MESSAGE,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    width: '400px',
                    timer: 1500
                }).then(function() {
                    var data = response.data.DATA;
                    var tableBody = $('#dataTable tbody');
                    tableBody.empty();
                    var row = '<tr>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' + data.type + '</td>' +
                        '<td>' + data.title + '</td>' +
                        '<td>' + data.number + '</td>' +
                        '<td>' + data.start + '</td>' +
                        '<td>' + data.end + '</td>' +
                        '<td>' + data.date + '</td>' +
                        '</tr>';
                    tableBody.append(row);
                })
            } else {
                Swal.fire({
                    title: response.data.MESSAGE,
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    width: '400px',
                    timer: 1500
                }).then(function() {
                    var tableBody = $('#dataTable tbody');
                    tableBody.empty();
                })
            }
        }).catch((err) => {
            Swal.fire({
                position: 'top-end',
                text: err,
                icon: 'error',
                showConfirmButton: false,
                width: '400px',
                timer: 1500
            })
        })
    })
</script>

</html>