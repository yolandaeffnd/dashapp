<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appchart extends Model
{
    protected $table = 'appcharts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'idKategori',
        'namaChart',
        'urlChart',
        'idFakultas',
        'posisiChart',
        'created_at',
        'updated_at',

    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idKategori'); // 'idKategori' adalah foreign key
    }

    public function fakultas()
    {
        return $this->belongsTo(RefFakultas::class, 'idFakultas', 'id');
    }
}
