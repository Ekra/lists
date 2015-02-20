<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/19/15
 * Time: 4:21 PM
 */

namespace Suitcase\Domain\Models;
use Jenssegers\Mongodb\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Listing extends Eloquent{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'listings';

    protected $fillable = ['name'];


    public static $rules = [
        'name' => 'required'

    ];

} 