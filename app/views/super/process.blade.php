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
                    Super Processing

                    <a id="da-ex-dialog-form" class="da-button red right" role="button" aria-disabled="false" style="text-align:bottom"><span class="ui-button-text">Tolak</span></a>
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'super/process/'.$bps->se_id.'/'.$bps->bp_id.'/finish', 'class'=>'da-form', 'id'=>'permohonan', 'files'=>true)) }}
                    <table class="da-table">
                        <tbody>
                            @if(count($next_list) > 1)
                                <tr>
                                    <td>
                                        Pilih Next Proses
                                    </td>
                                    <td>
                                        <div class="da-form-item" style="padding:10px;">
                                            <ul class="da-form-list">
                                                @foreach ($next_list as $key => $value)
                                                    <li>
                                                        {{ Form::radio('xor', $key, true); }}  {{ Form::label('xor', $value) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td> Super user message </td>
                                <td>
                                    <div class="da-form-item large">
                                        <textarea name="comment" rows="auto" cols="auto" required></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="da-button-row">
                        {{ Form::submit('Finish', array('class' => 'da-button blue')) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div id="da-ex-dialog-form-div" class="no-padding">
        {{ Form::open(array('url' => 'super/process/'.$bps->se_id.'/'.$bp->id.'/reject', 'class'=>'da-form', 'id' => 'da-ex-dialog-form-val')) }}
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
@stop

@section('additional_footer')
     <script>
        $("#da-ex-dialog-form-div").dialog({autoOpen:false,title:"Penolakan Pengajuan ",modal:true,width:"640"});
        $('#da-ex-dialog-form').click(function() {
            $("#da-ex-dialog-form-div").dialog("option",{modal:true}).dialog('open');
        });
    </script>
@stop