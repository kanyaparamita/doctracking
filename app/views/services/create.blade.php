@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.service_c_header')}}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'services', 'class'=>'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            <div class="da-form-col-8-8">
                                {{ Form::label('name', Lang::get('doctrack.name')) }}
                                {{ Form::text('name', Input::old('name'), array('autofocus' => 'autofocus')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('estimated_days', Lang::get('doctrack.service_day')) }}
                                {{ Form::text('estimated_days', Input::old('estimated_days')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('database', Lang::get('doctrack.database')) }}
                                {{ Form::text('database', Input::old('database')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('tabel', Lang::get('doctrack.table')) }}
                                {{ Form::text('tabel', Input::old('tabel')) }}
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