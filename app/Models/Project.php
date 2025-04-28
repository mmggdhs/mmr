<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class  Project extends Model{

    use HasFactory;

    protected $table = 'projects';

    protected $fillable = ['title','content','dev_id','file','video','lang','link'];

    protected $casts = [
        'date'=> 'datetime:Y-m-d'
    ];

    public $timestamps = false;

    // public static function devName(){
    //     DB::table('projects')->join('users','projects.dev_id','=','users.id')->get();
    // }

}