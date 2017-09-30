@extends('app')

@section('title')
{{ $user->name }}
@endsection

@section('content')
{{--  <div>
	<ul class="list-group">
		<li class="list-group-item"  style="background-color: rgba(84,84,84,0.54) !important;">
			Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body" style="background-color: rgba(84,84,84,0.54) !important;">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Total de Art&iacute;culos</td>
					<td> {{$posts_count}}</td>
					@if($author && $posts_count)
					<td><a href="{{ url('/my-all-posts')}}">Show All</a></td>
					@endif
				</tr>
				<tr>
					<td>Art&iacute;culos Publicados</td>
					<td>{{$posts_active_count}}</td>
					@if($posts_active_count)
					<td><a href="{{ url('/user/'.$user->id.'/posts')}}">Show All</a></td>
					@endif
				</tr>
				<tr>
					<td>Art&iacute;culos En Borrador </td>
					<td>{{$posts_draft_count}}</td>
					@if($author && $posts_draft_count)
					<td><a href="{{ url('my-drafts')}}">Show All</a></td>
					@endif
				</tr>
			</table>
		</li>
		<li class="list-group-item"  style="background-color: rgba(84,84,84,0.54) !important;">
			Total Comments {{$comments_count}}
		</li>
	</ul>
</div>  --}}
{{--  
<div style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: rgba(84,84,84,0.54) !important;">
	<div class="panel-heading"><h3>Latest Posts</h3></div>
	<div class="panel-body">
		@if(!empty($latest_posts[0]))
		@foreach($latest_posts as $latest_post)
			<p>
				<strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
				<span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
			</p>
		@endforeach
		@else
		<p>You have not written any post till now.</p>
		@endif
	</div>
</div>  --}}

{{--  <div style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: rgba(84,84,84,0.54) !important;">
	<div class="panel-heading"><h3>Latest Comments</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
		@foreach($latest_comments as $latest_comment)
			<div class="list-group-item"  style="background-color: rgba(84,84,84,0.54) !important;">
				<p>{{ $latest_comment->body }}</p>
				<p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
				<p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{    $latest_comment->post->title }}</a></p>
			</div>
		@endforeach
		@else
		<div class="list-group-item"  style="background-color: rgba(84,84,84,0.54) !important;">
			<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
		</div>
		@endif
	</div>
</div>  --}}


@if($is_pharmaceutical_manager)

<div style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: white !important;">
	<div class="panel-heading">
		<h3>{{ $pharmaceutical_name }}</h3>
	</div>
	<div class="list-group" style="background-color: white !important;">
		
		<div class="row">

			<div class="col-md-12 col-lg-12 col-sm-12 text-center">

				<h1 class="m-0">C&oacute;digo a Brindar a sus afiliados: {{ $pharmaceutical_code }}</h1>

			</div>

		</div>
		
	</div>
</div>

@endif

@if($is_admin )

<h3>Panel Administrativo</h3>

<div style="background-color: white !important; margin: 5px; padding: 5px;">
	<div class="panel-heading">
		
		<p style="font-style: italic; border-bottom: 1px solid #666; color: #fc3;">Usuarios por Casa Farmac&eacute;utica</p>

	</div>
	<div class="list-group" style="background-color: white !important;">
		
		
		{{--  @todo AUTOMATIZAR  --}}
		<div class="row">

 						@foreach( \App\PharmaceuticalCompanies::where('active', true)->get() as $cmp)
                            
							<div class="col-md-4 text-center">

								<h1 class="m-0">{{ Auth::user()->where('pharmaceutical',  $cmp->post_category)->where('role', 'subscriber')->count()  }}</h1>
								<h1 class="m-0">{{ $cmp->name }}</h1>

								<div style="border: 1px dashed #666; font-size: 16px; color: #666; height: 40px; padding: 10px; ">
									C&oacute;digo a Brindar: {{ $cmp->affiliate_code }}
								</div>

							</div>

                        @endforeach

