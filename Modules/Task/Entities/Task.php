<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Task extends Model
{
    const FINISHED = 'finished';

    const OPEN = 'open';

    /**
     * @var array
     */
    protected $fillable = [
        'project_id', 'module_id', 'user_id', 'title', 'level_id',
        'description', 'assign_id', 'due_date', 'status', 'finish_id', 'finish_datetime'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo('Modules\Module\Entities\Module');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo('Modules\Core\Entities\Level');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignUser()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'assign_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function finishUser()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'finish_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Modules\Tag\Entities\Tag', 'task_tag', 'task_id', 'tag_id');
    }
}
