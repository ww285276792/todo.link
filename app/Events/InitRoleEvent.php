<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class InitRoleEvent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class InitRoleEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $projectId;

    public $user;

    /**
     * InitRoleEvent constructor.
     *
     * @param $projectId
     * @param $user
     */
    public function __construct($projectId, $user)
    {
        $this->projectId = $projectId;
        $this->user = $user;
    }
}
