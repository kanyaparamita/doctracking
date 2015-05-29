@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    Edit Profile
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                {{ Form::model($user, array('route' => array('profile.update'), 'method' => 'PUT', 'class' => 'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', $user->name, array('autofocus' => 'autofocus')) }}
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('username', 'Username') }}
                                {{ Form::text('username', $user->username, array('autocomplete'=>'off')) }}
                            </div>
                            <div class="da-form-col-4-8">
                                {{ Form::label('password', 'Password') }}
                                {{ Form::password('password',  array('placeholder' => 'Fill this field to change your password')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email', $user->email) }}
                            </div>
                            <div class="da-form-col-4-8">
                                {{ Form::label('phone', 'Phone') }}
                                {{ Form::text('phone', $user->phone) }}
                            </div>
                        </div>
                        <div class="da-button-row">
                            {{ Form::submit('Save', array('class' => 'da-button blue')) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop