@extends('layouts.default')
@section('content')
    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.unit_v_header')}}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('units/' . $unit->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => 'Update')) }}{{Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submit({{$unit->id}})" Title="Hapus" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}{{Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'units/' . $unit->id, null, 'id' => 'delete'. $unit->id)) }}
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
                            <th>{{Lang::get('doctrack.name')}}</th>
                            <td>
                                @if ($unit->name == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $unit->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.description')}}</th>
                            <td>
                                @if ($unit->description == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $unit->description }}
                                @endif
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
    </script>
@stop