@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <h3>{{ $service->service->name }} - {{ $bp->name }} </h3>
    </div>
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    Persyaratan untuk proses selanjutnya
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'process_task/'.$bps->se_id.'/'.$bps->bp_id.'/store', 'class'=>'da-form', 'id'=>'permohonan', 'files'=>true)) }}
                    <table class="da-table">
                        <thead>
                            <th width="4%">No</th>
                            <th>Nama</th>
                            <th>Masukan</th>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @if($bp_output->count() > 0)
                                @foreach ($bp_output as $bpo)
                                    @if (Executor::checkBaseProcessStateOutputExist($service->id, $bpo->id) == false)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$bpo->name}}
                                        <td>
                                            <?php
                                                $attr = array();
                                                if ($bpo->is_required) {
                                                    $attr['required'] = 'required';
                                                }
                                                switch ($bpo->type_input) {
                                                    case 3:

                                                        break;

                                                    case 2:
                                                        echo '<div class="da-form-item large">';
                                                            echo Form::text('input-'.$bpo->id, Input::old('input-'.$bpo->id), $attr);
                                                            // Executor::printRequired($bpo->is_required);
                                                        echo '</div>';

                                                        break;

                                                    case 1:
                                                        $attr['accept'] = $bpo->typeOutput->value;
                                                        echo '<div class="da-form-item large">';
                                                            echo Form::file('input-'.$bpo->id, $attr);
                                                            Executor::printRequired($bpo->is_required);
                                                            echo 'Tipe file : ' . $bpo->typeOutput->name;
                                                        echo '</div>';
                                                        break;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="da-button-row">
                        @if($bp_output->count() > 0)
                        {{ Form::submit('Continue', array('class' => 'da-button blue')) }}
                        <!-- <a id="continue" class="da-button blue"><span class="ui-button-text">Simpan</span></a> -->
                        @endif
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="grid_2">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    Persyaratan {{$service->service()->first()->name}}
                </span>

            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @if ($requirements->count() > 0)
                            @foreach ($requirements as $requirement)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$requirement->name}}</td>
                                    <td  class="center">
                                        @if ($requirement->data != '')
                                            {{ HTML::image('images/yes.png', 'Checked', array('class'=>'img-circle'))}}
                                        @else
                                            {{ HTML::image('images/no.png', 'Crossed', array('class'=>'img-circle'))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($requirement->data != '')
                                            @if ($requirement->typeInput->value =="text")
                                            @elseif ($requirement->typeInput->value == "input")
                                                {{$requirement->data}}
                                            @elseif ($requirement->typeInput->value == "file")
                                                {{link_to('requirement/'.$requirement->rs_id.'/'.$requirement->data, 'Lihat', array('target' => '_blank'))}}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid_2">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    Hasil proses
                </span>

            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @if($bpso->count() > 0)
                            @foreach ($bpso as $v)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $v->baseProcessOutput->name}} - {{$v->data}}</td>
                                    <td>
                                        @if ($v->baseProcessOutput->typeInput->value == "text")

                                        @elseif($v->baseProcessOutput->typeInput->value == "file")
                                            {{link_to('output/'.$v->id.'/'.$v->data, 'Lihat', array('target' => '_blank'))}}
                                            <!-- /*URL::asset('public/uploads/'.Executor::removeSpecialCharacter($requirement->data))*/ -->
                                            <!-- link_to('public/uploads/'.Executor::removeSpecialCharacter($requirement->data), 'Open', array('target' => '_blank')) -->
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid_4">
        <div class="da-button-row right">
            @if (count($next_list) > 1)
                <a id="xor-dialog-form" class="da-button yellow" role="button" aria-disabled="false" style="text-align:bottom"><span class="ui-button-text">Selesai</span></a>
            @else
                {{ link_to('process_task/'.$bps->se_id.'/'.$bps->bp_id.'/finish', 'Selesai', array('class' => 'da-button yellow'))}}
            @endif

            @if($bp->is_checkpoint == 1)
                <a id="da-ex-dialog-form" class="da-button red" role="button" aria-disabled="false" style="text-align:bottom"><span class="ui-button-text">Tolak</span></a>
            @endif
        </div>
    </div>

    <div id="da-ex-dialog-form-div" class="no-padding">
        {{ Form::open(array('url' => 'process_task/reject/'.$bps->se_id.'/'.$bp->id, 'class'=>'da-form', 'id' => 'da-ex-dialog-form-val')) }}
        <form id="da-ex-dialog-form-val" class="da-form">
            <div class="da-form-inline">
                <div class="da-form-row">
                    <label>Deskripsi Penolakan</label>
                    <textarea   name="description"></textarea>
                </div>
                <div class="da-button-row">
                    {{ Form::submit('Tolak', array('class' => 'da-button')) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>

    @if (count($next_list) > 1)
        <div id="xor-dialog-form-div" class="no-padding">
            {{ Form::open(array('url' => 'process_task/'.$bps->se_id.'/'.$bps->bp_id.'/finish', 'class'=>'da-form', 'id' => 'da-ex-dialog-form-val')) }}
                <div class="da-form-inline">
                    <div class="da-form-item" style="padding:10px;">
                        <ul class="da-form-list">
                            @foreach ($next_list as $key => $value)
                                <li>
                                    {{ Form::radio('xor', $key, true); }}  {{ Form::label('xor', $value) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="da-button-row">
                    {{ Form::submit('Submit', array('class' => 'da-button')) }}
                </div>
            {{ Form::close() }}
        </div>
    @endif
@stop

@section('additional_footer')
    <script>
        // $('#continue').click(function() {
        //     $('#permohonan').submit();
        // });

        $("#da-ex-dialog-form-div").dialog({autoOpen:false,title:"Penolakan Pengajuan ",modal:true,width:"640"});
        $('#da-ex-dialog-form').click(function() {
            $("#da-ex-dialog-form-div").dialog("option",{modal:true}).dialog('open');
        });

        $("#xor-dialog-form-div").dialog({autoOpen:false,title:"Pilih Path ",modal:true,width:"640"});
        $('#xor-dialog-form').click(function() {
            $("#xor-dialog-form-div").dialog("option",{modal:true}).dialog('open');
        });
    </script>
@stop