<?php

namespace App\Listeners;

use App\Events\LogEvent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogListener
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LogListener
{
    /**
     * @param LogEvent $logEvent
     */
    public function handle(LogEvent $logEvent)
    {
        /**
         * @var Model $model
         */
        $model = $logEvent->model;
        $description = $logEvent->description;
        $field = $logEvent->field;

        $projectUuid = request()->route('uuid') ? request()->route('uuid') : $model->uuid;

        activity('project_' . $projectUuid)
            ->performedOn($model)
            ->log(':causer.name ' . $description . '：' . ':subject.' . $field);
    }
}
