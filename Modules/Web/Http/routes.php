<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Web\Http\Controllers'], function () {
    Route::get('/', 'HomeController@index')->name('home');
//    login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::any('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
//    reset_pwd
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//    github
    Route::get('auth/github', 'Auth\AuthController@redirectToProvider')->name('auth.github');
    Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
//    project
    Route::resource('project', 'Project\ProjectController')->except(['show']);
    Route::group(['middleware' => ['auth.web', 'auth.project'], 'prefix' => 'project/{uuid}'], function () {
//        dashboard
        Route::get('dashboard', 'Project\DashboardController@index')->name('project_dashboard.index');
//        task
        Route::resource('task', 'Task\TaskController')->except(['show']);
        Route::get('task/set/{id}/{status}', 'Task\TaskController@setStatus')->name('task.set_status');
//        setting
        Route::get('setting', 'Project\SettingController@edit')->name('setting.edit');
        Route::post('setting/{project}', 'Project\SettingController@update')->name('setting.update');
        Route::delete('setting/{project}', 'Project\SettingController@destroy')->name('setting.destroy');
//        module
        Route::resource('setting_module', 'Setting\ModuleController')->except(['show']);
//        tag
        Route::resource('setting_tag', 'Setting\TagController')->except(['show']);
//        member
        Route::get('member', 'Project\MemberController@index')->name('member.index');
        Route::delete('member/{member}', 'Project\MemberController@destroy')->name('member.destroy');
        Route::get('member/invite', 'Project\MemberController@invite')->name('member.invite');
        Route::post('member/invite/fresh', 'Project\MemberController@fresh')->name('member.invite_fresh');
        Route::get('member/role/{member}/edit', 'Project\MemberController@editMemberRole')->name('member.role_edit');
        Route::put('member/role/{member}', 'Project\MemberController@updateMemberRole')->name('member.role_update');
//        log
        Route::get('log', 'Project\LogController@index')->name('project_log.index');
//        progress
        Route::get('progress', 'Project\ProgressController@index')->name('project_progress.index');
//        editor_uplaod_image
        Route::post('upload_image', 'Project\ImageController@uploadImage')->name('project.upload_image');
//        editor_load_image
        Route::get('image/{id}', 'Project\ImageController@showImage')->name('project.show_image');
    });
    Route::group(['prefix' => 'user'], function () {
//        reset_pwd
        Route::get('password/reset', 'User\ResetPasswordController@showResetForm')->name('user_password.reset');
        Route::post('password/reset', 'User\ResetPasswordController@reset')->name('user_password.reset');
//        user_info
        Route::get('setting', 'User\SettingController@edit')->name('user_setting.edit');
        Route::post('setting', 'User\SettingController@update')->name('user_setting.update');
//        join_project
        Route::get('join/{uuid}/{token}', 'User\JoinController@showJoinForm')->name('user.join_form');
        Route::post('join/{uuid}/{token}', 'User\JoinController@join')->name('user.join');
//        suggest
        Route::post('suggest', 'User\SuggestController@store')->name('user_suggest.store');
    });
});
