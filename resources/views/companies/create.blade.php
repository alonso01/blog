@extends('app')

@section('title')
Agregar Compañía Farmacéutica
@endsection

@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/js/tinymce_4.6.4/js/tinymce/tinymce.min.js') }}"></script> --}}
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	}); 
</script>

<form action="new" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input required="required" value="{{ old('name') }}" placeholder="Nombre de la Compañía Farmacéutica" type="text" name = "name" class="form-control" />
	</div>
	<div class="form-group">
		<input required="required" value="{{ old('affiliate_code') }}" placeholder="Codigo para afiliados" type="text" name = "affiliate_code" class="form-control" />
	</div>
	<div class="form-group">
		<input required="required" value="{{ old('post_category') }}" placeholder="Clave de compañía" type="text" name = "post_category" class="form-control" />
	</div>


	<input type="submit" name='publish' class="btn btn-success" value = "Crear"/>
	
</form>
@endsection

@push('scripts')
<script src="{{ asset('/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js') }}" ></script>
@endpush


@push('styles')
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}" />
@endpush