@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <h3>Layanan : {{ $service->name }} </h3>
    </div>
    <div class="grid_2">
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{Lang::get('doctrack.bp_v_header')}}
                </span>

            </div>
            <div class="da-panel-toolbar top">
                <ul>
                    <li><a href="{{ URL::to('processes/' . $service_id.'/edit/'.$bp->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Update', array('title' => 'Update')) }}{{Lang::get('doctrack.edit')}}</a></li>
                    <li>
                        <a href="javascript:submitb({{$bp->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => 'Delete')) }}{{Lang::get('doctrack.delete')}}</a>
                        {{ Form::open(array('url' => 'processes/' . $service_id.'/delete/'.$bp->id, null, 'id' => 'deleteb'. $bp->id)) }}
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
                            <td>{{$bp->name}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.description')}}</th>
                            <td>{{$bp->description}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.unit')}}</th>
                            <td>{{$bp->unit()->first()->name}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.accounted_role')}}</th>
                            <td>{{$bp->roles}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.next_bp')}}</th>
                            <td>{{$bp->next_bp_id}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.preq_bp')}}</th>
                            <td>{{$bp->pre_con_bp}}</td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.flag_list')}}</th>
                            <td class="da-form">
                                <ul class="da-form-list">
                                    <li>
                                    {{Form::checkbox('is_start', 1, $bp->is_start, array('id'=>'start', 'title'=>'Proses awal untuk sebuah service'))}} <label>Start</label>
                                    </li>
                                    <li>
                                    {{Form::checkbox('is_finish', 1, $bp->is_finish, array('id'=>'finish', 'title'=>'Proses akhir untuk sebuah service'))}} <label>Finish</label>
                                    </li>
                                    <li>
                                    {{Form::checkbox('is_display', 1, $bp->is_display, array('id'=>'display', 'title'=>'Ditampilkan pada tracking'))}} <label>Display</label>
                                    </li>
                                    <li>
                                    {{Form::checkbox('is_checkpoint', 1, $bp->is_checkpoint, array('id'=>'checkpoint', 'title'=>'Dapat di reject'))}} <label>Rejectable</label>
                                    </li>
                                    <li>
                                    {{Form::checkbox('form_izin', 1, $bp->generate_form_perizinan, array('id'=>'izin', 'title'=>'Generate Form Perizinan'))}} <label>Generate Form Perizinan</label>
                                    </li>
                                    <li>
                                    {{Form::checkbox('form_bayar', 1, $bp->generate_form_pembayaran, array('id'=>'bayar', 'title'=>'Generate Form Pembayaran'))}} <label>Generate Form Pembayaran</label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>{{Lang::get('doctrack.display_text')}}</th>
                            <td>{{$bp->display_text}}</td>
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
                    {{Lang::get('doctrack.bpo_i_header')}}
                    <a href="{{ URL::to('process_output/' . $bp->id.'/create') }}" class="da-button right">{{ HTML::image('images/icons/color/wand.png', 'Add', array('title' => Lang::get('doctrack.add'))) }}</a>
                </span>
                <span class="da-panel-toggler"></span>
            </div>
            <div class="da-panel-content">
                <table class="da-table">
                    <thead>
                        <th width="3%">No</th>
                        <th>{{Lang::get('doctrack.name')}}</th>
                        <th>{{Lang::get('doctrack.input_type')}}</th>
                        <th>{{Lang::get('doctrack.output_type')}}</th>
                        <th>{{Lang::get('doctrack.field')}}</th>
                        <th width="15%">{{Lang::get('doctrack.action')}}</th>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @if ($bpo->count() > 0)
                            @foreach ($bpo as $b)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$b->name}}</td>
                                    <td>{{$b->typeInput->name}}</td>
                                    <td>{{$b->typeOutput->name}}</td>
                                    <td>{{$b->field}}</td>
                                    <td>
                                        <a href="{{ URL::to('process_output/' . $bp->id . '/edit/' . $b->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => Lang::get('doctrack.edit'))) }}</a>
                                        <a href="javascript:submito({{$b->id}})" Title="{{Lang::get('doctrack.delete')}}" onclick="return confirm('{{Lang::get('doctrack.delete_msg')}}')" >{{ HTML::image('images/icons/color/cross.png', 'Delete', array('title' => Lang::get('doctrack.delete'))) }}</a>
                                            {{ Form::open(array('url' => 'process_output/' . $bp->id. '/delete/'. $b->id, null, 'id' => 'deleteo'. $b->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <!-- {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'type'=>'hidden')) }} -->
                                            {{ Form::close() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">{{Lang::get('doctrack.no_data')}}</td>
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
    $('#start, #finish, #display, #checkpoint, #izin, #bayar').attr('disabled', 'disabled');

        function submitb(id) {
            $('#deleteb' + id).submit();
        }
        function submito(id) {
            $('#deleteo' + id).submit();
        }
    </script>
@stop