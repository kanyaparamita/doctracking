@extends('layouts.outsider')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/computer_imac.png') }}
                    Detail Dokumen
                    <a href="{{URL::to('print/checklist/'.$service_execution->token)}}" class="right da-button gray" title="Wajib di cetak sebagai syarat penyerahan berkas" target="_blank" id="print">
                        {{HTML::image('images/icons/black/32/word_documents_1.png')}}
                        Print
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
                                    @if (Auth::user() != null)
                                    <th>Dikerjakan</th>
                                    <th>Diselesaikan</th>
                                    @endif
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
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
                                    @if (Auth::user() != null)
                                    <td>
                                        <?php
                                            if (!is_null($bp_state['started_by']))
                                                echo $bp_state->startedBy->name;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if (!is_null($bp_state['finished_by']))
                                                echo $bp_state->finishedBy->name;
                                        ?>
                                    </td>
                                    @endif
                                    <td>
                                        <?php
                                            switch ($bp_state['status']) {
                                                case 1:
                                                    echo 'On Progress';
                                                    break;

                                                case 2:
                                                    echo 'Done';
                                                    break;
                                                case 3:
                                                        echo 'Done';
                                                        break;
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
@stop

@section('additional_footer')
@if (Auth::user() == null)
<script>
    $(document).ready(function() {
        alert('Jangan lupa untuk mencetak lembar kontrol');
    });
</script>
@endif
@stop