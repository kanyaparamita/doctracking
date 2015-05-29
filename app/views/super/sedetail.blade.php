@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/computer_imac.png') }}
                    Detail Dokumen
                    </a>
                </span>

            </div>
            <div class="da-panel-content with-padding">
                <table class="da-table da-detail-view" style="border: 1px solid #d3d3d3">
                    <tbody>
                        <tr>
                            <th>Nama Layanan</th>
                            <td>
                                {{ $service->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php
                                    switch ($service_execution->status) {
                                        case 0:
                                            echo 'On Progress';
                                            break;

                                        case 1:
                                            echo 'Finished';
                                            break;

                                        case 2:
                                            echo 'Rejected';
                                            break;

                                        case 3:
                                            echo 'Finished';
                                            break;
                                    }
                                ?>
                            </td>
                        </tr>
                        @if ($service_execution->description != '')
                        <tr>
                            <th>Deskripsi</th>
                            <td>
                                {{ $service_execution->description }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Estimasi Pengerjaan</th>
                            <td>
                                {{ $service->estimated_days }} Day(s)
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>
                                {{ date("d F Y   H:m:s", strtotime($service_execution->created_at)) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="da-panel">
                    <div class="da-panel-header">
                        <span class="da-panel-title">
                            <span>
                                {{ HTML::image('images/icons/black/16/list.png') }}
                                Status
                            </span>
                        </span>
                    </div>
                    <div class="da-panel-content">
                        <table id="da-ex-datatable-numberpaging" class="da-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Unit</th>
                                    <th>Proses</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; $dialog = "";?>
                                @foreach ($base_process as $bp)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$bp->unit}}</td>
                                    <td>{{$bp->name}}
                                    <td>
                                        <?php
                                            $bp_state = Executor::getBaseProcessStateStatus($service_execution->id, $bp->bp_id);
                                            if (!is_null($bp_state['started_by'])) {
                                                echo date("d F Y",strtotime($bp_state['started_time']));
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            Debugbar::info($service_execution->status);
                                            if (!is_null($bp_state) ) {
                                                switch ($bp_state['status']) {
                                                    case 0:
                                                        if ($service_execution->status < 1)
                                                            echo link_to('super/process/'.$bp_state['se_id'].'/'.$bp_state['bp_id'], 'Proses', array('class' => 'da-button yellow'));
                                                        break;
                                                    case 1:
                                                        if ($service_execution->status < 1)
                                                            echo link_to('super/process/'.$bp_state['se_id'].'/'.$bp_state['bp_id'], 'Proses', array('class' => 'da-button yellow'));
                                                        break;
                                                    case 2:
                                                        echo 'Done';
                                                        break;
                                                    case 3:
                                                        echo 'Done';
                                                        break;
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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