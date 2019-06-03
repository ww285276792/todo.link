<?php

namespace Modules\User\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Modules\Project\Entities\Project;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MemberCriteria
 *
 * @author  luffy007  <285276792@qq.com>
 */
class MemberCriteria implements CriteriaInterface
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
     * UserCriteria constructor.
     *
     * @param Request $request
     * @param $project
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
        $model = $model->whereHas('projects', function ($query) {
            /**
             * @var Builder $query
             */
            $model = $query->where('id', $this->project->id);
        });

        $search = $this->request->get('search');

        if ($search['name'] != null) {
            $model = $model->where('name', 'like', '%' . $search['name'] . '%');
        }

        if ($search['email'] != null) {
            $model = $model->where('email', 'like', '%' . $search['email'] . '%');
        }

        return $model;
    }
}
