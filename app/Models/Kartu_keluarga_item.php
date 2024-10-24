<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kartu_keluarga_item extends Model
{
    //
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];
    protected $fillable = [
        'kartu_keluarga_id',
        'ktp_id',
        'status_hubungan'
    ]; 

    function ktp(){

        return $this->belongsTo(Ktp::class);
    }

    function kk(){

        return $this->belongsTo(Kartu_keluarga::class);
    }
}
