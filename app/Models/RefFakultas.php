<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefFakultas extends Model
{
    protected $table = 'ref_fakultas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'fakNama',
        'created_at',
        'updated_at',
    ];
}
