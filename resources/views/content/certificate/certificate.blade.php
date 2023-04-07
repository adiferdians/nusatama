@extends('layout.master')
@section('content')
@section('dasboard', 'active')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4" id="sapi">
        <div class="card-header py-3" style="display: flex; justify-content: space-between;">
            <div>
                <h6 class="m-0 font-weight-bold text-primary">Detil User</h6>
            </div>
            <div>
                <button class="btn btn-success" id="add" data-toggle="modal" data-target="#modal"><i class="fa fa-plus-square" title="Tambah Data"></i> Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>ID</th>
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
                            <th>ID</th>
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
                                <button class="btn btn-info" title="Detil" id="detil"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-danger" title="Hapus" onclick="delCertificate({{$cert->id}})"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td>{{$cert->id}}</td>
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
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#add').click(function() {
            axios.get('/certificate/create')
                .then(function(response) {
                    $('.modal-title').html("Tambah peserta");
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
                    text: "Data yang dihapus tidak akan bisa kembaalikan.",
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
        axios.get('/certificate/update/'+id)
            .then(function(response) {
                $('.modal-title').html("Update peserta");
                $('.modal-body').html(response.data);
                $('#myModal').modal('show');
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>

@endsection