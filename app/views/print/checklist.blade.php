@extends('layouts.print')
@section('additional_header')
    <title>Checklist {{$service->name}} - {{$token}}</title>
    <style type="text/css">
        body {
            font-size: 11px;
            width: 1000px;
            height: 700px;
        }
        hr {
            border-top: dashed 1px;
        }
        .right {
            float: right;
        }
        .left {
            float: left;
        }
        .box {
            width:460px !important;
            height: 100%;
            float:clear;
            margin-right:15px;
            padding-right: 15px;
            border-right: dashed 1px black;
        }
        @page{
            size: landscape;
        }
    </style>
@stop
@section('content')
    <?php for($i=0; $i<2; $i++): ?>
        <div class="left box">
            <div class="right">
                <?php
                    if ($i == 0) {
                        echo DNS1D::getBarcodeSVG($token, "CODABAR");
                    } else {
                        echo DNS2D::getBarcodeSVG(url('outsider/details/'.$token), "QRCODE", 3, 3);
                    }
                ?>
            </div>
            <table>
                <tr><td>Nama</td><td>:</td><td>{{$customer->nama}}</td></tr>
                <tr><td>Email</td><td>:</td><td>{{$customer->email}}</td></tr>
                <tr><td>HP</td><td>:</td><td>{{$customer->phone}}</td></tr>
                <tr><td>Alamat</td><td>:</td><td>{{$customer->address}}</td></tr>
                <tr><td>Service</td><td>:</td><td>{{$service->name}}</td></tr>
                <tr><td>Tracking Code</td><td>:</td><td>{{$token}}</td></tr>
            </table>
            <br>
            <table width="100%">
                <?php $j=1; ?>
                @foreach ($requirements as $requirement)
                    <tr>
                        <td valign="top">{{$j}}</td>
                        <td>
                            {{$requirement->name}}
                            @if ($requirement->description != '')
                                <br>{{$requirement->description}}
                            @endif
                        </td>
                        <td  class="center">
                            @if ($requirement->data != '')
                                Ada
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <?php $j++; ?>
                @endforeach
            </table>
        </div>
    <?php endfor; ?>
@stop