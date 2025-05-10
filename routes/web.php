<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseAdvController;
use App\Http\Controllers\Admin\CourseAdvReviewsController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\NotificationController;
//
use App\Http\Controllers\Institute\AdInstituteController;
use App\Http\Controllers\Institute\CategoryInstituteController;

use App\Http\Controllers\Institute\InstituteMainController;
use App\Http\Controllers\Institute\CourseAdvInstituteController;
use App\Http\Controllers\Institute\CourseAdvReviewsInstituteController;
use App\Http\Controllers\MasterAdController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterCourseAdvController;
use App\Http\Controllers\MasterCommentsController;

use App\Http\Controllers\MasterInstructorController;

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

            Route::get('/course/create_course_adv', 'index')->name('admin.create_course_adv');
            Route::get('/course/manage_course_adv', 'manage_course_adv')->name('admin.manage_course_adv');

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
            Route::post('/store/course', 'store_course_adv')->name('store.course');
            Route::get('/course/{id}', 'show_course_adv')->name('show.course');
            Route::put('/course/update/{id}', 'course_name')->name('update.course');
            Route::delete('/course/delete/{id}', 'delete_course_adv')->name('delete.course');


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


        Route::controller(InstituteMainController::class)->group(function () {


            Route::get('/institute_settings', 'institute_settings')->name('institute_settings');
            Route::get('/institute_profile', 'institute_profile')->name('institute_profile');



        });

        Route::controller(CategoryInstituteController::class)->group(function () {

            Route::get('/category/manage_category', 'index')->name('institute.manage_category');
            Route::get('/category/update_category/{id}', 'edit_category')->name('institute.edit_category');
            // Route::get('/category/update_category' , 'update_category')->name('institute.category_update');
            // Route::get('/category/manage' , 'manage')->name('institute.manage_category');

        });
        //
        Route::controller(CourseAdvInstituteController::class)->group(function () {

            Route::get('institute_profile/course/manage_courses', 'manage_course')->name('institute.manage_course');

            //   Route::get('/course/manage' , 'manage')->name('institute.manage_course_adv');

        });
        //
        //
        Route::controller(AdInstituteController::class)->group(function () {

            Route::get('institute_profile/ad/manage_ads', 'manage_ad')->name('institute.manage_ad');

            //   Route::get('/course/manage' , 'manage')->name('institute.manage_course_adv');

        });
        //

        // Route::controller(CourseAdvReviewsInstituteController::class)->group(function () {

        //     //   Route::get('/course_adv_review/create_course_adv_review' , 'index')->name('institute.create_course_adv_review');
        //     //   Route::get('/course_adv_review/manage' , 'manage')->name('institute.course_adv_review.manage');

        // });



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
            Route::post('/store/course', 'store_course_adv')->name('institute.store.course');
            Route::get('/course/{id}', 'show_course_adv')->name('institute.show.course');
            Route::put('/course/update/{id}', 'course_name')->name('institute.update.course');
            Route::delete('/course/delete/{id}', 'delete_course_adv')->name('institute.delete.course');

            Route::get('/course/edit_course_adv/{id}', 'edit_course_adv')->name('institute.edit_course_adv');
            Route::put('/course/course_name/{id}', 'course_name')->name('institute.course_name');

            Route::get('/institute/course/get/{id}', 'get_edit_course_adv')->name('institute.get.course');

        });



        Route::controller(MasterAdController::class)->group(function () {
            Route::post('/store/ad', 'store_ad')->name('institute.store_ad');
            // Route::get('/course/{id}', 'show_course_adv')->name('institute.show.course');
            // Route::put('/course/update/{id}', 'course_name')->name('institute.update.course');
            Route::delete('/ad/delete/{id}', 'delete_ad')->name('institute.delete_ad');

            // Route::get('/course/edit_course_adv/{id}', 'edit_course_adv')->name('institute.edit_course_adv');
            // Route::put('/course/course_name/{id}', 'course_name')->name('institute.course_name');

            // Route::get('/institute/course/get/{id}', 'get_edit_course_adv')->name('institute.get.course');

        });

        //  institute.comments_store
        Route::controller(MasterCommentsController::class)->group(function () {
            Route::post('/comments', 'store_comment')->name('institute.comments_store');


            // Route::post('/store/category', 'store_cat')->name('institute.category.store');

            // Route::get('/category/{id}' , 'show_cat')->name('institute.category.show');
            // Route::put('/category/update/{id}' , 'update_cat')->name('institute.category.update');
            // Route::delete('/category/delete/{id}' , 'delete_cat')->name('institute.category.delete');

        });
        //  institute.Instructors_store
        Route::controller(MasterInstructorController::class)->group(function () {
            Route::post('/instructor', 'store_instructor')->name('institute.instructors_store');


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
            Route::get('/user_settings', 'user_settings')->name('user_settings');
            // Route::get('/user_course_adv_marked', 'user_course_adv_marked')->name('user_course_adv_marked');
            Route::get('/user_following', 'user_following')->name('user_following');


            // Route::get('/user_dashboard', 'user_dashboard')->name('user_dashboard');
            // Route::get('/user_history', 'user_history')->name('user_history');

            Route::get('/user_search', 'user_search')->name('user_search');

            //

            //
            Route::get('/user_ins_profile/{id}', 'user_ins_profile')->name('user.user_ins_profile');
            Route::get('/user_all_ins', 'user_all_ins')->name('user.all_ins');

            Route::post('/follow/institute/{id}',  'follow')->name('user.follow_institute');

//


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

        //       Route::get('/course/create_course_adv' , 'index')->name('create_course_adv');
//       Route::get('/course/manage' , 'manage')->name('manage_course_adv');

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
