<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = ['phone','user_id', 'location', 'p_address', 'p_code', 'image'];
}
