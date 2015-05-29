<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Viewport metatags -->
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="320" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- iOS webapp metatags -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />

        <!-- iOS webapp icons -->
        <link rel="apple-touch-icon" href="touch-icon-iphone.html" />
        <link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.html" />
        <link rel="apple-touch-icon" sizes="114x114" href="touch-icon-retina.html" />

        <!-- CSS Reset -->
        {{ HTML::style('css/reset.css', array('media' => 'screen')) }}
        <!--  Fluid Grid System -->
        {{ HTML::style('css/fluid.css', array('media' => 'screen')) }}
        <!-- Theme Stylesheet -->
        {{ HTML::style('css/dandelion.theme.css', array('media' => 'screen')) }}
        <!--  Main Stylesheet -->
        {{ HTML::style('css/dandelion.css', array('media' => 'screen')) }}

        {{ HTML::style('css/login.css', array('media' => 'screen')) }}

        <!-- jQuery JavaScript File -->
        {{ HTML::script('js/jquery-1.7.2.min.js')}}

        <!-- jQuery-UI JavaScript Files -->
        {{ HTML::script('jui/js/jquery-ui-1.8.20.min.js')}}
        {{ HTML::script('jui/js/jquery.ui.timepicker.min.js')}}
        {{ HTML::script('jui/js/jquery.ui.touch-punch.min.js')}}
        {{ HTML::style('jui/css/jquery.ui.all.css', array('media' => 'screen'))}}

        <!-- Core JavaScript Files -->
        {{ HTML::script('js/core/dandelion.core.js')}}

        <title>Document Tracking</title>

        <style>
            .da-panel-content {
                border-top: 1px solid #d3d3d3 !important;
            }
        </style>
    </head>
    <body>
        @if (Session::has('message'))
            <div class="da-message error">
                {{ Session::get('message') }}
            </div>
        @endif
        <div id="da-login">
            <div>

                <div id="da-login-box-wrapper">
                    <div id="da-login-box">
                        <div id="da-login-box-header">
                            <h1>Sistem Pengajuan dan Pelacakan Dokumen</h1>
                            <h3>Badan Penanaman Modal Daerah dan Pelayanan Terpadu Satu Pintu<br>Kota Payakumbuh</h3>
                        </div>
                        <div style="float:left; width:280px; text-align:center;">
                            {{ HTML::image('img/logo-kota.png', 'logo', array('style'=>'max-height:300px;'))}}
                        </div>
                        <div style="float:right">
                            <div id="da-login-box-content">
                                {{ Form::open(array('url' => 'login', 'id' => 'da-login-form')) }}
                                    <div id="da-login-input-wrapper">
                                        <div class="da-login-input">
                                            {{ Form::text('username', Input::old('username'), array('placeholder' => 'username', 'id' => 'da-login-username', 'autofocus' => 'autofocus', 'required'=>'required')) }}
                                        </div>
                                        <div class="da-login-input">
                                            {{ Form::password('password', array('placeholder' => 'password', 'id' => 'da-login-password', 'required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div id="da-login-button">
                                        {{ Form::submit('Login', array('id' => 'da-login-submit')) }}
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div id="da-login-box-footer">
                                {{ link_to('forgot_password', Lang::get('doctrack.login_forgot')) }}
                                <br>  <br>
                                <a id="tracking-trigger" class="da-ex-buttons ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">{{ Lang::get('doctrack.login_track') }}</span></a>
                                <br> {{ Lang::get('doctrack.or') }} <br>
                                <a id="customer-trigger" class="da-ex-buttons ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">{{ Lang::get('doctrack.login_create') }}</span></a>

                            </div>

                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tracking-form-div" class="no-padding">
            {{ Form::open(array('url' => 'outsider/details/', 'class'=>'da-form', 'id' => 'da-ex-dialog-form-val')) }}
                <div class="da-form-inline">
                    <div class="da-form-row">
                        <label>{{Lang::get('doctrack.tracking_id')}}</label>
                        <input  type="text" name="token">
                    </div>
                    <div class="da-button-row">
                        {{ Form::submit(Lang::get('doctrack.tracking_find'), array('class' => 'da-button')) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>

        <div id="customer-div" class="no-padding">
            <div class="row">
                <div class="grid_4">
                    <form class="da-form">
                        <div class="da-form-row">
                            <ul class="da-form-list inline">
                                <li>{{Form::radio('pilihan', 1, true, array('id'=>'create'))}} <label>{{ Lang::get('doctrack.customer_opt_1') }}</label></li>
                                <li>{{Form::radio('pilihan', 2, false, array('id'=>'find'))}} <label>{{ Lang::get('doctrack.customer_opt_2') }}</label></li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="grid_4" id="cus-find"  style="display:none;">
                    <div class="da-panel">
                        <div class="da-panel-content">
                            {{ Form::open(array('url' => 'customers/find', 'class' => 'da-form', 'id' => 'da-form-find'))}}
                                <div class="da-form-row">
                                    <label>{{ Lang::get('doctrack.customer_ktp') }}</label>
                                    <div class="da-form-item large">
                                        <input name="ktp" type="text" required>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    {{ Form::label('password', 'Password') }}
                                    <div class="da-form-item large">
                                        {{ Form::password('password', array('required'=>'required')) }}
                                    </div>
                                </div>
                                <div class="da-button-row">
                                    <input type="submit" value="Submit" class="da-button green">
                                </div>
                            {{ Form::close()}}
                        </div>
                    </div>
                </div>

                <div class="grid_4" id="cus-create">
                    <div class="da-panel">
                        <div class="da-panel-content">
                            {{ Form::open(array('url' => 'customers/create', 'class' => 'da-form', 'id' => 'da-form-find'))}}
                                <div class="da-form-row">
                                    <label>{{ Lang::get('doctrack.customer_ktp') }}</label>
                                    <div class="da-form-item large">
                                        <input name="ktp" type="text" required>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label>{{Lang::get('doctrack.customer_name')}}</label>
                                    <div class="da-form-item large">
                                        <input name="nama" type="text" required>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label>{{ Lang::get('doctrack.customer_email') }}</label>
                                    <div class="da-form-item large">
                                        <input name="email" type="text" required>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label>{{ Lang::get('doctrack.customer_hp') }}</label>
                                    <div class="da-form-item large">
                                        <input name="phone" type="text" required>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label>{{ Lang::get('doctrack.customer_address')}}</label>
                                    <div class="da-form-item large">
                                        <textarea name="address" rows="auto" cols="auto" required></textarea>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    {{ Form::label('password', 'Password') }}
                                    <div class="da-form-item large">
                                        {{ Form::password('password') }}
                                    </div>
                                </div>


                                <div class="da-button-row">
                                    <input type="submit" value="Submit" class="da-button green">
                                </div>
                            {{ Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#tracking-form-div").dialog({autoOpen:false,title:"{{Lang::get('doctrack.tracking_header')}}",modal:true,width:"640"});
            $('#tracking-trigger').click(function() {
                $("#tracking-form-div").dialog("option",{modal:true}).dialog('open');
            });

            $("#customer-div").dialog({autoOpen:false,title:"{{Lang::get('doctrack.customer_header')}}",modal:true,width:"640"});
            $('#customer-trigger').click(function() {
                $("#customer-div").dialog("option",{modal:true}).dialog('open');
            });

            $('#find').click(function(event) {
                if ($('#find').is(':checked')) {
                    $('#cus-find').css('display', 'block');
                    $('#cus-create').css('display', 'none');
                }
            });
            $('#create').click(function(event) {
                if ($('#create').is(':checked')) {
                    $('#cus-find').css('display', 'none');
                    $('#cus-create').css('display', 'block');
                }
            });
        </script>
    </body>
</html>
