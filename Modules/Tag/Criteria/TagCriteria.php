<?php

namespace Modules\Tag\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TagCriteria
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TagCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * TagCriteria constructor.
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
        if ($this->request->get('name')) {
            $model = $model->where('name', 'like', '%' . $this->request->get('name') . '%');
        }

        return $model;
    }
}
