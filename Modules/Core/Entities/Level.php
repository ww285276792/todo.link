<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Level
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Level extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'sort'
    ];
}
