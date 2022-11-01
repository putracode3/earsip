<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $primaryKey = 'id';
    protected $fillable = [
        "tanggal_surat",
        "tanggal_diterima",
        "perihal",
        "sifat",
        "lampiran",
        "kode_instansi",
        "file",
    ];
}
