<?php
namespace App\Models;



class Stationery extends BaseModel
{
    protected $table = 'stationeries';


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}