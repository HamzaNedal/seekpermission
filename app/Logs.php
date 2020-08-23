<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logs extends Model
{
    use SoftDeletes;

    protected $table = 'logs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id', 'admin_id','status'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h-m-s',
    ];

    public function getStatusAttribute($value){
        if($value == 0){
            return 'pendding';
        }elseif($value == 1){
            return 'accepted';

        }elseif($value == 2){
            return 'rejected';
        }
    }

    public function request()
    {
       return $this->belongsTo('App\Requests','request_id');
    }

    public function user()
    {
        return  $this->belongsTo('app\User','admin_id');
    }
    
}
