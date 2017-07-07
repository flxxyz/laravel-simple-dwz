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

    public function aaa($index = 0)
    {
        switch ($index) {
            case 0:
                return 'is-info';
                break;
            case 1:
                return 'is-primary';
                break;
            case 2:
                return 'is-success';
                break;
            case 3:
                return 'is-warning';
                break;
            case 4:
                return 'is-danger';
                break;
            case 5:
                return 'is-info';
                break;
            case 6:
                return 'is-primary';
                break;
            case 7:
                return 'is-success';
                break;
            case 8:
                return 'is-warning';
                break;
            case 9:
                return 'is-danger';
                break;
        }
    }
}
