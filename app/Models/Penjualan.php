<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Penjualan extends Model
{
    use HasFactory;
    
    protected $table ='penjualan';
    
    protected $fillable = [
        'produk_id',
        'tanggal',
        'penjualan',
        'ma3',
        'error3',
        'error^3',
        'ape3',
        'ma5',
        'error5',
        'error^5',
        'ape5',
        'ma7',
        'error7',
        'error^7',
        'ape7',
    ];
    
    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
