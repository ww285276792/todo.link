<?php

namespace Modules\Module\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Module extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'project_id', 'name', 'sort'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('Modules\Task\Entities\Task');
    }
}
