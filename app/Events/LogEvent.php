<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class LogEvent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    public $description;

    public $field;

    /**
     * LogEvent constructor.
     *
     * @param $model
     * @param $description
     * @param $field
     */
    public function __construct($model, $description, $field)
    {
        $this->model = $model;
        $this->description = $description;
        $this->field = $field;
    }
}
