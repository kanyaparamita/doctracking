@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.bpo_e_header')}}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::model($bpo, array('route' => array('process_output.update', $bp_id, $bpo->id), 'method' => 'PUT', 'class' => 'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            {{ Form::label('name', Lang::get('doctrack.name')) }}
                            <div class="da-form-item large">
                                {{ Form::text('name', $bpo->name, array('autofocus' => 'autofocus')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_input', Lang::get('doctrack.input_type')) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_input', $typeInput, $bpo->type_input) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_output', Lang::get('doctrack.output_type')) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_output', $typeOutput, $bpo->type_output) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('is_required', Lang::get('doctrack.mandatory')) }}
                            <div class="da-form-item large">
                                {{ Form::select('is_required', $mandatory, $bpo->is_required) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('field', Lang::get('doctrack.field')) }}
                            <div class="da-form-item large">
                                {{ Form::text('field', $bpo->field) }}
                            </div>
                        </div>
                        <div class="da-button-row">
                            {{ Form::submit(Lang::get('doctrack.save'), array('class' => 'da-button blue')) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop