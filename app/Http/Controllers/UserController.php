<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Posts;

use Illuminate\Http\Request;

class UserController extends Controller {

		/*
	 * Display the posts of a particular user
	 *
	 * @param int $id
	 * @return Response
	 */
	public function user_posts($id)
	{
		//
		$posts = Posts::where('author_id',$id)->where('active','1')->orderBy('created_at','desc')->paginate(10);
		$title = User::find($id)->name;
		return view('home')->withPosts($posts)->withTitle($title)->with('s', '');
	}

	public function user_posts_all(Request $request)
	{
		//
		$user = $request->user();
		$posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
		$title = $user->name;
		return view('home')->withPosts($posts)->withTitle($title);
	}

	public function user_posts_draft(Request $request)
	{
		//
		$user = $request->user();
		$posts = Posts::where('author_id',$user->id)->where('active','0')->orderBy('created_at','desc')->paginate(5);
		$title = $user->name;
		return view('home')->withPosts($posts)->withTitle($title);
	}

	/**
	 * profile for user
	 */
	public function profile(Request $request, $id)
	{
		$data['user'] = User::find($id);
		if (!$data['user'])
			return redirect('/');

		if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
			$data['author'] = true;
		} else {
			$data['author'] = null;
		}
		$data['comments_count'] = $data['user']->comments->count();
		$data['posts_count'] = $data['user']->posts->count();
		$data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
		$data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
		$data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);
		$data['latest_comments'] = $data['user']->comments->take(5);

        $data['asofarma_count'] = $data['user']->where('pharmaceutical', 'Asofarma')->where('role', 'subscriber')->count();
        $data['denkpharma_count'] = $data['user']->where('pharmaceutical', 'Denk Pharma')->where('role', 'subscriber')->count();
        $data['rowe_count'] = $data['user']->where('pharmaceutical', 'Rowe')->where('role', 'subscriber')->count();
        $data['is_admin'] = $request->user()->is_admin();
		$data['is_pharmaceutical_manager'] = $request->user()->is_pharmaceutical_manager();
		
		if($request->user()->is_pharmaceutical_manager()){
			$data['pharmaceutical_name'] = $request->user()->pharmaceutical;
			$data['pharmaceutical_code'] = $request->user()->affiliate_code;			
		}else if( $request->user()->is_admin()){
			//@todo AUTOMATIZAR
			$data['aso_pharmaceutical_code'] = \App\PharmaceuticalCompanies::find(1)->affiliate_code;
			$data['denk_pharmaceutical_code'] = \App\PharmaceuticalCompanies::find(2)->affiliate_code;
			$data['rowe_pharmaceutical_code'] = \App\PharmaceuticalCompanies::find(3)->affiliate_code;
		}

		return view('admin.profile', $data);
	}

}

