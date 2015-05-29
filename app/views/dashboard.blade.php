@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        Daftar Tugas
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        @foreach ($service_execution as $se)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$se['service_name'] . ' - ' . $se['bp_name']}}</td>
                            <td>{{$se['nama']}}</td>
                            <td>{{ date("d F Y   H:m:s", strtotime($se['date'])) }}</td>
                            <td>{{$se['token']}}
                            <td>
                                @if ($se['bp_status'] == 0)
                                    {{ link_to('process_task/'.$se['se_id'].'/'.$se['bp_id'].'/start', 'Kerjakan Sekarang', array('class' => 'da-button blue'))}}
                                @elseif ($se['bp_status'] == 1)
                                    {{ link_to('process_task/'.$se['se_id'].'/'.$se['bp_id'].'/process', 'Tampilkan', array('class' => 'da-button info'))}}
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

    @if (Session::has('preq'))
        <div id="da-ex-dialog-div" style="display:none;">
            <p>Proses belum dapat dilanjutkan karena requirement belum terpenuhi. </br>{{Session::get('preq')}}</p>
        </div>
    @endif
@stop

@section('additional_footer')
    <script>
        $("#da-ex-dialog-div").dialog({autoOpen:true,title:"Warning",modal:true,width:"640"}).dialog('open');
    </script>
@stop