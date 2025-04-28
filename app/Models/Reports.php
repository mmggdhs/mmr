<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Reports extends Model{

    use HasFactory;

    protected $table = 'Reports';

    protected $fillable = ['details','user_id','project_id'];

    protected $casts = [
        'date'=> 'datetime:Y-m-d'
    ];

    public $timestamps = false;

}