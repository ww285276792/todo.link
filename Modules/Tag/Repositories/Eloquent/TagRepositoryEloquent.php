<?php

namespace Modules\Tag\Repositories\Eloquent;

use Modules\Core\Exceptions\NotFoundException;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Repositories\Contracts\TagRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TagRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getTagsByProject($project)
    {
        return $this
            ->orderBy('sort', 'asc')
            ->orderBy('created_at', 'desc')
            ->findWhere([
                'project_id' => $project->id
            ]);
    }

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getTagByProjectAndId($project, $id)
    {
        $module = $this
            ->findByField([
                'id' => $id,
                'project_id' => $project->id,
            ])->first();

        if (is_null($module)) {
            throw new NotFoundException();
        }

        return $module;
    }
}
