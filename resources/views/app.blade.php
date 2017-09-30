<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="http://www.conmidoctor.com/wp-content/themes/mxp_base_theme/mxp_theme/images/master-principal-favicon.ico?crc=80890445" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biblioteca Virtual | Con Mi Doctor</title>

        <link href="{{asset('/css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @stack('styles')

    </head>
<body>
    <div class="row" style="padding: 20px 0 20px 0">

        <div class="col-md-2"></div>
        <div class="col-md-2">
            <img src="http://www.conmidoctor.com/biblio/public/images/Logo%20CMD@2x.png" style="height: 103px !important; width: 362px !important;" />
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>

    </div>
    <nav class="navbar navbar-default" style="background-color: #62c7f3 !important; padding-left: 10%; border: 0 !important; box-shadow: 8px 1px 8px rgba(0,0,0,0.3); border-radius: 0;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.conmidoctor.com" target="_blank" style="color: #fff">Con Mi Doctor</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a style="color: #fff" href="{{ url('/') }}">Inicio</a>
                    </li>
                    @if (!Auth::guest())
                 
                        @foreach( \App\PharmaceuticalCompanies::where('active', true)->get() as $cmp)
                            <li>
                                <a style="color: #fff" href="{{ url('/postsByCompany') }}/{{ $cmp->post_category }}">{{ $cmp->name }}</a>
                            </li> 
                        @endforeach

                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li>
                        <a style="color: #fff" href="{{url('/auth/login') }}">Ingresar</a>
                    </li>
                    <li>
                        <a style="font-weight: bold; background-color: #fc3; color: #013255;text-decoration: underline;" href="{{url('/auth/register') }}">Registro</a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a style="color: #fff" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" style="background-color: #62c7f3 !important">

                            @if (Auth::user()->is_admin())
                            <li>
                                <a style="color: #fff" href="{{url('/filemanager') }}">Administrador de Archivos</a>
                            </li>
                            <li>
                                <a style="color: #fff" href="{{url('/companies/list') }}">Administrar Compañías Farmacéuticas</a>
                            </li>
                            @endif
                            @if (Auth::user()->can_post())
                            <li>
                                <a style="color: #fff" href="{{url('/post/new') }}">Agregar Art&iacute;culo</a>
                            </li>
                            <li>
                                <a style="color: #fff" href="{{url('/user/'.Auth::id().'/posts') }}">Informaci&oacute;n</a>
                            </li>
                            @endif
                            <li>
                                <a style="color: #fff" href="{{url('/user/'.Auth::id()) }}">Mi Perfil</a>
                            </li>
                            <li>
                                <a style="color: #fff" href="{{url('/auth/logout') }}">Salir</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="row" style="padding-bottom: 37px;">

        <div class="col-md-12" style="background: url(http://www.conmidoctor.com/biblio/public/images/informacion-medica.jpg) fixed; background-size: cover;  background-position:center; background-repeat:no-repeat;  min-height: 600px;height: 100%; padding-top:0;">


            <div class="container" style="padding-top: 10%;">
                @if (Session::has('message'))
                <div class="flash alert-info">
                    <p class="panel-body">
                        {{ Session::get('message') }}
                    </p>
                </div>
                @endif
                @if ($errors->any())
                <div class='flash alert-danger'>
                    <ul class="panel-body">
                        @foreach ( $errors->all() as $error )
                        <li>
                            {{    $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">


                        <div class="col-md-12">

                            <div class="" style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: white !important;">
                                <div class="panel-heading">
                                    <h2>@yield('title')</h2>
                                    @yield('title-meta')
                                </div>
                                <div class="" style="background-color: white !important; padding: 15px;">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                

            </div>

        </div>
    </div>

    <div class="row" id="u3557" style="background-color: #143756; color: white !important; padding: 10px 0; position: fixed; bottom: 0; left: 0; min-width: 100%;margin-left: 0 !important; margin-right: 0 !important">
        <!-- group -->
        <div class="col-md-6 col-lg-6" style=" color: white !important;font-size: 11px;line-height: 13px;font-family: muli, sans-serif;font-weight: 400;text-align: right;">
            <span id="u3546">® 2017 Derechos Reservados / Designed by</span>
        </div>
        <div class="col-md-6 col-lg-6" style=" color: white !important;font-size: 11px;line-height: 13px;font-family: muli, sans-serif;font-weight: 400;">
            <a style=" color: white !important;" class="nonblock nontext clip_frame grpelem" id="u6522" href="http://www.neocreativa.com" target="_blank">
                <!-- svg -->
                <img class="svg" id="u3551" alt="Somos especialistas en apoyar a su empresa a aprovechar al máximo el potencial del marketing digital y la publicidad." title="Neo Creativa... Agencia de Marketing Digital y Publicidad" data-mu-svgfallback="http://www.conmidoctor.com/wp-content/themes/mxp_base_theme/mxp_theme/images/svg%20pegado%20503254x69_poster_.png?crc=3911865904" src="http://www.conmidoctor.com/wp-content/themes/mxp_base_theme/mxp_theme/images/svg-pegado-503254x69.svg?crc=168405274" width="122" height="17" />
            </a>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{asset('/js/jquery.min-2.1.3.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min-3.3.1.js') }}"></script>
    
    <script type="text/javascript">
            $(document).ready(function () {
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                
            });
    </script>
    @stack('scripts')

</body>
</html>
