<?php

namespace Modules\Project\Repositories\Eloquent;

use Modules\Core\Exceptions\NotFoundException;
use Modules\Project\Entities\Project;
use Modules\Project\Repositories\Contracts\ProjectRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProjectRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $uuid
     *
     * @return mixed
     */
    public function getProjectByUuid($uuid)
    {
        return $this
            ->findByField([
                'uuid' => $uuid
            ])->first();
    }

    /**
     * @param $uuid
     * @param $id
     *
     * @return mixed
     */
    public function getProjectByUuidAndId($uuid, $id)
    {
        $project = $this
            ->findByField([
                'id' => $id,
                'uuid' => $uuid,
            ])->first();

        if (is_null($project)) {
            throw new NotFoundException();
        }

        return $project;
    }

    /**
     * @param $userId
     * @param $uuid
     * @param $id
     *
     * @return mixed
     */
    public function getOwnProjectByUuidAndId($userId, $uuid, $id)
    {
        $project = $this
            ->findByField([
                'id' => $id,
                'uuid' => $uuid,
                'user_id' => $userId,
            ])->first();

        if (is_null($project)) {
            throw new NotFoundException();
        }

        return $project;
    }
}
