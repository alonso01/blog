@extends('app')

@section('title')
Editar Compañía Farmacéutica
@endsection

@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
{{-- 
<script type="text/javascript" src="{{ asset('/js/tinymce_4.6.4/js/tinymce/tinymce.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=p5lsh03g8jbufa6ji3p5nhbmlx6aibry863cfg51xhm6cvo7"></script> --}}
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages"
	}); 
</script>

<form method="post" action='{{ url("/companies/update") }}'>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="company_id" value="{{ $company->id }}{{ old('company_id') }}">
	
	
	
	<div class="form-group">
		<input required="required"placeholder="Nombre de la Compañía Farmacéutica" type="text" name = "name" class="form-control" value="@if(!old('name')){{$company->name}}@endif{{ old('name') }}" />
	</div>
	<div class="form-group">
		<input required="required"  placeholder="Código para Afiliados" type="text" name = "affiliate_code" class="form-control" value="@if(!old('affiliate_code')){{$company->affiliate_code}}@endif{{ old('affiliate_code') }}"  />
	</div>
	<div class="form-group">
		<input required="required" placeholder="Clave de Compañía" type="text" name = "post_category" class="form-control" value="@if(!old('post_category')){{$company->post_category}}@endif{{ old('post_category') }}" />
	</div>
	<div class="form-group">
		<input "@if($company->active) {{ 'checked="checked"' }} @endif"  type="checkbox" name = "active" class="form-control " /> Activo?
	</div>

	<input type="submit" name='publish' class="btn btn-success" value = "Editar" />

</form>
@endsection

@push('scripts')
<script src="{{ asset('/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js') }}" ></script>
@endpush


@push('styles')
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}" />
@endpush