@extends('layouts.outsider')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    Requirements {{$services->name}}
                </span>

            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'outsider/'.$services->id.'/start/'.$token, 'class'=>'da-form', 'id'=>'permohonan', 'files'=>true)) }}
                    <table class="da-table">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Input</th>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($requirements as $requirement)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{$requirement->name}}
                                        @if ($requirement->description != null)
                                        <br>
                                        {{$requirement->description}}
                                        @endif
                                    <td>
                                        <?php
                                            $attr = array();
                                            if ($requirement->is_required) {
                                                $attr['required'] = 'required';
                                            }
                                            switch ($requirement->typeInput->value) {
                                                case "text":

                                                    break;

                                                case "input":
                                                    echo '<div class="da-form-item large">';
                                                        Executor::printRequired($requirement->is_required);
                                                        echo Form::text('input-'.$requirement->id, Input::old('input-'.$requirement->id), $attr);
                                                    echo '</div>';

                                                    break;

                                                case "file":
                                                    $attr['accept'] = $requirement->typeOutput->value;
                                                    echo '<div class="da-form-item large">';

                                                        echo Form::file('input-'.$requirement->id, $attr);
                                                        Executor::printRequired($requirement->is_required);
                                                        echo 'Tipe file : ' . $requirement->typeOutput->name;

                                                    echo '</div>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            @foreach($additionalReq as $requirements)
                                @foreach ($requirements as $requirement)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{$requirement->name}}
                                        @if ($requirement->description != null)
                                        <br>
                                        {{$requirement->description}}
                                        @endif
                                    <td>
                                        <?php
                                            $attr = array();
                                            if ($requirement->is_required) {
                                                $attr['required'] = 'required';
                                            }
                                            switch ($requirement->typeInput->value) {
                                                case "text":

                                                    break;

                                                case "input":
                                                    echo '<div class="da-form-item large">';
                                                        Executor::printRequired($requirement->is_required);
                                                        echo Form::text('input-'.$requirement->id, Input::old('input-'.$requirement->id), $attr);
                                                    echo '</div>';

                                                    break;

                                                case "file":
                                                    $attr['accept'] = $requirement->typeOutput->value;
                                                    echo '<div class="da-form-item large">';

                                                        echo Form::file('input-'.$requirement->id, $attr);
                                                        Executor::printRequired($requirement->is_required);
                                                        echo 'Tipe file : ' . $requirement->typeOutput->name;

                                                    echo '</div>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
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