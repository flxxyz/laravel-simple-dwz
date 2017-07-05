<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'shows';

    protected $primaryKey = 'id';

    protected $fillable = ['link_id'];

    public $timestamps = true;

    protected function asTimestamp($value)
    {
        return $value;
    }

    protected function getDateFormat() {
        return time();
    }
}
