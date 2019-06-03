<?php

namespace Modules\Web\Http\Controllers\Project;

use App\Events\LogEvent;
use Modules\Project\Entities\ProjectLink;
use Modules\Project\Repositories\Eloquent\ProjectLinkRepositoryEloquent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Requests\DeleteMemberRequest;
use Modules\Project\Requests\GetAllMemberRequest;
use Modules\Project\Requests\InviteMemberRequest;
use Modules\Project\Requests\UpdateMemberRequest;
use Modules\Project\Traits\Project;
use Modules\User\Repositories\Eloquent\UserRepositoryEloquent;
use Modules\Web\Http\Controllers\BaseController;
use Webpatser\Uuid\Uuid;

/**
 * Class MemberController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class MemberController extends BaseController
{
    use Project;

    /**
     * @var UserRepositoryEloquent
     */
    protected $userRepositoryEloquent;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var ProjectLinkRepositoryEloquent
     */
    protected $projectLinkRepositoryEloquent;

    /**
     * MemberController constructor.
     *
     * @param UserRepositoryEloquent $userRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param ProjectLinkRepositoryEloquent $projectLinkRepositoryEloquent
     */
    public function __construct(
        UserRepositoryEloquent $userRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        ProjectLinkRepositoryEloquent $projectLinkRepositoryEloquent
    )
    {
        parent::__construct();

        $this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->projectLinkRepositoryEloquent = $projectLinkRepositoryEloquent;
    }

    /**
     * @param GetAllMemberRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllMemberRequest $request)
    {
        $project = $this->getProject($request);
        $data = $this->userRepositoryEloquent->getPaginateUsersByProject($project);

        return view('web::member.index', compact('data'));
    }

    /**
     * @param DeleteMemberRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteMemberRequest $request, $uuid, $id)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $project->users()->detach([$id]);
        $user = $this->userRepositoryEloquent->find($id);

        event(new LogEvent($user, trans('user.log_desc.destroy'), 'name'));

        return redirect(route('member.index', ['uuid' => $uuid]))->with('success', trans('common.message.delete_success'));
    }

    /**
     * @param InviteMemberRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite(InviteMemberRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);

        /**
         * @var ProjectLink $invite
         */
        $invite = $project->inviteLink;

        if ($invite) {
            $token = $invite->token;
        } else {
            $token = Uuid::generate()->string;

            $this->projectLinkRepositoryEloquent->create([
                'project_id' => $project->id,
                'token' => $token,
            ]);
        }

        return view('web::member.invite', compact('token'));
    }

    /**
     * @param InviteMemberRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fresh(InviteMemberRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);

        /**
         * @var ProjectLink $invite
         */
        $invite = $project->inviteLink;
        $token = Uuid::generate()->string;

        $invite->token = $token;
        $invite->save();

        return redirect(route('member.invite', ['uuid' => $uuid]))->with('success', trans('task.message.action_success'));
    }

    /**
     * @param UpdateMemberRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editMemberRole(UpdateMemberRequest $request, $uuid, $id)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $user = $this->userRepositoryEloquent->getUserByProjectAndId($project, $id);
        $roles = $project->roles;

        return view('web::member.edit', compact('user', 'roles'));
    }

    /**
     * @param UpdateMemberRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMemberRole(UpdateMemberRequest $request, $uuid, $id)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $user = $project->users()->where('id', $id)->first();
        $lastRole = $user->roles()->where('project_id', $project->id)->first();
        $newRole = $project->roles()->where('name', $request->role)->first();

        $user->roles()->syncWithoutDetaching([
            $lastRole->id => [
                'role_id' => $newRole->id
            ]
        ]);

        return redirect(route('member.index', ['uuid' => $uuid]))->with('success', trans('task.message.action_success'));
    }
}
