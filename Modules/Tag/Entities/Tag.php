<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Tag extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('Modules\Task\Entities\Task', 'task_tag', 'tag_id', 'task_id');
    }
}
