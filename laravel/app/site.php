<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{

    protected $fillable = ['name', 'url', 'img', 'description', 'turn', 'delete_flg', 'created_at', 'updated_at'];
}
