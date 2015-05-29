@extends('layouts.default')
@section('content')
    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.user_v_header')}}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('users/' . $user->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => Lang::get('doctrack.edit'))) }}{{Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submit({{$user->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >
                            {{ HTML::image('images/icons/color/cross.png',
                                        'Delete',
                                        array('title' => Lang::get('doctrack.delete'))) }}
                                        {{Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'users/' . $user->id, null, 'id' => 'delete'. $user->id)) }}
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
                                @if ($user->name == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.username')}}</th>
                            <td>
                                @if ($user->username == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->username }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.email')}}</th>
                            <td>
                                @if ($user->email == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->email}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.phone')}}</th>
                            <td>
                                @if ($user->phone == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->phone}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.role')}}</th>
                            <td>
                                @if ($user->role()->name == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->role()->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.unit')}}</th>
                            <td>
                                @if ($user->unit()->first()->name == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->unit()->first()->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.position')}}</th>
                            <td>
                                @if ($user->position()->first()->name == '')
                                    <span class="null">N/A</span>
                                @else
                                    {{ $user->position()->first()->name }}
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