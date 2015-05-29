@extends('layouts.default')
@section('content')
    <div class="grid_3">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.role_e_header')}}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT', 'class' => 'da-form')) }}
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
                                {{ Form::text('name', $role->name, array('autofocus' => 'autofocus')) }}
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>{{Lang::get('doctrack.available_permission')}}</label>
                            <div class="da-form-item">
                                <ul class="da-form-list">
                                    @foreach ($permissions as $key=>$p)
                                        <?php
                                            if (in_array($p->id, $permission_roles)) {
                                                $attr = array('checked'=>'');
                                            } else {
                                                $attr = array();
                                            }
                                        ?>
                                        <li>{{ Form::checkbox('permissions[]', $p->id, null, $attr )}} {{$p->display_name}}</li>
                                    @endforeach
                                </ul>
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