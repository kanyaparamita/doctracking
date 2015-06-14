@extends('layouts.outsider')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    Prequisites {{$services->name}}
                </span>

            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'outsider/'.$services->id.'/prequisites/'.count($prequisites), 'class'=>'da-form', 'id'=>'permohonan', 'files'=>true)) }}
                    <table class="da-table">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Checklist</th>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach ($prequisites as $prequisite)
                                <?php $name = Service::where('id', '=', $prequisite->prequisite_id)->first()->name;?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{$name}}
                                    <td>
                                        {{Form::checkbox('status'.$i, $prequisite->prequisite_id, true)}}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="da-button-row">
                        {{ Form::submit('Apply', array('class' => 'da-button blue')) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('additional_footer')

@stop