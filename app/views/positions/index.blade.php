@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        {{ Lang::get('doctrack.position_i_header')}}
                    </span>
                    <span style="float:right; margin-right:2em;">
                        <a href="{{ URL::to('positions/create') }}" class="da-button green small ">
                            <img src="images/icons/color/wand.png" alt="">
                            {{ Lang::get('doctrack.position_i_add')}}
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
                            <th>{{ Lang::get('doctrack.member')}}</th>
                            <th>{{ Lang::get('doctrack.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->name }}</td>
                            <td>{{ $position->users()->count() }}</td>
                            <td class="da-icon-column">
                                <a href="{{ URL::to('positions/' . $position->id) }}">{{ HTML::image('images/icons/color/magnifier.png', 'Lihat', array('title' => Lang::get('doctrack.view'))) }}</a>
                                <a href="{{ URL::to('positions/' . $position->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Ubah', array('title' => Lang::get('doctrack.edit'))) }}</a>
                                <a href="javascript:submit({{$position->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Hapus', array('title' => Lang::get('doctrack.delete'))) }}</a>
                                {{ Form::open(array('url' => 'positions/' . $position->id, null, 'id' => 'delete'. $position->id)) }}
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