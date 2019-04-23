<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'parentId',
    ];

}
