@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <span>
                        {{ HTML::image('images/icons/black/16/list.png') }}
                        {{Lang::get('doctrack.unit_i_header')}}
                    </span>
                    <span style="float:right; margin-right:2em;">
                        <a href="{{ URL::to('units/create') }}" class="da-button green small ">
                            <img src="images/icons/color/wand.png" alt="">
                            {{Lang::get('doctrack.unit_i_add')}}
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
                            <th>{{Lang::get('doctrack.member')}}</th>
                            <th>{{Lang::get('doctrack.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->users()->count() }}</td>
                            <td class="da-icon-column">
                                <a href="{{ URL::to('units/' . $unit->id) }}">{{ HTML::image('images/icons/color/magnifier.png', 'View', array('title' => Lang::get('doctrack.view'))) }}</a>
                                <a href="{{ URL::to('units/' . $unit->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => Lang::get('doctrack.edit'))) }}</a>
                                <a href="javascript:submit({{$unit->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => Lang::get('doctrack.delete'))) }}</a>
                                {{ Form::open(array('url' => 'units/' . $unit->id, null, 'id' => 'delete'. $unit->id)) }}
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