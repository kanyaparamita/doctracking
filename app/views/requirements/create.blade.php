@extends('layouts.default')
@section('additional_header')

<!--     {{ HTML::script('plugins/elrte/js/elrte.min.js')}}
    {{ HTML::style('plugins/elrte/css/elrte.css', array('media' => 'screen')) }}

    {{ HTML::script('plugins/elfinder/js/elfinder.min.js')}}
    {{ HTML::style('plugins/elfinder/css/elfinder.css', array('media' => 'screen')) }}

    {{ HTML::script('js/demo/demo.form.js')}} -->


@stop
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.rq_c_header') }}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'requirements/'.$service_id.'/create', 'class'=>'da-form')) }}
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
                                {{ Form::select('requirement_id', $requirements) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_input', Lang::get('doctrack.input_type') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_input', $typeInput) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('type_output', Lang::get('doctrack.output_type') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('type_output', $typeOutput) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('is_required', Lang::get('doctrack.mandatory') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('is_required', $mandatory, 1) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('description', Lang::get('doctrack.description') ) }}
                            <div class="da-form-item large">
                                <span class="formNote">Penjelasan tambahan</span>
                                {{ Form::textArea('description') }}
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