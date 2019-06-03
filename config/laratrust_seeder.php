<?php

return [
//    后端
    'backend' => [
        'permissions' => [
//            控制台
            'admin.dash',
//            文章管理
            'admin_article.index',
            'admin_article.create',
            'admin_article.store',
            'admin_article.destroy',
            'admin_article.update',
            'admin_article.edit',
        ]
    ],
//    前端
    'web' => [
        'permissions' => [
            'home'
        ]
    ]
];
