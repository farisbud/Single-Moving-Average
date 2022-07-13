<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('produk.produk');
        //
    }

    public function fetchTable()
    {
        $produk = Produk::all();
        $output = '';
        $no= 1;

		if ($produk->count() > 0) {
            
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
			foreach ($produk as $item) {
				$output .= '<tr>
                            <td>'. $no++ .'</td>
                            <td>'. $item->nama_produk .'</td>
                           
                            <td class="project-actions text-center">
                                <a class="btn btn-info btn-sm editPro" id="'.$item->id.'">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm deletePro" href="#" id="'.$item->id.'">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                         </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
           
        ];
        $validate = Validator::make($request->all(),[
            
            'nama_produk' => 'required',
        
        ], $messages);


        if($validate->fails()){

            return response()->json([
                'status' => 400,
                'errors' => $validate->messages(),
                //'message'=> 'gagal menambahkan data produk',
    
            ]);           

        }else{

            Produk::create([
                
                'nama_produk'=>request('nama_produk'),
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => 'berhasil menambahkan produk',
    
            ]);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $id)
    {
        return response()->json($id,200);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
           
        ];
        $validate = Validator::make($request->all(),[
            
            'nama_produk' => 'required',
        ], $messages);


        if($validate->fails()){

            return response()->json([
                'status' => 400,
                'errors' => $validate->messages(),
                //'message'=> 'gagal menambahkan data produk',
    
            ]);           

        }else{

            Produk::where('id', $id)
                        ->update([
                            'nama_produk' => $request->nama_produk,
                        ]);
                        
            
            return response()->json([
                'status' => 200,
                'message' => 'berhasil merubah produk',
    
            ]);

        }


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
       try {
        $produk->delete();   
       } catch (\Throwable $th) {

        return response()->json([
            'status' => 200,
            'message'=> 'Data produk gagal dihapus, karena data masih digunakan diperhitungan SAW'
        ]);

       }
        
        return response()->json([
            'status' => 200,
            'message'=> 'Data produk berhasil dihapus'
        ]);
    
    }
}
