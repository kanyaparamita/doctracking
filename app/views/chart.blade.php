<?php
    $filter = array("All", "Day", "Month", "Year", "Range");
?>
@extends('layouts.default')
@section('additional_header')
    {{ HTML::style('css/zebra_datepicker/metallic.css')}}
    {{ HTML::style('css/custom.css')}}
@stop
@section('content')
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">

                    {{ Form::open(array('class'=>'da-form', 'style'=>'text-align:center;')) }}
                        <div style="display:block; text-align:center; padding:5px;">
                            {{ Form::select('filter', $filter, 0, array('class' => 'da-form-col-1-8', 'style'=>'height:28px; float: none;', 'id' => 'filter')) }}
                            <span id="first">
                                {{ Form::text('Start Date', null, array('class' => 'date', 'id'=>'date1', 'readonly' => 'readonly', 'style'=>'margin-left:5px;', 'name'=>'date1')) }}
                            </span>
                            <span id="con">
                                {{ Form::text('End Date', date('j F Y'), array('class' => 'date', 'id'=>'date2', 'readonly' => 'readonly', 'style'=>'margin-left:7px; margin-right:2px;', 'name'=>'date2')) }}
                            </span>
                            {{ Form::button('Filter', array('class' => 'da-button blue', 'style'=>'margin-left:8px', 'id'=>'submit')) }}
                        </div>
                    {{ Form::close() }}
                </span>
            </div>
            <div class="da-panel-content">
                <div id="bar_chart" style="height:35em">

                </div>
                <table id="datatable" style="display:none;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{Lang::get('doctrack.chart_x')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chart_data as $key => $value) : ?>
                        <tr>
                            <th><?= $value->name; ?></th>
                            <td><?= $value->jumlah; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="loading">

    </div>
@stop
@section('additional_footer')
    {{ HTML::script('js/highcharts/highcharts.js')}}
    {{ HTML::script('js/highcharts/modules/data.js')}}
    {{ HTML::script('js/zebra_datepicker.js')}}
    <script>
        $(document).ready(function() {

            function formatDate1(format) {
                $('#date1').Zebra_DatePicker({
                    format: format,
                    default_position: 'below',
                    pair: $('#date2')
                });
            }

            function formatDate2(format) {
                $('#date2').Zebra_DatePicker({
                    format: format,
                    default_position: 'below'
                });
            }

            function formatChart() {
                $('#bar_chart').highcharts({
                    data: {
                        table: document.getElementById('datatable')
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: "<?php echo Lang::get('doctrack.chart_title'); ?>"
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: "<?php echo Lang::get('doctrack.chart_y'); ?>"
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.point.name.toLowerCase() + '</b><br/>'  +  this.series.name + ' ' + this.point.y;
                        }
                    }
                });
            }

            $(function () {
                $('#con').hide();
                $('#first').hide();
                formatDate1('d M Y');
                formatDate2('d M Y');
                formatChart();
                $('.loading').hide();
            });

            $('#filter').change(function(event) {
                var option = $('#filter option:selected').val();
                $('#con').hide();
                $('#first').show();
                $('#date1, #date2').val('');
                if (option == 0) {
                    formatDate1('d M Y');
                    $('#first').hide();
                } else if (option == 1) {
                    formatDate1('d M Y');
                } else if (option == 2) {
                    formatDate1('M Y');
                } else if (option == 3) {
                    formatDate1('Y');
                } else {
                    $('#con').show();
                    formatDate1('d M Y');
                }
            });

            function filter() {
                $('.loading').fadeIn(500);
                $.post(
                    'ajax/getFilterDate',
                    {
                        date1: $('#date1').val(),
                        date2: $('#date2').val(),
                        id: $('#filter option:selected').val()
                    },
                    function( data ) {
                        $('#datatable tbody').html(data);
                        formatChart();
                        $('.loading').fadeOut(500);
                    }
                );
            }

            $('#submit').click(function(event) {
                filter();
            });
        });



    </script>
@stop