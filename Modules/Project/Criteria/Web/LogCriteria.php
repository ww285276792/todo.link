<?php

namespace Modules\Project\Criteria\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Project\Entities\Project;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class LogCriteria
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LogCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Project
     */
    protected $uuid;

    /**
     * LogCriteria constructor.
     * @param Request $request
     *
     * @param $uuid
     */
    public function __construct(Request $request, $uuid)
    {
        $this->request = $request;
        $this->uuid = $uuid;
    }

    /**
     * @param  Model $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!is_null($this->request->get('assign_id'))) {
            $model = $model->where('causer_id', $this->request->get('assign_id'));
        }

        $model = $model->where('log_name', 'project_' . $this->uuid);

        return $model;
    }
}
