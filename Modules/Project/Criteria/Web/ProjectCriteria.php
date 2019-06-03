<?php

namespace Modules\Project\Criteria\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProjectCriteria
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectCriteria implements CriteriaInterface
{
    protected $request;

    /**
     * ProjectCriteria constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  Model $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->whereHas('users', function ($query) {
            /**
             * @var Builder $query
             */
            $query->where('id', '=', request()->user('web')->id);
        });

        if ($this->request->get('name') != null) {
            $model = $model->where('name', 'like', '%' . $this->request->get('name') . '%');
        }

        return $model;
    }
}
