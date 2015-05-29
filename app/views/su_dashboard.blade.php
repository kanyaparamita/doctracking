@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        Dashboard Super User
                    </span>
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                <table id="da-ex-datatable-numberpaging" class="da-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Token</th>
                            <th width="15%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        @foreach ($service_execution as $se)
                            <?php
                                $diff =  Executor::dateDiff($se['date'], date("Y-m-d H:i:s"));
                                if ($se['status'] == 0) {
                                    if ($diff >= (Config::get('doctrack.constant_overdue')/100*$se['estimated_days'])) {
                                        $flag = HTML::image('images/message-error.png','warning', array('class'=>'right', 'title'=>'Waktu pengerjaan telah overdue'));
                                    }elseif ($diff >= (Config::get('doctrack.constant_warning')/100*$se['estimated_days'])) {
                                        $flag = HTML::image('images/message-warning.png','warning', array('class'=>'right', 'title'=>'Waktu pengerjaan telah mencapai 75%'));
                                    } else {
                                        $flag = '';
                                    }
                                }
                            ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$se['service_name']}}</td>
                                <td>{{$se['nama']}}</td>
                                <td>{{ date("d F Y   H:m:s", strtotime($se['date'])) }}</td>
                                <td>{{link_to('super/se_detail/'. $se['token'], $se['token'], array('target' => ''))}}</td>
                                <td>
                                    @if ($se['status'] == 1 )
                                        Finish
                                    @elseif ($se['status'] == 2)
                                        Reject
                                    @elseif ($se['status'] == 3)
                                        Finish by SU
                                    @else
                                        On Progress {{$flag}}
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('additional_footer')
    <script>
        $("#da-ex-dialog-form-div").dialog({autoOpen:false,title:"Pilih Base Proses ",modal:true,width:"640"});
        $('#da-ex-dialog-form').click(function() {
            $("#da-ex-dialog-form-div").dialog("option",{modal:true}).dialog('open');
        });
    </script>
@stop