{{--  
			<div class="col-md-4 text-center">

				<h1 class="m-0">{{ $asofarma_count }}</h1>
				<h1 class="m-0">Asofarma</h1>

				<div style="border: 1px dashed whitesmoke;font-size: 16px; color: whitesmoke; height: 40px; padding: 10px; ">
					C&oacute;digo a Brindar: {{ $aso_pharmaceutical_code }}
				</div>

			</div>

			<div class="col-md-4 text-center">

				<h1 class="m-0">{{ $rowe_count }}</h1>
				<h1 class="m-0">Rowe</h1>
				
				<div style="border: 1px dashed whitesmoke;font-size: 16px; color: whitesmoke; height: 40px; padding: 10px; ">
					C&oacute;digo a Brindar: {{ $rowe_pharmaceutical_code }}
				</div>

			</div>

			<div class="col-md-4 text-center">

				<h1 class="m-0">{{ $denkpharma_count }}</h1>
				<h1 class="m-0">Denk Pharma</h1>

				<div style="border: 1px dashed whitesmoke;font-size: 16px; color: whitesmoke; height: 40px; padding: 10px; ">
					C&oacute;digo a Brindar: {{ $denk_pharmaceutical_code }}
				</div>



			</div>  --}}

		</div>
		
	</div>
</div>

@elseif(Auth::user()->is_pharmaceutical_manager)

	<h3>Panel Administrativo</h3>

<div style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: white !important; margin: 5px; padding: 5px;">
	<div class="panel-heading">
		
		<p style="font-style: italic; border-bottom: 1px solid #666; color: #fc3;">Usuarios Registrados en mi Casa Farmac&eacute;utica</p>

	</div>
	<div class="list-group" style="background-color: white !important;">
		
		
		{{--  @todo AUTOMATIZAR  --}}
		<div class="row">

			<div class="col-md-12 text-center">

 						@foreach( \App\PharmaceuticalCompanies::where('active', true)->get() as $cmp)
                    
							@if(Auth::user()->pharmaceutical == $cmp->post_category)
								<h1 class="m-0">{{ Auth::user()->where('pharmaceutical',  $cmp->post_category)->where('role', 'subscriber')->count() }}</h1>
								<h1 class="m-0">{{ Auth::user()->pharmaceutical }}</h1>

								<div style="border: 1px dashed #666; font-size: 16px; color: #666; height: 40px; padding: 10px; ">
									C&oacute;digo a Brindar: {{ $cmp->affiliate_code }}
								</div>
							@endif
					
                        @endforeach

					{{--  @if(Auth::user()->pharmaceutical == 'Asofarma')
						<h1 class="m-0">{{ $asofarma_count }}</h1>
					@endif
					@if(Auth::user()->pharmaceutical == 'ROWE')
						<h1 class="m-0">{{ $rowe_count }}</h1>
					@endif
					@if(Auth::user()->pharmaceutical == 'Denk Pharma')
					<h1 class="m-0">{{ $denkpharma_count }}</h1>
					@endif  --}}

				{{--  <h1 class="m-0">Auth::user()->pharmaceutical</h1>

				<div style="border: 1px dashed whitesmoke;font-size: 16px; color: whitesmoke; height: 40px; padding: 10px; ">
					C&oacute;digo a Brindar:
					
					@if(Auth::user()->pharmaceutical == 'Asofarma')
						{{ $aso_pharmaceutical_code }}
					@endif
					@if(Auth::user()->pharmaceutical == 'ROWE')
						{{ $rowe_pharmaceutical_code }}
					@endif
					@if(Auth::user()->pharmaceutical == 'Denk Pharma')
						{{ $denk_pharmaceutical_code }}
					@endif
					
				</div>  --}}

			</div>


		</div>
		
	</div>
</div>

@else

<h3>Mi Perfil</h3>

<div style="box-shadow: 8px 1px 8px rgba(0,0,0,0.3); background-color: rgba(84,84,84,0.54) !important; margin: 5px; padding: 5px;">
	<div class="panel-heading">
		
		<p style="font-style: italic; border-bottom: 1px solid #666; color: #fc3;">Usuarios Registrados en mi Casa Farmac&eacute;utica</p>

	</div>
	<div class="list-group" style="background-color: rgba(84,84,84,0.54) !important;">
		
		
		{{--  @todo AUTOMATIZAR  --}}
		<div class="row">

			<div class="col-md-2">
				Nombre:
			</div>
			<div class="col-md-10">
				{{ Auth::user()->name }}
			</div>

			<div class="col-md-2">
				Correo:
			</div>
			<div class="col-md-10">
				{{ Auth::user()->email }}
			</div>

			<div class="col-md-2">
				Casa Farm.:
			</div>
			<div class="col-md-10">
				{{ Auth::user()->pharmaceutical }}
			</div>

			<div class="col-md-2">
				N&uacute;m. de Colegiado:
			</div>
			<div class="col-md-10">
				{{ Auth::user()->doctor_code }}
			</div>


		</div>
		
	</div>
</div>

@endif

@endsection
