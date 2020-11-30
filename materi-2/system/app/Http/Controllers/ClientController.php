<?php 

namespace App\Http\Controllers;
use App\Models\Produk;

class ClientController extends Controller {

	function index(){
		$data['list_produk'] = Produk::all();
		return view ('home', $data);
	}
}