<?php

namespace Modules\Task\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Modules\Project\Entities\Project;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TaskCriteria
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TaskCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Project
     */
    protected $project;

    /**
     * TaskCriteria constructor.
     *
     * @param Request $request
     * @param Project $project
     */
    public function __construct(Request $request, $project)
    {
        $this->request = $request;
        $this->project = $project;
    }

    /**
     * @param  Model $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!is_null($this->request->get('title'))) {
            $model = $model->where('title', 'like', '%' . $this->request->get('title') . '%');
        }

        if (!is_null($this->request->get('module_id'))) {
            $model = $model->where('module_id', $this->request->get('module_id'));
        }

        if (!is_null($this->request->get('level_id'))) {
            $model = $model->where('level_id', $this->request->get('level_id'));
        }

        if (!is_null($this->request->get('assign_id'))) {
            $model = $model->where('assign_id', $this->request->get('assign_id'));
        }

        if (!is_null($this->request->get('tags'))) {
            $model = $model->whereHas('tags', function ($query) {
                /**
                 * @var Builder $query
                 */
                $model = $query->whereIn('id', explode(',', $this->request->get('tags')));
            });
        }

        if (!is_null($this->request->get('due_date'))) {
            $model = $model->where('due_date', $this->request->get('due_date'));
        }

        if (!is_null($this->request->get('status'))) {
            if ($this->request->get('status') == 'postponed') {
                $model = $model->where('status', 'open')->where('due_date', '<', date('Y-m-d'));
            } else {
                $model = $model->where('status', $this->request->get('status'));
            }
        }

        $sorting = $this->request->get('sorting');

        if ($sorting['name'] != null) {
            $model = $model->orderBy($sorting['name'], $sorting['desc']);
        } else {
            $model = $model->orderBy('status', 'desc')->orderBy('created_at', 'desc');
        }

        $model = $model->where('project_id', $this->project->id);

        return $model;
    }
}
