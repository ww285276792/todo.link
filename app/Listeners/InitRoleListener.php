<?php

namespace App\Listeners;

use App\Events\InitRoleEvent;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Role;
use Modules\User\Entities\User;

/**
 * Class InitRoleListener
 *
 * @author  luffy007  <285276792@qq.com>
 */
class InitRoleListener
{
    /**
     * @param InitRoleEvent $initRoleEvent
     */
    public function handle(InitRoleEvent $initRoleEvent)
    {
        $projectId = $initRoleEvent->projectId;
        /**
         * @var User $user
         */
        $user = $initRoleEvent->user;

        $data = [
            [
                'role' => [
                    'project_id' => $projectId,
                    'name' => 'manager' . $projectId,
                    'description' => '管理员',
                    'guard_name' => 'web',
                ],
                'permissions' => [
                    [
                        'project_id' => $projectId,
                        'name' => 'show_dashboard' . $projectId,
                        'group_name' => '控制台',
                        'description' => '查看控制台',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '查看任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '创建任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '编辑任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '删除任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'set_status_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '完成任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_logs' . $projectId,
                        'group_name' => '动态',
                        'description' => '查看动态',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_progress' . $projectId,
                        'group_name' => '进度',
                        'description' => '查看进度',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '查看成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '编辑成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '移除成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'invite_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '邀请成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_settings' . $projectId,
                        'group_name' => '设置',
                        'description' => '编辑项目信息',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '查看模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '创建模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '编辑模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '删除模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '查看标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '创建标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '编辑标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '删除标签',
                        'guard_name' => 'web',
                    ],
                ]
            ],
            [
                'role' => [
                    'project_id' => $projectId,
                    'name' => 'member' . $projectId,
                    'description' => '成员',
                    'guard_name' => 'web',
                ],
                'permissions' => [
                    [
                        'project_id' => $projectId,
                        'name' => 'show_dashboard' . $projectId,
                        'group_name' => '控制台',
                        'description' => '控制台',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '查看任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '创建任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '编辑任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '删除任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'set_status_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '完成任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_logs' . $projectId,
                        'group_name' => '动态',
                        'description' => '查看动态',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_progress' . $projectId,
                        'group_name' => '进度',
                        'description' => '查看进度',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '查看成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'invite_members' . $projectId,
                        'group_name' => '成员',
                        'description' => '邀请成员',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '查看模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '创建模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '编辑模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_modules' . $projectId,
                        'group_name' => '模块',
                        'description' => '删除模块',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '查看标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '创建标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '编辑标签',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_tags' . $projectId,
                        'group_name' => '标签',
                        'description' => '删除标签',
                        'guard_name' => 'web',
                    ],
                ]
            ],
            [
                'role' => [
                    'project_id' => $projectId,
                    'name' => 'visitor' . $projectId,
                    'description' => '访客',
                    'guard_name' => 'web',
                ],
                'permissions' => [
                    [
                        'project_id' => $projectId,
                        'name' => 'show_dashboard' . $projectId,
                        'group_name' => '控制台',
                        'description' => '控制台',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '查看任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'create_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '创建任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'update_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '编辑任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'delete_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '删除任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'set_status_tasks' . $projectId,
                        'group_name' => '任务',
                        'description' => '完成任务',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_logs' . $projectId,
                        'group_name' => '动态',
                        'description' => '查看动态',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_progress' . $projectId,
                        'group_name' => '进度',
                        'description' => '查看进度',
                        'guard_name' => 'web',
                    ],
                    [
                        'project_id' => $projectId,
                        'name' => 'list_member' . $projectId,
                        'group_name' => '成员',
                        'description' => '查看成员',
                        'guard_name' => 'web',
                    ],
                ]
            ],
        ];

        foreach ($data as $item) {
            $role = Role::create($item['role']);
            foreach ($item['permissions'] as $permission) {
                $re = Permission::where('project_id', $projectId)
                    ->where('name', $permission['name'])
                    ->get()
                    ->first();

                if (is_null($re)) {
                    $perm = Permission::create($permission);
                } else {
                    $perm = $re;
                }

                $role->givePermissionTo($perm);
            }

            if ($item['role']['name'] == 'manager' . $projectId) {
                $user->assignRole($role->id);
            }
        }
    }
}
