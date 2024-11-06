<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMenu extends Model
{
    use HasFactory;

    protected $table = 'parent_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'role',
        'parent_code',
        'parent_name',
        'ordered',
        'created_at',
        'updated_at',
    ];
}