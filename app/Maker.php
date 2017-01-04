<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model{

    protected $table= 'makers';

    protected $primaryKey= 'id';

    protected $fillable= ['name','phone'];    // ,'vehicle_id'

    protected $hidden = ['id','updated_at','created_at'];   // ,'vehicle_id'

    public function vehicles(){

        return $this->hasMany('App\Vehicle');
    }
}
