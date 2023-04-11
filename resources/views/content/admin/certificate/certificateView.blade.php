@extends('layout.master')
@section('content')
@section('certificate', 'active')

<div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-right: 20px;">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <button onclick="showQrCode('{{$certificate[0]['number']}}', '{{$certificate[0]['name']}}')" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" id="QRcode">
        <i class="fas fa-eye"></i>   Show QR Code</button>
</div>
@foreach($certificate as $cert)
<div class="certif">
    <center>
        <div class="contentCert">
            <div class="logo">
                Organization
            </div>
            <div class="marquee">
                Certificate of Completion {{$cert->title}}
            </div>
            <div class="period">
                <div class="start">
                    <span>Start</span>
                    <span>{{$cert->start}}</span>
                </div>
                <div class="start">
                    <span>End</span>
                    <span>{{$cert->end}}</span>
                </div>
            </div>
            <div class="assignment">
                This certificate is presented to
            </div>
            <div class="person">
                {{$cert->name}}
            </div>
            <div class="reason">
                For deftly defying the laws of gravity<br />
                and flying high
            </div>
            <div class="reason">
                {{$cert->date}}
            </div>
        </div>
    </center>
</div>
<div class="back">
    <button class="btn btn-secondary" id="back"><i class="fa fa-arrow-left"></i> Kembali </a></button>
</div>
@endforeach
<script>
    $('#back').click(function() {
        window.location.href = "/certificate";
    })

    function showQrCode(number, name) {
        axios.get(`/certificate/qrcode/${number}`)
            .then(function({
                data
            }) {
                $('.modal-title').html(`QR Code ${name}`);
                $('.modal-body').html(`<div class='text-center'>
                <div>
                    <img width='300' height='auto' src='data:image/svg+xml;base64,${data.DATA}' />
                </div><br>
                    <div>
                        <a href='data:image/svg+xml;base64,${data.DATA}' class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" download>
                        <i class="fas fa-download"></i>  Download QR Code</a>
                    </div>
                </div>`);
                $('#modalSmall').modal('show');
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>

@endsection