<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perhitungan.perhitungan');
        //
    }

    public function fetchHitung(Request $request)
    {
        $id = $request->id;
        $total = 0;
        $total5 = 0;
        $total7 = 0;
        $digit= 2;

        $output = '';
        
        $real = Penjualan::with('produk')
                            ->where('produk_id', $id)
                            ->get();

    if($real->count() >= 7){
        $dataTiga = Penjualan::with('produk')
                    ->where('produk_id',$id)
                    ->orderby('tanggal','DESC')
                    ->offset(0)
                    ->limit(3)
                    ->get();
        $dataLima = Penjualan::with('produk')
                    ->where('produk_id',$id)
                    ->orderby('tanggal','DESC')
                    ->offset(0)
                    ->limit(5)
                    ->get();
         $dataTujuh = Penjualan::with('produk')
                    ->where('produk_id',$id)
                    ->orderby('tanggal','DESC')
                    ->offset(0)
                    ->limit(7)
                    ->get();
                
        foreach ($dataTiga as $item) {
            $total += $item->penjualan; 
        }
        foreach ($dataLima as $lima) {
            $total5 += $lima->penjualan; 
        }
        foreach ($dataTujuh as $tujuh){
            $total7 += $tujuh->penjualan;

        }

        $hit3 = $total / 3;
        $hit5 = $total5 / 5;
        $hit7 = $total7 / 7;
        
        $ma3 = round($hit3,0,PHP_ROUND_HALF_DOWN);
        $ma5 = round($hit5,0,PHP_ROUND_HALF_DOWN);
        $ma7 = round($hit7,0,PHP_ROUND_HALF_DOWN);

        $output .= '<input type="hidden" value="'. $ma3 .'" id="prediksi3" name="prediksi3">';
        $output .= '<input type="hidden" value="'. $ma5 .'" id="prediksi5" name="prediksi5">';
        $output .= '<input type="hidden" value="'. $ma7 .'" id="prediksi7" name="prediksi7">';
        $output .= '<input type="hidden" value="'. $id .'" id="produk_id" name="produk_id">';
        
        echo $output;

    }elseif($real->count() >= 5){
         $dataTiga = Penjualan::with('produk')
                    ->where('produk_id',$id)
                    ->orderby('tanggal','DESC')
                    ->offset(0)
                    ->limit(3)
                    ->get();
        $dataLima = Penjualan::with('produk')
                    ->where('produk_id',$id)
                    ->orderby('tanggal','DESC')
                    ->offset(0)
                    ->limit(5)
                    ->get();
                
        foreach ($dataTiga as $item) {
            $total += $item->penjualan; 
        }
        foreach ($dataLima as $lima) {
            $total5 += $lima->penjualan; 
        }


        $hit3 = $total / 3;
        $hit5 = $total5 / 5;
        
        $ma3 = round($hit3,0,PHP_ROUND_HALF_DOWN);
        $ma5 = round($hit5,0,PHP_ROUND_HALF_DOWN);

        $output .= '<input type="hidden" value="'. $ma3 .'" id="prediksi3" name="prediksi3">';
        $output .= '<input type="hidden" value="'. $ma5 .'" id="prediksi5" name="prediksi5">';
        $output .= '<input type="hidden" value="'. $id .'" id="produk_id" name="produk_id">';
        
        echo $output;
    }elseif($real->count() >= 3){

        $dataPer = Penjualan::with('produk')
        ->where('produk_id',$id)
        ->orderby('tanggal','DESC')
        ->offset(0)
        ->limit(3)
        ->get();
    
        foreach ($dataPer as $item) {
            $total += $item->penjualan; 
        }

        $hit3 = $total / 3;
        
        $ma3 = round($hit3,0,PHP_ROUND_HALF_DOWN);

        $output .= '<input type="hidden" value="'. $ma3 .'" id="prediksi3" name="prediksi3">';
        $output .= '<input type="hidden" value="'. $id .'" id="produk_id" name="produk_id">';
        
        echo $output;

    }else{
        
    }

    }

    public function fetchData()
    {
        $dataRoti = Produk::all();
        return response()->json($dataRoti,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function error()
    {
        return view('error.error');
        //
    }

    public function fetchError(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
           
        ];
        $validate = Validator::make($request->all(),[
            
            "nama_roti" => 'required',

        ], $messages);

        $id = $request->nama_roti;
        $digit = 2;
        $detailTable = '';
        $output = '';
        $no = 1;
        $sumErr3 = 0;
        $sumError3 = 0;
        $sumApe3 = 0;
        $sumErr5 = 0;
        $sumError5 = 0;
        $sumApe5 = 0;
        $sumErr7 = 0;
        $sumError7=0;
        $sumApe7 = 0;

        $pnj = Penjualan::with('produk')
                            ->where('produk_id', $id)
                            ->get();
        $count = Penjualan::with('produk')
                            ->where('produk_id',$id)
                            ->count('err3');
        $count5 = Penjualan::with('produk')
                            ->where('produk_id',$id)
                            ->count('err5');
        $count7 = Penjualan::with('produk')
                            ->where('produk_id',$id)
                            ->count('err7');
 
    if($validate->fails()){

        return response()->json([
            'status' => 400,
            'errors' => $validate->messages(),
            //'message'=> 'gagal menambahkan data produk',

        ]); 
    }else{

            if ($pnj->count() > 0) {

                    $detailTable .= '<div class="text-center justify-content-center mb-4">
                                            <h4>Tabel Total Error</h4> 
                                        </div>';
                    $detailTable .= '</br>
                                <span>Nama produk = </span>
                                <label>'. $pnj[0]->produk->nama_produk .'</label>';
                    $detailTable .= '<table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
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
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($pnj as $item) {

                        $sumErr3 += $item->err3;
                        $sumError3 += $item->error3;
                        $sumApe3 += $item->ape3;

                        $sumErr5  += $item->err5;
                        $sumError5 += $item->error5;
                        $sumApe5 += $item->ape5;
                        
                        $sumErr7 += $item->err7;
                        $sumError7 += $item->error7;
                        $sumApe7 += $item->ape7;

                        $detailTable .= '<tr>
                                    <td>'. $no++ .'</td>
                                    <td>'. date('d-m-Y', strtotime($item->tanggal)) .'</td>
                                    <td>'. $item->penjualan .'</td>
                                    <td>'. $item->ma3 .'</td>
                                    <td>'. $item->err3 .'</td>
                                    <td>'. $item->error3 .'</td>
                                    <td>'. $item->ape3 .'<sup style="font-size: 15px"> %</sup></td>
                                    <td>'. $item->ma5 .'</td>
                                    <td>'. $item->err5 .'</td>
                                    <td>'. $item->error5 .'</td>
                                    <td>'. $item->ape5 .'<sup style="font-size: 15px"> %</sup></td>
                                    <td>'. $item->ma7 .'</td>
                                    <td>'. $item->err7 .'</td>
                                    <td>'. $item->error7 .'</td>
                                    <td>'. $item->ape7 .'<sup style="font-size: 15px"> %</sup></td>
                            
                                </tr>';
                    }

                    if ($count <= 0) $count = 1;  
                    if ($count5 <= 0) $count5 = 1;
                    if ($count7 <= 0) $count7 = 1;
                    
                    $mad3 = round(($sumErr3 / $count),2);
                    $mse3 = round(($sumError3 / $count),2);
                    $mape3 = round(($sumApe3 / $count),2);

                    $mad5 = round(($sumErr5 / $count5),2);
                    $mse5 = round(($sumError5 / $count5),2);
                    $mape5 = round(($sumApe5 / $count5),2);

                    $mad7 = round(($sumErr7 / $count7),2);
                    $mse7 = round(($sumError7 / $count7),2);
                    $mape7 = round(($sumApe7 / $count7),2);

                    $detailTable .= '</tbody></table>
                                    </br>';

                    $output .= '<div class="row">';
                    
                    $output .= '<div class="col-sm">
                                <h5>Total Error pergerakan 3</h5>';
                    $output .= '</br>
                                <label> Nilai MAD = </label>
                                <span>'. $mad3 .'</span>';
                    $output .= '</br>
                                <label> Nilai MSE = </label>
                                <span>'. $mse3 .'</span>';
                    $output .= '</br>
                                <label> Nilai MAPE = </label>
                                <span>'. $mape3 .' %</span>';  
                                
                    $output .='</div>';

                    $output .= '<div class="col-sm">
                                <h5>Total Error pergerakan 5</h5>';
                    $output .= '</br>
                                <label> Nilai MAD = </label>
                                <span>'. $mad5 .'</span>';
                    $output .= '</br>
                                <label> Nilai MSE = </label>
                                <span>'. $mse5 .'</span>';
                    $output .= '</br>
                                <label> Nilai MAPE = </label>
                                <span>'. $mape5 .' %</span>';  
                                
                    $output .='</div>';

                    $output .= '<div class="col-sm">
                                <h5>Total Error pergerakan 7</h5>';
                    $output .= '</br>
                                <label> Nilai MAD = </label>
                                <span>'. $mad7 .'</span>';
                    $output .= '</br>
                                <label> Nilai MSE = </label>
                                <span>'. $mse7 .'</span>';
                    $output .= '</br>
                                <label> Nilai MAPE = </label>
                                <span>'. $mape7 .' %</span>';  
                                
                    $output .='</div>';
                    
                    
                    $output .='</div>';
                    


                    echo $detailTable;
                    echo $output;
                

              
                } else {
                    echo '<h1 class="text-center text-secondary my-5">tidak ada data di database!</h1>';
                }

            }

		
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
            'produk_id' => 'required',
            'tanggal' =>'required',
            'hasil3'=>'',
            'hasil5'=>'',
            'hasil7'=>'',

        ], $messages);
        
        if($validate->fails()){

            return response()->json([
                'status' => 400,
                'errors' => $validate->messages(),
                //'message'=> 'gagal menambahkan data produk',
    
            ]);           

        }else{

            // Penjualan::updateOrCreate(
            //     [
            //     'produk_id' => request('produk_id'),
            //     'ma3' => request('hasil3'),
            //     'ma5' => request('hasil5'),
            //     'ma7' => request('hasil7'),
            //     ],
            //     [
            //     'tanggal'=>request('tanggal'),
            //     ]
            // );
            
            Penjualan::create([
                'produk_id' => request('produk_id'),
                'tanggal' =>request('tanggal'),
                 'ma3' => request('hasil3'),
                 'ma5' => request('hasil5'),
                 'ma7' => request('hasil7'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'berhasil menambahkan penjualan',
            ]);
        //
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
