@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        {{Lang::get('doctrack.user_i_header')}}
                    </span>
                    <span style="float:right; margin-right:2em;">
                        <a href="{{ URL::to('users/create') }}" class="da-button green small ">
                            <img src="images/icons/color/wand.png" alt="">
                            {{Lang::get('doctrack.user_i_add')}}
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
                            <th>{{Lang::get('doctrack.name')}}</th>
                            <th>{{Lang::get('doctrack.position')}}</th>
                            <th>{{Lang::get('doctrack.unit')}}</th>
                            <th>{{Lang::get('doctrack.role')}}</th>
                            <th>{{Lang::get('doctrack.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->position()->first()->name }}</td>
                            <td>{{ $user->unit()->first()->name }}</td>
                            <td>{{ $user->role()->name }}</td>
                            <td class="da-icon-column">
                                <a href="{{ URL::to('users/' . $user->id) }}">{{ HTML::image('images/icons/color/magnifier.png', 'View', array('title' => 'View')) }}</a>
                                <a href="{{ URL::to('users/' . $user->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => 'Edit')) }}</a>
                                <a href="javascript:submit({{$user->id}})" Title="Hapus" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}</a>
                                {{ Form::open(array('url' => 'users/' . $user->id, null, 'id' => 'delete'. $user->id)) }}
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