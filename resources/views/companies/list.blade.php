@extends('app')

@section('title')
Listar Compañías Farmacéuticas
@endsection

@section('content')

          <a href="new">Agregar</a>

		@if($companies)
		<table class="table">
                <thead>
                <tr>
                <th>Nombre</th>
                <th>C&oacute;d. de Afiliados</th>
                <th>Activo</th>
                <th></th>
                
            </tr>
                </thead>
            <tbody>
            @foreach($companies as $cmp)
				<tr>
                    <td>{{ $cmp->name }}</td>
                    <td>{{ $cmp->affiliate_code }}</td>
                    <td>
                        <input type="checkbox" disabled="disabled" "@if($cmp->active) {{ 'checked="checked"' }}  @endif"  class="form-control" />
                    </td>
                    <td>
                        <a href="edit/{{ $cmp->id }}">Editar</a>
                    </td>
                    
                </tr>
			@endforeach
            </tbody>
			
		</ul>
		@endif

@endsection