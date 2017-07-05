<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $primaryKey = 'id';

    protected $fillable = ['as' , 'hash', 'uri', 'ip'];

    public $timestamps = true;

    protected function asTimestamp($value)
    {
        return $value;
    }

    protected function getDateFormat() {
        return time();
    }

}
