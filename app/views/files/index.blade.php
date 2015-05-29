@extends('layouts.default')
@section('additional_header')
    <!-- /*HTML::style('plugins/elfinder/css/elfinder.css', array('media' => 'screen'))*/  -->
    {{ HTML::style('packages/barryvdh/laravel-elfinder/css/elfinder.min.css', array('media' => 'screen')) }}
    <!-- HTML::script('plugins/elfinder/js/elfinder.min.js') -->
    {{ HTML::script('packages/barryvdh/laravel-elfinder/js/elfinder.min.js') }}
@stop
@section('content')
   <div class="grid_4">
    <div class="da-panel">
        <div class="da-panel-header">
            <span class="da-panel-title">
                <img src="images/icons/black/16/file_cabinet.png" alt="" />
                File Manager
            </span>

        </div>
        <div class="da-panel-content">
            <div id="da-ex-elfinder"></div>
        </div>
    </div>
</div>
@stop

@section('additional_footer')
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
            var elf = $('#da-ex-elfinder').elfinder({
                // lang: 'ru',             // language (OPTIONAL)
                url : '<?= URL::action('Barryvdh\Elfinder\ElfinderController@showConnector') ?>'  // connector URL (REQUIRED)
            }).elfinder('instance');
        });
    </script>
@stop