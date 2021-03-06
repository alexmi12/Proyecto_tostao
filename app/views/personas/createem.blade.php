@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('personas/empresas')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR EMPRESA
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'personas/storeem', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('razonSocial', 'Razon Social', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'razonSocial','', array('class' => 'form-control','placeholder'=>'Ej. Textiles del Norte SAC.','autofocus', 'required', 'validationMessage'=>'Por favor entre una Razón Social.'))}}
    </div>
  </div>


<div class="form-group">
    <div class="col-md-3">
      {{Form::label('ruc', 'RUC', array('class'=>'control-label'))}}
                </div>
    <div class="col-md-5">
      {{Form::input('text', 'ruc','', array('class' => 'form-control','placeholder'=>'11 dígitos', 'required', 'validationMessage'=>'Por favor entre un ruc válido. (11 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
    </div>
    </div>
    
    <div class="form-group">
    <div class="col-md-3">
      {{Form::label('direccion', 'Dirección', array('class'=>'control-label'))}}
     </div>
    <div class="col-md-5">
      {{Form::input('text', 'direccion', '', array('class' => 'form-control','placeholder'=>'Ej. Av. del Ejército 330', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('pais', 'País', array('class'=>'control-label'))}}
          {{Form::select('pais', array('0'=>'Seleccione País','Perú'=>'Perú','Otro' => 'Otro'),'',array('class' => 'form-control'))}}
        </div>
    <div class="col-md-3">
    {{Form::label('departamento', 'Departamento', array('class'=>'control-label'))}}
      <select name="departamento" id="departamento" class="form-control">
              <option value="0">Seleccione Dpto.</option>

            </select>
    </div>
    <div class="col-md-3">
    {{Form::label('provincia', 'Provincia', array('class'=>'control-label'))}}
      <select name="provincia" id="provincia" class="form-control" >
              <option value="0">Seleccione Prov.</option>
            </select>
    </div>
    <div class="col-md-3">
    {{Form::label('distrito', 'Distrito', array('class'=>'control-label'))}}
      <select name="distrito" id="distrito" class="form-control" >
              <option value="0">Seleccione Dist.</option>
            </select>
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('tel', 'Telefono', array('class'=>'control-label'))}}
      {{Form::input('text', 'tel', '', array('class' => 'form-control','placeholder'=>'6 díg. mín.', 'validationMessage'=>'Por favor entre un número de teléfono válido','pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9]+'))}}
    </div>
    <div class="col-md-3">
      {{Form::label('cel', 'Celular', array('class'=>'control-label'))}}
      {{Form::input('text', 'cel','', array('class' => 'form-control','placeholder'=>'9 dígitos','pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]', 'validationMessage'=>'Por favor entre un número de celular válido.'))}}
    </div>
    <div class="col-md-6">
      {{Form::label('email', 'Email', array('class'=>'control-label'))}}
      {{Form::input('email', 'email', '', array('class' => 'form-control','placeholder'=>'persona@dominio.com', 'validationMessage'=>'Por favor entre un email válido.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-2">
      {{Form::label('habilitado', 'Habilitado', array('class'=>'control-label'))}}
      {{Form::select('habilitado', array(1=>'Si', 0=> 'No'), 1 ,array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3">
      {{Form::label('perfil_id', 'Perfil', array('class'=>'control-label'))}}
      <select name="perfil_id" id="perfil_id" class="form-control">
        @foreach ($perfiles as $dato) {
        <option value="{{$dato->id}}">{{$dato->nombre}}</option>
        }
        @endforeach
      </select>
    </div>
    <div class="col-md-7">
      &nbsp;
    </div>
  </div>
<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Guardar',  array('class' => 'btn btn-warning') )}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
        </div> <!-- del panel body -->
@stop