<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseAdvController;
use App\Http\Controllers\Admin\CourseAdvReviewsController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\NotificationController;
//
use App\Http\Controllers\Institute\CategoryInstituteController;

use App\Http\Controllers\Institute\InstituteMainController;
use App\Http\Controllers\Institute\CourseAdvInstituteController;
use App\Http\Controllers\Institute\CourseAdvReviewsInstituteController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterCourseAdvController;
use App\Http\Controllers\MasterCommentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserMainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Constants\UserRole;

use App\Http\Controllers\RootRedirectController;






Route::get('/', RootRedirectController::class)->name('root');
// guest
//  user routing
// Route::get('/user', function () {
//     return view('user_dashboard');
// })->middleware(['auth', 'verified','rolemanager:user'])->name('dashboard');
// //

// admin routing
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {



        //

        Route::controller(AdminMainController::class)->group(function () {

            Route::get('/admin_dashboard', 'index')->name('admin');
            Route::get('/settings', 'settings')->name('admin_settings');

            Route::get('/manage/manage_students', 'manage_students')->name('admin_manage_students');
            Route::get('/manage/manage_institutes', 'manage_institutes')->name('admin_manage_institutes');
            Route::get('/manage/manage_notifications', 'manage_notifications')->name('admin_manage_notifications');
        });



        //
        Route::controller(CategoryController::class)->group(function () {

            Route::get('/category/manage_category', 'manage_category')->name('admin.manage_category');
            Route::get('/category/manage', 'manage')->name('manage_category');

        });
        //
        Route::controller(CourseAdvController::class)->group(function () {

            Route::get('/course_adv/create_course_adv', 'index')->name('admin.create_course_adv');
            Route::get('/course_adv/manage_course_adv', 'manage_course_adv')->name('admin.manage_course_adv');

        });
        //

        Route::controller(CourseAdvReviewsController::class)->group(function () {

            Route::get('/course_adv_review/create_course_adv_review', 'index')->name('create_course_adv_review');
            Route::get('/course_adv_review/manage', 'manage')->name('course_adv_review.manage');

        });

        //
        Route::controller(InstituteController::class)->group(function () {

            // Route::get('/institute/manage_institute' , 'manage_institute')->name('manage_institute');
            Route::get('/institute/verify_institute', 'verify_institute')->name('verify_institute');
            Route::get('/institute/add_institute', 'add_institute')->name('add_institute');

        });
        //
        Route::controller(NotificationController::class)->group(function () {

            Route::get('/notification/create_notification', 'create_notification')->name('create_notification');
            //  Route::get('/notification/verify_institute' , 'verify_institute')->name('institute.verify');

        });


        //
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::post('/store/category', 'store_cat')->name('category.store');
            Route::get('/category/{id}', 'show_cat')->name('category.show');
            Route::put('/category/update/{id}', 'update_cat')->name('category.update');
            Route::delete('/category/delete/{id}', 'delete_cat')->name('category.delete');

        });

        //
        //
        Route::controller(MasterCourseAdvController::class)->group(function () {
            Route::post('/store/course_adv', 'store_course_adv')->name('store.course_adv');
            Route::get('/course_adv/{id}', 'show_course_adv')->name('show.course_adv');
            Route::put('/course_adv/update/{id}', 'update_course_adv')->name('update.course_adv');
            Route::delete('/course_adv/delete/{id}', 'delete_course_adv')->name('delete.course_adv');


        });

        //

    });
});




//
// Route::get('/admin/dashboard', function () {
//     return view('admin.admin');
// })->middleware(['auth', 'verified' ,'rolemanager:admin'])->name('admin');
//

// institute routing


