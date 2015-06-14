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
                {{ Form::open(array('url' => 'prequisites/'.$service_id.'/update/'.$prequisite_id, 'class'=>'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            {{ Form::label('service_id', Lang::get('doctrack.prequisite') ) }}
                            <div class="da-form-item large">
                                {{ Form::select('service_id', $service) }}
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