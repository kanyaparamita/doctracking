@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.service_v_header')}}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('services/' . $service->id.'/edit') }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => 'Update')) }}{{Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submit({{$service->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}{{Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'services/' . $service->id, null, 'id' => 'delete'. $service->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                        {{ Form::close() }}
                    </li>
                </ul>
            </div>
            <div class="da-panel-content">
                @if (Session::has('message'))
                    <div class="da-message info">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <table class="da-table da-detail-view">
                    <tbody>
                        <tr>
                            <th>{{Lang::get('doctrack.name')}}</th>
                            <td>{{ $service->name }}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.service_day')}}</th>
                            <td>{{ $service->estimated_days }}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.database')}}</th>
                            <td>{{ $service->database }}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.table')}}</th>
                            <td>{{ $service->tabel }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    {{Lang::get('doctrack.requirement')}}
                    <a href="{{ URL::to('requirements/' . $service->id.'/create') }}" class="da-button right">{{ HTML::image('images/icons/color/wand.png', 'Edit') }} {{Lang::get('doctrack.add')}}</a>
                </span>
                <span class="da-panel-toggler"></span>

            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th width="5%">No</th>
                        <!-- <th>ID</th> -->
                        <th>{{Lang::get('doctrack.name')}}</th>
                        <th width="16%">{{Lang::get('doctrack.action')}}</th>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @if ($requirements->count() > 0)
                            @foreach ($requirements as $requirement)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$requirement->requirementReference->value}}</td>
                                    <td>
                                        <a href="{{ URL::to('requirements/'. $service->id . '/edit/' . $requirement->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => 'Edit')) }}</a>
                                        <a href="javascript:submitr({{$requirement->id}})" Title="Hapus" onclick="return confirm('Are you sure you want to delete this item?')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}</a>
                                            {{ Form::open(array('url' => 'requirements/' . $service->id. '/delete/'. $requirement->id, null, 'id' => 'deleter'. $requirement->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                                            {{ Form::close() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">{{Lang::get('doctrack.no_data')}}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    {{Lang::get('doctrack.stage')}}
                    <a href="{{ URL::to('processes/' . $service->id.'/create') }}" class="da-button right">{{ HTML::image('images/icons/color/wand.png', 'Edit') }} {{Lang::get('doctrack.add')}}</a>
                </span>
                <span class="da-panel-toggler"></span>
            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th width="5%">No</th>
                        <th title="Base Process ID Untuk keperluan next dan prerequisit base process">ID</th>
                        <th>{{Lang::get('doctrack.name')}}</th>
                        <th title="Role yang bertanggung jawab">{{Lang::get('doctrack.role')}}</th>
                        <th width="20%">{{Lang::get('doctrack.action')}}</th>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @if ($bp->count() > 0)
                            @foreach ($bp as $b)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$b->id}}</td>
                                    <td>{{$b->name}}</td>
                                    <td>{{$b->role()->first()->name}}</td>
                                    <td>
                                        <a href="{{ URL::to('processes/' . $service->id. '/view/'. $b->id) }}">{{ HTML::image('images/icons/color/magnifier.png', 'View', array('title' => 'View')) }}</a>
                                        <a href="{{ URL::to('processes/' . $service->id . '/edit/' . $b->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => 'Edit')) }}</a>
                                        <a href="javascript:submitb({{$b->id}})" Title="Hapus" onclick="return confirm('Are you sure you want to delete this item?')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}</a>
                                            {{ Form::open(array('url' => 'processes/' . $service->id. '/delete/'. $b->id, null, 'id' => 'deleteb'. $b->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                                            {{ Form::close() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{Lang::get('doctrack.no_data')}}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    {{Lang::get('doctrack.prequisite')}}
                    <a href="{{ URL::to('prequisites/' . $service->id.'/create') }}" class="da-button right">{{ HTML::image('images/icons/color/wand.png', 'Edit') }} {{Lang::get('doctrack.add')}}</a>
                </span>
                <span class="da-panel-toggler"></span>
            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th width="5%">No</th>
                        <th title="Nama dari perizinan sebelumnya">Nama Perizinan</th>
                        <th width="16%">{{Lang::get('doctrack.action')}}</th>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @if ($pq->count() > 0)
                            @foreach ($pq as $p)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{Service::where('id', '=', $p->prequisite_id)->first()->name}}</td>
                                    <td>
                                        <a href="{{ URL::to('prequisites/'. $service->id . '/edit/' . $p->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => 'Edit')) }}</a>
                                        <a href="javascript:submitr({{$p->id}})" Title="Hapus" onclick="return confirm('Are you sure you want to delete this item?')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}</a>
                                            {{ Form::open(array('url' => 'prequisites/' . $service->id. '/delete/'. $p->id, null, 'id' => 'deleter'. $p->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                                            {{ Form::close() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{Lang::get('doctrack.no_data')}}</td>
                            </tr>
                        @endif
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
        function submitr(id) {
            $('#deleter' + id).submit();
        }
        function submitb(id) {
            $('#deleteb' + id).submit();
        }
    </script>
@stop