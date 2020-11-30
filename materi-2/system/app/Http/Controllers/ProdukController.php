<?php 

namespace App\Http\Controllers;
use App\Models\Produk;

class ProdukController extends Controller {
	function index(){
		$user = request()->user();
		$data['list_produk'] = $user->produk;
		return view ('produk.index', $data);

	}

	function create(){
		return view ('produk.create');

	}

	function store(){
		$produk = new Produk;
		$produk->id_user = request()->user()->id;
		$produk->nama = request('nama');
		$produk->harga = request('harga');
		$produk->berat = request('berat');
		$produk->stok = request('stok');
		$produk->deskripsi = request('deskripsi');
		$produk->save();

		return redirect('admin/produk')->with('success', 'Data Berhasil Ditambahkan');

	}

	function show(Produk $produk){
		$data['produk'] = $produk;
		return view('produk.show', $data);
	}

	function edit(Produk $produk){
		$data['produk'] = $produk;
		return view('produk.edit', $data);
		
	}

	function update(Produk $produk){
		$produk->nama = request('nama');
		$produk->harga = request('harga');
		$produk->berat = request('berat');
		$produk->stok = request('stok');
		$produk->deskripsi = request('deskripsi');
		$produk->save();

		return redirect('admin/produk')->with('warning', 'Data Berhasil Diedit');
		
	}

	function destroy(Produk $produk){
		$produk->delete();


		return redirect('admin/produk')->with('danger', 'Data Berhasil Dihapus');
	}

	function filter(){
		$nama = request('nama'); 
		$stok =  request('stok');
		$harga_min = request('harga_min'); 
		$harga_max = request('harga_max');
		$data['list_produk'] = Produk::whereBetween('harga' , [$harga_min, $harga_max])->get();
		$data['nama'] =$nama;
		$data['stok'] = $stok;
		$data ['harga_min'] =$harga_min;		
		$data ['harga_max'] =$harga_max;		


 
	}

 }
		// $data['list_produk'] = Produk::whereBetween('harga' , [$harga_min, $harga_max])->whereNot ('stok',  [150])->whereYear('created_at', '2020')-> get();


		// $data['list_produk'] = Produk::where('nama' , 'like' "%$nama%")->get();
		// $data['list_produk'] = Produk::whereIn('nama' , $stok)->get();
 		// $data['list_produk'] = Produk::where('stok' , '<>' "$")->get();
		// $data['list_produk'] = Produk::whereIn('nama' , $stok)->get();
		// $data['list_produk'] = Produk::whereNotBetween('harga' , [$harga_min, $harga_max])->get();
		// $data['list_produk'] = Produk::whereNull('stok')->get();
		// $data['list_produk'] = Produk::whereNotNull('stok')->get();
		// $data['list_produk'] = Produk::whereDate('created_at', '2020-11-23')->get();
		// $data['list_produk'] = Produk::whereYear('created_at', '2020')->get();
		// $data['list_produk'] = Produk::whereMonth('created_at', '11')->get();
		// $data['list_produk'] = Produk::whereMonth('created_at', '11')->whereYear('created_at', '2020')get();
		// $data['list_produk'] = Produk::whereDate('created_at', '2020-11-23')->get();
		// $data['list_produk'] = Produk::whereTime('created_at', '08:00:00')->get();


