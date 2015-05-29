@extends('layouts.default')
@section('content')
    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.req_v_header') }}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('reqReferences/' . $requirement->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => Lang::get('doctrack.edit'))) }}{{Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submit({{$requirement->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}{{Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'reqReferences/' . $requirement->id, null, 'id' => 'delete'. $requirement->id)) }}
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
                                {{ $requirement->value }}
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