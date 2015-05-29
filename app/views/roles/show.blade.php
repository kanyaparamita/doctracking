@extends('layouts.default')
@section('content')
    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.role_v_header')}}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('roles/' . $role->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => 'Update')) }}{{ Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submit({{$role->id}})" Title="{{ Lang::get('doctrack.delete')}}" onclick="return confirm('{{ Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}{{ Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'roles/' . $role->id, null, 'id' => 'delete'. $role->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                        {{ Form::close() }}
                    </li>
                </ul>
            </div>
            <div class="da-panel-content">
                <table class="da-table da-detail-view">
                    <tbody>
                        <tr>
                            <th>{{ Lang::get('doctrack.name')}}</th>
                            <td>
                                {{ $role->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ Lang::get('doctrack.permission_list')}}</th>
                            <td class="da-form">
                                <ul class="da-form-list">
                                    @foreach ($permissions as $key=>$p)
                                        <li>{{ Form::checkbox('permissions[]', $p->id, in_array($p->id, $permission_roles), array('class'=>'permission'))}} {{$p->display_name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('additional_footer')
    <script type="text/javascript">
        function submit(id) {
            $('#delete' + id).submit();
        }

        $('.permission').attr('disabled', 'disabled');
    </script>
@stop