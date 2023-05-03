@extends('layout.master')
@section('content')
@section('certificate', 'active')
@section('title', 'Certificate')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Certificate</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4" id="sapi">
        <div class="card-header py-3" style="display: flex; justify-content: space-between;">
            <div>
                <h6 class="m-0 font-weight-bold text-primary">Detil User</h6>
            </div>
            <div>
                <button class="btn btn-success" id="add" data-toggle="modal" data-target="#modal"><i class="fa fa-plus-square" title="Tambah Data"></i> Data Sertifikat</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow: hidden;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="actionWidth">Action</th>
                            <th>Nama</th>
                            <th>Tipe Trining</th>
                            <th>Title</th>
                            <th>Nomor Sertifikat</th>
                            <th>Training Mulai</th>
                            <th>Training Selesai</th>
                            <th>Tanggal Sertifikat</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Nama</th>
                            <th>Tipe Trining</th>
                            <th>Title</th>
                            <th>Nomor Sertifikat</th>
                            <th>Training Mulai</th>
                            <th>Training Selesai</th>
                            <th>Tanggal Sertifikat</th>
                        </tr>
                    </tfoot>
                    @foreach($certificate as $cert)
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn btn-primary" title="Edit" id="update" onclick="updCertificate({{$cert->id}})"><i class="fas fa-pencil-ruler"></i></button>
                                <button class="btn btn-info" title="Detil" id="detil" onclick="detCertificate({{$cert->id}})"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-danger" title="Hapus" onclick="delCertificate({{$cert->id}})"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td>{{$cert->name}}</td>
                            <td>{{$cert->type}}</td>
                            <td>{{$cert->title}}</td>
                            <td>{{$cert->number}}</td>
                            <td>{{$cert->start}}</td>
                            <td>{{$cert->end}}</td>
                            <td>{{$cert->date}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="row">
                    <div class="col-md-12">
                        {{ $certificate->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#add').click(function() {
            axios.get('/certificate/create')
                .then(function(response) {
                    $('.modal-title').html("Tambah Certificate");
                    $('.modal-body').html(response.data);
                    $('#myModal').modal('show');
                })
                .catch(function(error) {
                    console.log(error);
                });
        })
    });

    function delCertificate(id) {
        axios.post('/certificate/delete/' + id)
            .then((response) => {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak akan bisa kembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((response) => {
                    location.reload();
                })
            }).catch((err) => {
                Swal.fire({
                    title: 'Error',
                    position: 'top-end',
                    icon: 'error',
                    text: err,
                    showConfirmButton: false,
                    width: '400px',
                    timer: 1500
                })
            })
    }

    function updCertificate(id) {
        axios.get('/certificate/update/' + id)
            .then(function(response) {
                $('.modal-title').html("Update Certificate");
                $('.modal-body').html(response.data);
                $('#myModal').modal('show');
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function detCertificate(id) {
        window.location.href = "/certificate/detil/" + id;
    }
</script>

@endsection