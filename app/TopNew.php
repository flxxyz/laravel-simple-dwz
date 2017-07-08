<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopNew extends Model
{
    protected $table = 'top_news';

    protected $primaryKey = 'id';

    protected $fillable = ['link_id', 'title'];

    public $timestamps = true;

    protected function asTimestamp($value)
    {
        return $value;
    }

    protected function getDateFormat()
    {
        return time();
    }
}
