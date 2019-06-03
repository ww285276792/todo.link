<?php

namespace Modules\Core\Entities;

use Spatie\Permission\Guard;

/**
 * Class Permission
 *
 * @author  luffy007  <285276792@qq.com>
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    protected $fillable = [
        'name', 'group_name', 'description', 'guard_name', 'project_id'
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

        $permission = static::getPermissions(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])->first();

        if (isNotLumen() && app()::VERSION < '5.4') {
            return parent::create($attributes);
        }

        return static::query()->create($attributes);
    }
}
