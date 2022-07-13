<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.penjualan');
        //
    }

    public function fetchTable(){

        $data = DB::table('penjualan')
                    ->select('tanggal', DB::raw('count(penjualan) as sum'))
                    ->groupBy('tanggal')
                    ->get();
    
        $output = '';
        $no= 1;

		if ($data->count() > 0) {
            
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah Penjualan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
			foreach ($data as $item) {
				$output .= '<tr>
                            <td>'. $no++ .'</td>
                            <td>'. date('d-m-Y',strtotime($item->tanggal)) .'</td>
                            <td>'. $item->sum .'</td>
                           
                            <td class="project-actions text-center">
                                <a href="/penjualan-detail/'.$item->tanggal.'" class="btn btn-info btn-sm">
                                    <i class="fas fa-folder">
                                    </i>
                                    view
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

    public function fetchProduk()
    {

        return response()->json([
            'produk' => Produk::all(),
        ],200);

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
            
            'nama_roti' => 'required',
            'tanggal' =>'required',
            'penjualan' => 'required',

        ], $messages);


        if($validate->fails()){

            return response()->json([
                'status' => 400,
                'errors' => $validate->messages(),
                //'message'=> 'gagal menambahkan data produk',
    
            ]);           

        }else{

            Penjualan::create([
                
                'produk_id'=>request('nama_roti'),
                'tanggal' => request('tanggal'),
                'penjualan' => request('penjualan'),
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => 'berhasil menambahkan penjualan',
    
            ]);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function penjualanDetail()
    {

        return view('penjualan.list_penjualan');

    }

    public function fetchDetail($tgl)
    {

        $pnj = Penjualan::with('produk')
                        ->where('tanggal', $tgl)
                        ->get();

        $detailTable = '';
        $no= 1;

		if ($pnj->count() > 0) {
            
			$detailTable .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Penjualan</th>
                    <th>perdiksi 3</th>
                    <th>error</th>
                    <th>error<sup style="font-size: 12px"> 2</sup></th>
                    <th>ape</th>
                    <th>perdiksi 5</th>
                    <th>error</th>
                    <th>error<sup style="font-size: 12px"> 2</sup></th>
                    <th>ape</th>
                    <th>perdiksi 7</th>
                    <th>error</th>
                    <th>error<sup style="font-size: 12px"> 2</sup></th>
                    <th>ape</th>

                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
			foreach ($pnj as $item) {

				$detailTable .= '<tr>
                            <td>'. $no++ .'</td>
                            <td>'. $item->produk->nama_produk .'</td>
                            <td>'. $item->penjualan .'</td>
                            <td>'. $item->ma3 .'</td>
                            <td>'. $item->err3 .'</td>
                            <td>'. $item->error3 .'</td>
                            <td>'. $item->ape3 .' %</td>
                            <td>'. $item->ma5 .'</td>
                            <td>'. $item->err5 .'</td>
                            <td>'. $item->error5 .'</td>
                            <td>'. $item->ape5 .' %</td>
                            <td>'. $item->ma7 .'</td>
                            <td>'. $item->err7 .'</td>
                            <td>'. $item->error7 .'</td>
                            <td>'. $item->ape7 .' %</td>
                           
                            <td class="project-actions text-center">
                            <a class="btn btn-info btn-sm editPnj" id="'. $item->id .'">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm deletePnj" id="'. $item->id .'" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                         </tr>';
			}
			$detailTable .= '</tbody></table>';
			echo $detailTable;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        return response()->json([
            'produk'=>Produk::all(),
            'penjualan'=>Penjualan::with('produk')
                                    ->where('id', $id)
                                    ->get(),
        ],200);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
           
        ];
        $validate = Validator::make($request->all(),[
            
            'nama_roti' => 'required',
            'tanggal' =>'required',
            'penjualan' => 'required',

        ], $messages);


        if($validate->fails()){

            return response()->json([
                'status' => 400,
                'errors' => $validate->messages(),
                //'message'=> 'gagal menambahkan data produk',
    
            ]);           

        }else{

            $nilai3 = 0;
            $nilai5 = 0;
            $nilai7 = 0;
            $penjualan = $request->penjualan;

            $real = Penjualan::select('penjualan')
                                ->orderby('id','DESC')
                                ->get();
            
            $dataTiga = Penjualan::select('ma3')
                                ->orderby('id','DESC')
                                ->limit(1)
                                ->get();

            $dataLima = Penjualan::select('ma5')
                                ->orderby('id','DESC')
                                ->limit(1)
                                ->get();

            $dataTujuh = Penjualan::select('ma7')
                                    ->orderby('id','DESC')
                                    ->limit(1)
                                    ->get();


            foreach($dataTiga as $tiga){
                        $nilai3 += $tiga->ma3;
                    }            

            foreach($dataLima as $lima){
                        $nilai5 += $lima->ma5;
                    }

            foreach($dataTujuh as $tujuh){
                        $nilai7 += $tujuh->ma7;
                    }


                    $err3 = round((abs($penjualan - $nilai3)),2);
                    $error3 = round((abs($err3 * $err3)),2);

                    $err5 = round((abs($penjualan - $nilai5)),2);
                    $error5 = round((abs($err5 * $err5)),2);

                    $err7 = round((abs($penjualan - $nilai7)),2);
                    $error7 = round((abs($err7 * $err7)),2);

                    $ape3 = round((100 * ($err3 / $penjualan)),2);
                    $ape5 = round((100 * ($err5 / $penjualan)),2);
                    $ape7 = round((100 * ($err7 / $penjualan)),2);

                if($real->count() >= 8){

                    Penjualan::where('id',$id)
                    ->update([
                        "produk_id" => $request->nama_roti,
                        "tanggal" => $request->tanggal,
                        "penjualan" => $penjualan,
                        "err3" => $err3,
                        "error3" => $error3,
                        "ape3" => $ape3,
                        "err5" => $err5,
                        "error5" => $error5,
                        "ape5" => $ape5,
                        "err7" => $err7,
                        "error7" => $error7,
                        "ape7" => $ape7,

                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'berhasil mengubah penjualan',
            
                    ]);
                }elseif($real->count() >= 6){

                    Penjualan::where('id',$id)
                    ->update([
                        "produk_id" => $request->nama_roti,
                        "tanggal" => $request->tanggal,
                        "penjualan" => $penjualan,
                        "err3" => $err3,
                        "error3" => $error3,
                        "ape3" => $ape3,
                        "err5" => $err5,
                        "error5" => $error5,
                        "ape5" => $ape5,
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'berhasil mengubah penjualan',
            
                    ]);

                }elseif($real->count() >= 4) {

                    Penjualan::where('id',$id)
                    ->update([
                        "produk_id" => $request->nama_roti,
                        "tanggal" => $request->tanggal,
                        "penjualan" => $penjualan,
                        "err3" => $err3,
                        "error3" => $error3,
                        "ape3" => $ape3,

                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'berhasil mengubah penjualan',
            
                    ]);

                }else{

                    Penjualan::where('id',$id)
                    ->update([
                        "produk_id" => $request->nama_roti,
                        "tanggal" => $request->tanggal,
                        "penjualan" => $penjualan,
                    ]);
                
                    return response()->json([
                        'status' => 200,
                        'message' => 'berhasil mengubah penjualan',
            
                    ]);
                    
                }


               
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pnj = Penjualan::findOrFail($id);
        
       try {
        $pnj->delete();   
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
        //
    }
}
