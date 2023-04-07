@extends('layout.master')
@section('content')
@section('dasboard', 'active')

<div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-right: 20px;">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate QRcode</a>
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
@endforeach
@endsection