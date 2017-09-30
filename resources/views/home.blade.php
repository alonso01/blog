@extends('app')

@section('title')
{{$title}}
@endsection

@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush

@section('content')

<div class="row" style="margin: 10px auto;">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-lg-8 col-xs-12 text-center">
        <input type="text" class="form-control input-lg" placeholder="Busca Cualquier Artículo" id="txtSearchCriteria" value="@if($s) {!! $s !!} @endif" />
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row" style="margin: 10px auto;">
    <div class="col-md-2"></div>
    <div class="col-md-8  col-lg-8 col-xs-12 text-center">
        <button type="text" id="btnSearchForm" class="form-control btn-lg btn-info" onclick="searchPosts(document.getElementById('txtSearchCriteria').value)">Buscar</button>
    </div>
<div class="col-md-2"></div>
</div>

@if ( !$posts->count() )
No hay informacion registrada.
@else
<div style="margin: 10px 0;">

    @if ( $s)
    <div class="alert alert-info" role="alert">Buscando:  {{ $s }}</div>    
    @endif

    @foreach( $posts as $post )
    <div class="list-group">
        <div class="list-group-item" style="margin:10px;border: 0; /*box-shadow: 8px 1px 8px rgba(0,0,0,0.3);*/ background-color: white !important;">
            <h3>
                <a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                    @if($post->active == '1')
                    <a href="{{ url('edit/'.$post->slug)}}" style="float: right;">Editar</a>
                    @else
                    <a href="{{    url('edit/'.$post->slug)}}" style="float: right;">Editar Borrador</a>
                    @endif
                @endif
            </h3>
            <p>
                <!-- {{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{    $post->author->name }}</a>-->
            </p>

        </div>
        <div class="list-group-item" style="/*box-shadow: 8px 1px 8px rgba(0,0,0,0.3); */ background-color: white; !important;margin:10px;">
            <article>
                {!! str_limit($post->body, $limit = 1500, $end = '.......
                <a href='.url("/".$post->slug).'>Leer Mas</a>') !!}
            </article>
        </div>
    </div>
    @endforeach
    {!! $posts->render() !!}
</div>
@endif

@endsection



@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function searchPosts(s){

        if (s == ''){
            toastr.warning('Por favor ingrese un criterio de búsqueda');
            return;
        }

        this.window.document.location.href="http://conmidoctor.com/biblioteca/public/home/"+ s;

    }
</script>
@endpush