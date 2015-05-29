@extends('layouts.outsider')
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <!-- <img src="images/icons/black/16/pencil.png" alt=""> -->
                    {{ Lang::get('doctrack.o_service_header') }}
                </span>

            </div>
            <div class="da-panel-content">
                {{ Form::open(array('url' => '', 'class'=>'da-form', 'id'=>'permohonan')) }}
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label style="width:200px !important">{{Lang::get('doctrack.o_service_select') }}</label>
                            <div class="da-form-col-4-8">
                                {{ Form::select('service_id', $services, Input::old('service_id'), array('id' => 'list')) }}
                            </div>
                            <div class="da-form-col-2-8">
                                {{ link_to('outsider/id/requirements', Lang::get('doctrack.o_service_action'), array('id'=>'link', 'class'=>'da-button blue')) }}
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('additional_footer')
    <script>
        $(document).ready(function() {

            function updateLink() {
                $('#link').attr('href', '/outsider/'+$('#list').val()+'/requirements');
            }

            updateLink();
            $('#list').change(function(event) {
                updateLink();
            });
        });
    </script>
@stop