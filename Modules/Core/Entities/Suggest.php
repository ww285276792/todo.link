<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

/**
 * Class Suggest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Suggest extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
