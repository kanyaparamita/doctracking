@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.rq_e_header') }}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::model($requirement, array('route' => array('requirements.update', $service_id, $requirement->id), 'method' => 'PUT', 'class' => 'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            {{ Form::label('requirement_id', Lang::get('doctrack.requirement') ) }}
                            <div class="da-form-item large">
                                <span class="formNote">Tambahkan requirement terlebih dahulu jika tidak terdapat dalam list</span>
                                {{ Form::select('requirement_id', $requirements, $requirement->requirement_id) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_input', Lang::get('doctrack.input_type') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_input', $typeInput, $requirement->type_input) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_output', Lang::get('doctrack.output_type') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_output', $typeOutput, $requirement->type_output) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('is_required', Lang::get('doctrack.mandatory') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('is_required', $mandatory, $requirement->is_required) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('description', Lang::get('doctrack.description') ) }}
                            <div class="da-form-item large">
                                <span class="formNote">Penjelasan tambahan</span>
                                {{ Form::textArea('description', $requirement->description) }}
                            </div>
                        </div>
                        <div class="da-button-row">
                            {{ Form::submit(Lang::get('doctrack.save') , array('class' => 'da-button blue')) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop