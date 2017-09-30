<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuillermoMartinez\Filemanager\Filemanager;

class FilemanagerController extends Controller {
	public function __construct(){
		// $this->middleware('auth');
	}
	public function getIndex()
	{
		return view('filemanager.filemanager');
	}
	public function getConnection()
	{
		$extra = array(
		    // path after of root folder
		    // if /var/www/public_html is your document root web server
		    // then source= usefiles o filemanager/usefiles
		    "source" => "public/assets",
		    // url domain
		    // so that the files and show well http://php-filemanager.rhcloud.com/userfiles/imagen.jpg
		    // o http://php-filemanager.rhcloud.com/filemanager/userfiles/imagen.jpg
		    "url" => "http://conmidoctor.com/biblioteca/public/",
		    );						
		$f = new Filemanager($extra);
		$f->run();
	}
	public function postConnection()
	{
		$extra = array(
		    // path after of root folder
		    // if /var/www/public_html is your document root web server
		    // then source= usefiles o filemanager/usefiles
		    "source" => "public/assets",
		    // url domain
		    // so that the files and show well http://php-filemanager.rhcloud.com/userfiles/imagen.jpg
		    // o http://php-filemanager.rhcloud.com/filemanager/userfiles/imagen.jpg
		    "url" => "http://conmidoctor.com/biblioteca/public/",
		    );
		if(isset($_POST['typeFile']) && $_POST['typeFile']=='images'){
		    $extra['type_file'] = 'images';
		}
		$f = new Filemanager($extra);
		$f->run();
	}
}