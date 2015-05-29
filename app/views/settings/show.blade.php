@extends('layouts.default')
@section('content')
   <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.setting_header')}}
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                {{ Form::model($setting, array('route' => array('settings.update'), 'method' => 'POST', 'class' => 'da-form', 'files'=>true)) }}
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
                                {{ Form::label('title', Lang::get('doctrack.setting_title')) }}
                                {{ Form::text('title', $setting->title, array('autofocus' => 'autofocus')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('logo', Lang::get('doctrack.setting_logo')) }}
                                {{ Form::file('logo', array('accept' => 'image/*')) }}
                                @if ($setting->logo != '')
                                    <div class="right" style="text-align:center; width:250px;">
                                        <!-- <h4>Current Logo</h4> -->
                                        <div>
                                            {{ HTML::image("img/settings/".$setting->logo, "Logo", array('style' => 'max-width:200px;')) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('header_image', Lang::get('doctrack.setting_header')) }}
                                {{ Form::file('header_image', array('accept' => 'image/*')) }}
                                @if ($setting->header_image != '')
                                    <div class="right" style="text-align:center; width:250px;">
                                        <!-- <h4>Current Header Image</h4> -->
                                        <div>
                                            {{ HTML::image("img/settings/".$setting->header_image, "Logo", array('style' => 'max-width:200px;')) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('background_image', Lang::get('doctrack.setting_background')) }}
                                {{ Form::file('background_image', array('accept' => 'image/*')) }}
                                @if ($setting->background_image != '')
                                    <div class="right" style="text-align:center; width:250px;">
                                        <!-- <h4>Current Background Image</h4> -->
                                        <div>
                                            {{ HTML::image("img/settings/".$setting->background_image, "Logo", array('style' => 'max-width:200px;')) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('title_color', Lang::get('doctrack.setting_title_color')) }}
                                {{ Form::input('color', 'title_color', $setting->title_color, array()) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form">
                                {{ Form::label('is_active', Lang::get('doctrack.status')) }}
                                {{ Form::select('is_active', array(1 => 'Aktif', 0 => 'Tidak Aktif'), $setting->is_active, array('id' => 'list')) }}
                            </div>
                        </div>
                        <div class="da-button-row">
                            {{ Form::submit(Lang::get('doctrack.save'), array('class' => 'da-button blue')) }}
                            <span style="float:right; margin-right:2em;">
                                <a href="{{ URL::to('settings/reset') }}" class="da-button red ">
                                    {{Lang::get('doctrack.reset')}}
                                </a>
                            </span>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('additional_footer')

@stop