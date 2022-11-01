<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $primaryKey = 'id';
    protected $fillable = [
        "tanggal_surat",
        "tanggal_keluar",
        "perihal",
        "sifat",
        "lampiran",
        "kode_instansi",
        "file",
    ];
}
