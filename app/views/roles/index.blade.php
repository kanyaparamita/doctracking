@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        {{ Lang::get('doctrack.role_i_header')}}
                    </span>
                    <span style="float:right; margin-right:2em;">
                        <a href="{{ URL::to('roles/create') }}" class="da-button green small ">
                            <img src="images/icons/color/wand.png" alt="">
                            {{ Lang::get('doctrack.role_i_add')}}
                        </a>
                    </span>
                </span>
            </div>
            @if (Session::has('message'))
                <div class="da-message info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="da-panel-content">
                <table id="da-ex-datatable-numberpaging" class="da-table">
                    <thead>
                        <tr>
                            <th>{{ Lang::get('doctrack.name')}}</th>
                            <th>{{ Lang::get('doctrack.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>

                            <td class="da-icon-column">
                                <a href="{{ URL::to('roles/' . $role->id) }}">{{ HTML::image('images/icons/color/magnifier.png', 'View', array('title' => 'View')) }}</a>
                                <a href="{{ URL::to('roles/' . $role->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => 'Edit')) }}</a>
                                <a href="javascript:submit({{$role->id}})" Title="Hapus" onclick="return confirm('Are you sure you want to delete this item?')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}</a>
                                {{ Form::open(array('url' => 'roles/' . $role->id, null, 'id' => 'delete'. $role->id)) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
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
    </script>
@stop