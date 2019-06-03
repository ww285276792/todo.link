<?php

namespace Modules\Admin\Http\Controllers;

use App\Repositories\Eloquent\ArticleRepositoryEloquent;
use App\Repositories\Eloquent\ChangelogRepositoryEloquent;
use App\Repositories\Eloquent\CommentRepositoryEloquent;
use App\Repositories\Eloquent\MessageRepositoryEloquent;
use Illuminate\Http\Request;
use Modules\User\Repositories\Eloquent\UserRepositoryEloquent;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends BaseController
{
    /**
     * @var UserRepositoryEloquent
     */
    protected $userRepositoryEloquent;

    /**
     * @var ArticleRepositoryEloquent
     */
    protected $articleRepositoryEloquent;

    /**
     * @var CommentRepositoryEloquent
     */
    protected $commentRepositoryEloquent;

    /**
     * @var MessageRepositoryEloquent
     */
    protected $messageRepositoryEloquent;

    /**
     * @var ChangelogRepositoryEloquent
     */
    protected $changelogRepositoryEloquent;

    /**
     * DashboardController constructor.
     * @param UserRepositoryEloquent $userRepositoryEloquent
     * @param ArticleRepositoryEloquent $articleRepositoryEloquent
     * @param CommentRepositoryEloquent $commentRepositoryEloquent
     * @param MessageRepositoryEloquent $messageRepositoryEloquent
     * @param ChangelogRepositoryEloquent $changelogRepositoryEloquent
     */
    public function __construct(
        UserRepositoryEloquent $userRepositoryEloquent,
        ArticleRepositoryEloquent $articleRepositoryEloquent,
        CommentRepositoryEloquent $commentRepositoryEloquent,
        MessageRepositoryEloquent $messageRepositoryEloquent,
        ChangelogRepositoryEloquent $changelogRepositoryEloquent
    )
    {
        parent::__construct();

        $this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->articleRepositoryEloquent = $articleRepositoryEloquent;
        $this->commentRepositoryEloquent = $commentRepositoryEloquent;
        $this->messageRepositoryEloquent = $messageRepositoryEloquent;
        $this->changelogRepositoryEloquent = $changelogRepositoryEloquent;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $users = $this->userRepositoryEloquent->getLatestUsers(5);
//        $articles = $this->articleRepositoryEloquent->getLatestArticles(5);
//        $messages = $this->messageRepositoryEloquent->getLatestMessages(3);
//        $changelogs = $this->changelogRepositoryEloquent->getLatestChangelogs(5);

        return view('admin::dashboard.index', compact(
            'users', 'articles', 'messages', 'changelogs'
        ));
    }
}
