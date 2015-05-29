@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.position_e_header')}}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::model($position, array('route' => array('positions.update', $position->id), 'method' => 'PUT', 'class' => 'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('name', Lang::get('doctrack.name')) }}
                                {{ Form::text('name', $position->name, array('autofocus' => 'autofocus')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('description', Lang::get('doctrack.description')) }}
                                {{ Form::textarea('description', $position->description, array('rows' => 3, 'style' => 'resize:none')) }}
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