@extends('app')


@section('styles')
<style>
    .reg-tooltip{
        color: #fc3;
        font-size: 30px;

    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="">
                <h1>Hoja de Registro</h1>
                <div class="">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Ooops!</strong> Hubo algunos problemas con su informaci&oacute;n. Por favor revisar e intentar nuevamente.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                        <input type="hidden" name="_token" value="{{csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre Completo</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" />&nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Su nombre completo. Ejemplo: Arnoldo Sánchez Torres"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">&nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Correo Electrónico con el que desea registrarse. Ejemplo: arnoldo09@correo.com"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="password" class="form-control" name="password">&nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="La contraseña de su cuenta. Debe incluir como mínimo 6 caracteres. Ejemplo: clave123"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirmar Password</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="password" class="form-control" name="password_confirmation">&nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Ingrese nuevamente la contraseña de su cuenta."></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Casa Farmac&eacute;utica</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <select class="form-control" name="pharmaceutical" value="{{old('pharmaceutical') }}">
                                    @foreach(\App\PharmaceuticalCompanies::where('active', true)->orderBy('name')->get() as $cmp)
                                        <option value="{{ $cmp->post_category }}">{{ $cmp->name }}</option>
                                    @endforeach
                                    
                                </select>
                                &nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Seleccione la Casa Farmacéutica que lo refirió a ConMiDoctor.com"></span>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">C&oacute;digo de Ingreso</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="text" class="form-control" name="affiliate_code" value="{{ old('affiliate_code') }}" />&nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon glyphicon-question-sign reg-tooltip" data-toggle="tooltip" data-placement="right" title="El código que la Casa Farmacéutica le brindó para poder registrarse en la Biblioteca Virtual. Ejemplo: CODIGO1234"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">N&uacute;mero de Colegiado</label>
                            <div class="col-md-6" style="display: inline-flex;">
                                <input type="text" class="form-control" name="doctor_code" value="{{ old('doctor_code') }}" /> &nbsp;&nbsp;
                                <span class="reg-tooltip glyphicon  glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Su núm. de colegiado del Colegio de Médicos de Costa Rica. Ejemplo: 1234"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
