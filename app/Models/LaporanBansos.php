<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBansos extends Model
{
    use HasFactory;

    protected $table = 'bantuan_warga'; 

    protected $fillable = [
        'nik', 
        'jenis_bansos', 
        'periode', 
        'status_penyaluran'
    ];

    public $timestamps = false;

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'nik', 'nik'); 
    }
}