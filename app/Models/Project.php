<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Project extends Model{

    use HasFactory;

    protected $table = 'projects';
    protected $fillable = ['title','content','lang','dev_id','file'];
    protected $casts = [
        'date'=> 'datetime:Y-m-d'
    ];

    public $timestamps = false;

}