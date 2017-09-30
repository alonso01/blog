<?php namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use DB;
use App\PharmaceuticalCompanies;

use Illuminate\Http\Request;

// note: use true and false for active posts in postgresql database
// here '0' and '1' are used for active posts because of mysql database

class CompaniesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$companies = PharmaceuticalCompanies::orderBy('created_at','desc')->get();
		return view('companies.list')->with('companies', $companies);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// 
		if($request->user()->is_admin())
		{
			return view('companies.create');
		}	
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$cmp = new \App\PharmaceuticalCompanies();
		$cmp->name = $request->input('name');
		$cmp->active = true;
		$cmp->affiliate_code = $request->input('affiliate_code');	
		$cmp->post_category = $request->input('post_category');
	
		$cmp->save();

		return redirect('list');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Posts::where('slug',$slug)->first();

		if($post)
		{
			if($post->active == false)
				return redirect('/')->withErrors('requested page not found');
			$comments = $post->comments;	
		}
		else 
		{
			return redirect('/')->withErrors('requested page not found');
		}
		return view('posts.show')->withPost($post)->withComments($comments);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request, $id)
	{
		$cmp = PharmaceuticalCompanies::find($id);
		if($request->user()->is_admin()){
			return view('companies.edit')->with('company',$cmp);
		}			
		else 
		{
			return redirect('/')->withErrors('you have not sufficient permissions');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$cmp_id = $request->input('company_id');
		$cmp = PharmaceuticalCompanies::find($cmp_id);
		if($cmp && $request->user()->is_admin())
		{
					
			$cmp->name = $request->input('name');	
			$cmp->active = $request->input('active');	
			$cmp->affiliate_code = $request->input('affiliate_code');	
			$cmp->post_category = $request->input('post_category');	
			$cmp->save();

			 return redirect('/companies/list');
			 
		}
		else
		{
			return redirect('/')->withErrors('you have not sufficient permissions gdfsgd' . $cmp_id);
		}
	}

}
