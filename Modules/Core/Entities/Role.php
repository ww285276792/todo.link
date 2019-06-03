<?php

namespace Modules\Core\Entities;

use Spatie\Permission\Guard;

/**
 * Class Role
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        'name', 'description', 'guard_name', 'project_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Modules\Project\Entities\Project');
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        if (isNotLumen() && app()::VERSION < '5.4') {
            return parent::create($attributes);
        }

        return static::query()->create($attributes);
    }
}
