@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.user_e_header')}}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'da-form')) }}
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
                            {{ Form::text('name', $user->name, array('autofocus' => 'autofocus')) }}
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('username', Lang::get('doctrack.username')) }}
                                {{ Form::text('username', $user->username) }}
                            </div>
                            <div class="da-form-col-4-8">
                                {{ Form::label('password', Lang::get('doctrack.password')) }}
                                {{ Form::password('password',  array('placeholder' => Lang::get('doctrack.password_change_hint'))) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('email', Lang::get('doctrack.email')) }}
                                {{ Form::text('email', $user->email) }}
                            </div>
                            <div class="da-form-col-4-8">
                                {{ Form::label('phone', Lang::get('doctrack.phone'))}}
                                {{ Form::text('phone', $user->phone) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-col-4-8">
                                {{ Form::label('unit_id', Lang::get('doctrack.unit')) }}
                                {{ Form::select('unit_id', $units, $user->unit_id) }}
                            </div>
                            <div class="da-form-col-4-8">
                                {{ Form::label('position_id', Lang::get('doctrack.position')) }}
                                {{ Form::select('position_id', $positions, $user->position_id) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('role_id', Lang::get('doctrack.role')) }}
                            {{ Form::select('role_id', $roles, $user->role()->role_id) }}
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