@extends('app')

@section('title')
{{ $user->name }}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Total Posts</td>
					<td> {{$posts_count}}</td>
					@if($author && $posts_count)
					<td><a href="{{ url('/my-all-posts')}}">Show All</a></td>
					@endif
				</tr>
				<tr>
					<td>Published Posts</td>
					<td>{{$posts_active_count}}</td>
					@if($posts_active_count)
					<td><a href="{{ url('/user/'.$user->id.'/posts')}}">Show All</a></td>
					@endif
				</tr>
				<tr>
					<td>Posts in Draft </td>
					<td>{{$posts_draft_count}}</td>
					@if($author && $posts_draft_count)
					<td><a href="{{ url('my-drafts')}}">Show All</a></td>
					@endif
				</tr>
			</table>
		</li>
		<li class="list-group-item">
			Total Comments {{$comments_count}}
		</li>
	</ul>
</div>

<div class="panel panel-default">
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
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>Latest Comments</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
		@foreach($latest_comments as $latest_comment)
			<div class="list-group-item">
				<p>{{ $latest_comment->body }}</p>
				<p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
				<p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{    $latest_comment->post->title }}</a></p>
			</div>
		@endforeach
		@else
		<div class="list-group-item">
			<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
		</div>
		@endif
	</div>
</div>

@if($is_admin )
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Casas Farmaceuticas</h3>
    </div>
    <div class="list-group">
        
        <div class="row">

            <div class="col-md-4 text-center">

                <h1 class="m-0">{{ $asofarma_count }}</h1>
                <span class="text-muted">Asofarma</span>

            </div>

            <div class="col-md-4 text-center">

                <h1 class="m-0">{{ $rowe_count }}</h1>
                <span class="text-muted">Rowe</span>

            </div>

            <div class="col-md-4 text-center">

                <h1 class="m-0">{{ $denkpharma_count }}</h1>
                <span class="text-muted">Denk Pharma</span>

            </div>

        </div>
        
    </div>
</div>
@endif

@endsection
