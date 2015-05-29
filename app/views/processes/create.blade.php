@extends('layouts.default')
@section('content')
    <div class="grid_4">
        <h3>Layanan : {{ $service->name }} </h3>
    </div>
    <div class="grid_2">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    {{ HTML::image('images/icons/black/16/list.png') }}
                    {{ Lang::get('doctrack.bp_c_header') }}
                </span>
            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => 'processes/'.$service_id.'/create', 'class'=>'da-form')) }}
                    <div class="da-form">
                        @if(!$errors->isEmpty())
                        <div class="da-panel-content">
                            <div class="da-message error">
                                {{ HTML::ul($errors->all())}}
                            </div>
                        </div>
                        @endif
                        <div class="da-form-row">
                            {{ Form::label('name', Lang::get('doctrack.name')) }}
                            {{ Form::text('name', Input::old('name'), array('autofocus' => 'autofocus')) }}
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('description', Lang::get('doctrack.description')) }}
                            {{ Form::text('description', Input::old('description'), array('autofocus' => 'autofocus')) }}
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('unit_id', Lang::get('doctrack.unit')) }}
                            {{ Form::select('unit_id', $units, Input::old('unit_id')) }}
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('roles', Lang::get('doctrack.accounted_role')) }}
                            {{ Form::text('roles', Input::old('roles'), array('title' => 'Masukkan id role dan pisahkan dengan ; tanpa menggunakan spasi')) }}
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('next_bp_id', Lang::get('doctrack.next_bp')) }}
                            {{ Form::text('next_bp_id', Input::old('next_bp_id'), array('title' => 'Masukkan id base proses dan pisahkan dengan ; tanpa menggunakan spasi')) }}
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('pre_con_bp', Lang::get('doctrack.preq_bp')) }}
                            {{ Form::text('pre_con_bp', Input::old('pre_con_bp'), array('title' => 'Masukkan id base proses dan pisahkan dengan ; tanpa menggunakan spasi')) }}
                        </div>
                        <div class="da-form-row">
                            <label>{{Lang::get('doctrack.flag_list')}}</label>
                            <div class="da-form-item">
                                <ul class="da-form-list">
                                    <li>{{Form::checkbox('is_start', 1, Input::old('is_start'), array('id'=>'start', 'title'=>'Proses awal untuk sebuah service'))}} <label>Start</label></li>
                                    <li>{{Form::checkbox('is_finish', 1, Input::old('is_finish'), array('id'=>'finish', 'title'=>'Proses akhir untuk sebuah service'))}} <label>Finish</label></li>
                                    <li>{{Form::checkbox('is_display', 1, Input::old('is_display'), array('id'=>'display', 'title'=>'Ditampilkan pada tracking'))}} <label>Display</label></li>
                                    <li>{{Form::checkbox('is_checkpoint', 1, Input::old('is_checkpoint'), array('id'=>'checkpoint', 'title'=>'Dapat di reject'))}} <label>Rejectable</label></li>
                                    <li>{{Form::checkbox('form_izin', 1, Input::old('form_izin'), array('id'=>'izin', 'title'=>'Generate Form Izin'))}} <label>Generate Form Izin</label></li>
                                    <li>{{Form::checkbox('form_bayar', 1, Input::old('form_bayar'), array('id'=>'bayar', 'title'=>'Generate Form Pembayaran'))}} <label>Generate Form Pembayaran</label></li>
                                </ul>
                            </div>
                        </div>
                        <div class="da-form-row">
                            {{ Form::label('display_text', Lang::get('doctrack.display_text')) }}
                            {{ Form::text('display_text', Input::old('display_text'), array('title' => 'Ditamplikan pada saat proses tracking')) }}
                        </div>
                        <div class="da-button-row">
                            {{ Form::submit(Lang::get('doctrack.save'), array('class' => 'da-button blue')) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="grid_2">
        <div class="grid_4">
            <div class="da-panel collapsible">
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                        {{Lang::get('doctrack.role_list')}}
                    </span>
                    <span class="da-panel-toggler"></span>
                </div>
                <div class="da-panel-content">
                    <table class="da-table">
                        <thead>
                            <th title="Role ID" width="5%">ID</th>
                            <th>{{Lang::get('doctrack.name')}}</th>
                        </thead>
                        <tbody>
                            @if ($roles->count() > 0)
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">{{Lang::get('doctrack.no_data')}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="grid_4">
            <div class="da-panel collapsible">
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                        {{Lang::get('doctrack.bp_list')}}
                    </span>
                    <span class="da-panel-toggler"></span>
                </div>
                <div class="da-panel-content">
                    <table class="da-table">
                        <thead>
                            <th title="Base Process ID Untuk keperluan next dan prerequisit base process" width="5%">ID</th>
                            <th>{{Lang::get('doctrack.name')}}</th>
                            <th width="15%">{{Lang::get('doctrack.action')}}</th>
                        </thead>
                        <tbody>
                            @if ($bp->count() > 0)
                                @foreach ($bp as $b)
                                    <tr>
                                        <td>{{$b->id}}</td>
                                        <td>{{$b->name}}</td>
                                        <td>
                                            <a href="{{ URL::to('processes/' . $service_id . '/edit/' . $b->id) }}">{{ HTML::image('images/icons/color/pencil.png', 'Edit', array('title' => Lang::get('doctrack.edit'))) }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">{{Lang::get('doctrack.no_data')}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@stop

@section('additional_footer')
    <script type="text/javascript">
        $('#start').change(function() {
            if ($('#start').prop('checked') == true)
                $('#finish').attr('disabled', 'disabled');
            else
                $('#finish').attr('disabled', false);
        });

        $('#finish').change(function() {
            if ($('#finish').prop('checked') == true)
                $('#start').attr('disabled', 'disabled');
            else
                $('#start').attr('disabled', false);
        });
    </script>
@stop