Route::middleware(['auth', 'verified', 'rolemanager:institute'])->group(function () {
    Route::prefix('institute')->group(function () {

        // Route::redirect('/profile', '/', 200)->name('profile');

        // Route::get('/institute', [InstituteMainController::class, 'ins_welcome'])->name('institute_welcome');
        Route::controller(InstituteMainController::class)->group(function () {
            // Route::get( '/',  'institute_profile')->name('institute_profile');


            Route::get('/home', 'institute_profile')->name('institute_profile');
            // Route::get( '/',  'institute_profile')->name('institute_profile');


            //   Route::get('/' , 'ins_welcome')->name('institute_welcome');

            Route::get('/institute_settings', 'institute_settings')->name('institute_settings');
            Route::get('/institute_profile', 'institute_profile')->name('institute_profile');
            // Route::get('/institute_profile', 'institute_profile')->name('institute_profile');

            //
            // Route::get('/institute_search', 'institute_search')->name('institute_search');

            // Route::get('/institute/course_adv/get/{id}', [InstituteMainController::class, 'get_course_adv'])->name('institute.get.course_adv');



        });

        Route::controller(CategoryInstituteController::class)->group(function () {

            Route::get('/category/manage_category', 'index')->name('institute.manage_category');
            Route::get('/category/update_category/{id}', 'edit_category')->name('institute.edit_category');
            // Route::get('/category/update_category' , 'update_category')->name('institute.category_update');
            // Route::get('/category/manage' , 'manage')->name('institute.manage_category');

        });
        //
        Route::controller(CourseAdvInstituteController::class)->group(function () {

            Route::get('/course_adv/manage_course_adv', 'manage_course_adv')->name('institute.manage_course_adv');

            //   Route::get('/course_adv/manage' , 'manage')->name('institute.manage_course_adv');

        });
        //

        Route::controller(CourseAdvReviewsInstituteController::class)->group(function () {

            //   Route::get('/course_adv_review/create_course_adv_review' , 'index')->name('institute.create_course_adv_review');
            //   Route::get('/course_adv_review/manage' , 'manage')->name('institute.course_adv_review.manage');

        });



        // //
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::post('/store/category', 'store_cat')->name('institute.category.store');
            Route::get('/category/{id}', 'show_cat')->name('institute.category.show');
            Route::put('/category/update/{id}', 'update_cat')->name('institute.category.update');
            Route::delete('/category/delete/{id}', 'delete_cat')->name('institute.category.delete');

        });

        //
//
        Route::controller(MasterCourseAdvController::class)->group(function () {
            Route::post('/store/course_adv', 'store_course_adv')->name('institute.store.course_adv');
            Route::get('/course_adv/{id}', 'show_course_adv')->name('institute.show.course_adv');
            Route::put('/course_adv/update/{id}', 'update_course_adv')->name('institute.update.course_adv');
            Route::delete('/course_adv/delete/{id}', 'delete_course_adv')->name('institute.delete.course_adv');

            Route::get('/course_adv/edit_course_adv/{id}', 'edit_course_adv')->name('institute.edit_course_adv');
            Route::put('/course_adv/update_course_adv/{id}', 'update_course_adv')->name('institute.update_course_adv');

            Route::get('/institute/course_adv/get/{id}', 'get_edit_course_adv')->name('institute.get.course_adv');

        });

        //  institute.comments_store
        Route::controller(MasterCommentsController::class)->group(function () {
            Route::post('/comments', 'store_comment')->name('institute.comments_store');


            // Route::post('/store/category', 'store_cat')->name('institute.category.store');

            // Route::get('/category/{id}' , 'show_cat')->name('institute.category.show');
            // Route::put('/category/update/{id}' , 'update_cat')->name('institute.category.update');
            // Route::delete('/category/delete/{id}' , 'delete_cat')->name('institute.category.delete');

        });

        //

        //
    });
});


// // // // //

// user routing


Route::middleware(['auth', 'verified', 'rolemanager:user'])->group(function () {


    Route::prefix('user')->group(function () {


        // Route::get('/home', [Controller::class, 'redirectToHome'])->name('redirectToHome')->middleware('auth');

        //         Route::controller(Controller::class)->group(function () {

        //         });
// //
        Route::controller(UserMainController::class)->group(function () {

            // Route::get('/' , 'index')->name('user.welcome');
            // Route::get('/user' , 'user_welcome')->name('user');
            Route::get('/home', 'user_home')->name('user_home');
            // Route::get('/' , 'user_home')->name('user_home');


            Route::get('/user_profile', 'user_profile')->name('user_profile');
            Route::get('/user_ins_profile', 'user_ins_profile')->name('user.ins_profile');
            Route::get('/user_settings', 'user_settings')->name('user_settings');
            // Route::get('/user_course_adv_marked', 'user_course_adv_marked')->name('user_course_adv_marked');
            Route::get('/user_following', 'user_following')->name('user_following');


            // Route::get('/user_dashboard', 'user_dashboard')->name('user_dashboard');
            // Route::get('/user_history', 'user_history')->name('user_history');

            Route::get('/user_search', 'user_search')->name('user_search');

        });

           Route::controller(MasterCommentsController::class)->group(function () {
            Route::post('/comments', 'store_comment')->name('user.comments_store');




        });
        //     Route::controller(CategoryInstituteController::class)->group(function () {

        //         Route::get('/category/manage_category' , 'index')->name('manage_category');
//         Route::get('/category/manage' , 'manage')->name('manage_category');

        //    });
// //
//    Route::controller(CourseAdvInstituteController::class)->group(function () {

        //       Route::get('/course_adv/create_course_adv' , 'index')->name('create_course_adv');
//       Route::get('/course_adv/manage' , 'manage')->name('manage_course_adv');

        //   });
// //

        //   Route::controller(CourseAdvReviewsInstituteController::class)->group(function () {

        //       Route::get('/course_adv_review/create_course_adv_review' , 'index')->name('create_course_adv_review');
//       Route::get('/course_adv_review/manage' , 'manage')->name('course_adv_review.manage');

        //   });




        //
    });
});


// // // // //

// Route::get('/profile', function () {
//     return redirect('/home'); // أو أي صفحة تريدها بدلاً من البروفايل
// })->name('profile')->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
