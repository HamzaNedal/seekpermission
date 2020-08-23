<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use SoftDeletes;

    protected $table = 'requests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'note', 'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h-m-s',
    ];


    public function employee()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function logs()
    {
        return $this->hasMany('App\Logs','request_id')->orderBy('created_at','desc');
    }

    public function getStatusAttribute($value){
        if($value == 0){
            return 'pendding';
        }elseif($value == 1){
            return 'accepted';

        }elseif($value == 2){
            return 'rejected';

        }
    }
}
