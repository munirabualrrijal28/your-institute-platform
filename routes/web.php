<?php

use App\Http\Controllers\Admin\AdminAdvertisementController;
use App\Http\Controllers\Admin\AdmindashController;
use App\Http\Controllers\Admin\AdminInstituteController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseAdvController;
use App\Http\Controllers\Admin\CourseAdvReviewsController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\NotificationController;
//
use App\Http\Controllers\Admin\RatingModerationController;
use App\Http\Controllers\Institute\AdInstituteController;
use App\Http\Controllers\Institute\CategoryInstituteController;

use App\Http\Controllers\Institute\InstituteMainController;
use App\Http\Controllers\Institute\CourseAdvInstituteController;
use App\Http\Controllers\Institute\CourseAdvReviewsInstituteController;
use App\Http\Controllers\Institute\NotificationInstituteController;
use App\Http\Controllers\MasterAdController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterCourseAdvController;
use App\Http\Controllers\MasterCommentsController;

use App\Http\Controllers\MasterInstructorController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\SearchResultsController;
use App\Http\Controllers\User\UserMainController;
use App\Livewire\InstituteTabs\InstituteTabs;
use App\Models\Advertisements;
use App\Models\Courses;
use App\Models\Institute;
use App\Models\Notifications;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Constants\UserRole;

use App\Http\Controllers\RootRedirectController;
use App\Models\User;



Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
Route::get('/debug', function () {
    return [
        'env' => app()->environment(),
        'key_set' => config('app.key') !== null,
        'db' => DB::connection()->getDatabaseName(),
        'pusher_key' => config('broadcasting.connections.pusher.key'),
    ];
});

Route::get('/', RootRedirectController::class)->name('root');
// guest
//  user routing
// Route::get('/user', function () {
//     return view('user_dashboard');
// })->middleware(['auth', 'verified','rolemanager:user'])->name('dashboard');
// //

// admin routing
// Group with 'admin' prefix /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/institutes', [AdminInstituteController::class, 'index'])->name('institutes.listInstitutes');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('logout');

    //

    //
    Route::get('/ratings', [RatingModerationController::class, 'index'])->name('ratings.index');
    Route::patch('/ratings/{rating}/approve', [RatingModerationController::class, 'approve'])->name('ratings.approve');
    Route::delete('/ratings/{rating}/reject', [RatingModerationController::class, 'reject'])->name('ratings.reject');

});

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {


    Route::get('/dashboard', [AdminDashController::class, 'index'])->name('dashboard');


    Route::post('/admin/notifications/{id}/read', [AdminMainController::class, 'markNotificationAsRead'])
        ->name('notifications_read');



    Route::post('/admin/notifications/read', [AdminMainController::class, 'markAllNotificationAsRead'])
        ->name('notificationsAll_read');
    // ////////////////////////////////////////////////////////////////////////////////
    // ✅ Mark one admin notifications as read

    Route::post('/admin/notification/{id}/mark-as-read', function ($id) {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification = Notifications::find($id);
        // dd("testing Notification marking");
        if (
            $notification &&
            $notification->reciver_id == $admin->id &&
            $notification->reciver_type === \App\Models\Admin::class
        ) {
            $notification->read_at = now();
            $notification->save(); // ✅ This must be present!
            return response()->noContent();
        }

        return response()->json(['error' => 'Not Found'], 404);
    })->name('notification_markAsRead');

    // ✅ Mark all admin notifications as read
    Route::post('/admin/notifications/mark-all-as-read', function () {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        Notifications::where('reciver_id', $admin->id)
            ->where('reciver_type', \App\Models\Admin::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->noContent(); // 204
    })->name('notifications_markAllAsRead');


    // ////////////////////////////////////////////////////////////////////////////////

    //
//
//
    Route::get('/verify-institutes', [AdminInstituteController::class, 'showUnverified'])->name('verify.institutes');
    Route::post('/verify-institute/{id}', [AdminInstituteController::class, 'verify'])->name('verify.institute');

    Route::get('/manage-institutes', [AdminInstituteController::class, 'listInstitutes'])->name('manage.institutes');
    // Route::post('/restrict-institute/{id}', [AdminInstituteController::class, 'restrict'])->name('restrict.institute');
    Route::delete('/delete-institute/{id}', [AdminInstituteController::class, 'destroy'])->name('delete.institute');
    Route::delete('/edit-course-institute/{id}', [AdminInstituteController::class, ''])->name('courses.edit');
    Route::post('/admin/institutes/{id}/verify', [AdminInstituteController::class, 'verify'])->name('verify.institute');
    //
    Route::post('/admin/institutes/{id}/restrict', [AdminInstituteController::class, 'restrict_ins'])
        ->name('restrict.institute');


    //
    Route::get('/manage-students', [AdminStudentController::class, 'listStudents'])->name('manage.students');
    Route::delete('/delete-student/{id}', [AdminStudentController::class, 'delete_student'])->name('delete_student');
    //
//
//
//

    // Advertisement Management

    //   vsersion : 1

    // Route::get('/admin/advertisements/{id}/edit', [AdminAdvertisementController::class, 'editAd'])->name('edit.advertisement');
    // Route::put('/admin/advertisements/{id}', [AdminAdvertisementController::class, 'updateAd'])->name('update.advertisement');

    // Route::get('/manage-advertisement', [AdminAdvertisementController::class, 'listAds'])->name('manage.ads');
    // Route::post('/create-advertisement', [AdminAdvertisementController::class, 'store'])->name('store.advertisement');
    // Route::delete('/delete-advertisement/{id}', [AdminAdvertisementController::class, 'deleteAd'])->name('delete.advertisement');

    //
    // new updated code version : 2
    Route::put('/admin/manage-institutes/{institute}/reject', [AdminInstituteController::class, 'rejectLicense'])
        ->name('reject_license');
    // Route::get('/manage-ads', function () {
//     return view('admin.ad.manage_ads');
// })->name('manage.ads');

    Route::get('/manage-advertisements', [AdminAdvertisementController::class, 'index'])->name('manage.ads');
    Route::post('/advertisements', [AdminAdvertisementController::class, 'store'])->name('store.ads');
    Route::delete('/advertisements/{id}', [AdminAdvertisementController::class, 'destroy'])->name('delete.ads');
    Route::get('/advertisements/{id}/edit', [AdminAdvertisementController::class, 'edit'])->name('edit.ads');
    Route::put('/advertisements/{id}', [AdminAdvertisementController::class, 'update'])->name('update.ads');
    // If AdminInstituteController has a deleteAdvertisement for ads, consider if it's redundant.
    // Assuming the one in AdminAdvertisementController is the primary one for admin ads.
    Route::delete('/ads/{id}/delete', [AdminInstituteController::class, 'deleteAdvertisement'])->name('delete.advertisement'); // This route should be removed or renamed if it's for something else
    // Delete advertisement
    // Route::delete('/admin/ads/{id}/delete', [AdminInstituteController::class, 'deleteAdvertisement'])->name('delete.advertisement');

    //////////////////////////////////////////////////////////////////////////////////////////////    //


    // Delete course
    Route::delete('/admin/courses/{id}/delete', [AdminInstituteController::class, 'deleteCourse'])->name('delete.course');

    //// Manage Reports // Manage Reports // Manage Reports // Manage Reports // Manage Reports
    Route::get('/reports', [AdminReportController::class, 'index'])->name('manage.reports');
    Route::post('/reports', [AdminReportController::class, 'store'])->name('reports.store');

    Route::get('/reports/{report}', [AdminReportController::class, 'show'])->name('report.show');
    Route::post('/reports/{report}/notify', [AdminReportController::class, 'notifyReporter'])->name('report.notify');
    Route::delete('/reports/{report}/delete-content', [AdminReportController::class, 'deleteReportedContent'])->name('report.deleteContent');

    // Show the report form for a comment
    Route::get('/report/comment/{comment}', [AdminReportController::class, 'create'])->name('report.comment');

    // Show user report form
    Route::get('/report/{type}/{id}', [AdminReportController::class, 'report'])->name('report.form');


    //
    Route::post('/reports/{report}/resolve', [AdminReportController::class, 'resolve'])->name('report.resolve');
    Route::delete('/users/{user}/delete', [AdminReportController::class, 'deleteUser'])->name('report.deleteUser');



    //
    //
    //
    //

});


// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// routes/web.php
// Route::post('/notifications/mark-read', function () {
//     Notifications::where('reciver_id', Auth::id())
//         ->where('reciver_type', \App\Models\User::class)
//         ->whereNull('read_at')
//         ->update(['read_at' => now()]);

//     return response()->json(['success' => true]);
// })->middleware('auth')->name('notifications.mark-read');

// Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->middleware('auth');

// // ✅ Route for marking ONE notification
// Route::post('/notifications/{id}/mark-as-read', function ($id) {
//     $notification = Notifications::findOrFail($id);
//     if ($notification->reciver_id == Auth::id()) {
//         $notification->update(['read_at' => now()]);
//     }
//     return response()->noContent();
// })->name('notifications.markAsRead');


// Route::post('/notifications/{id}/mark-as-read', function ($id) {
//     $notification = \App\Models\Notifications::find($id);

//     if (
//         $notification &&
//         $notification->reciver_id === Auth::id() &&
//         $notification->reciver_type === \App\Models\User::class
//     ) {
//         $notification->update(['read_at' => now()]);
//     }

//     return response()->noContent();
// })->middleware('auth')->name('notifications.markAsRead');







// ✅ Route for marking ALL notifications
// Route::post('/notifications/mark-all', function () {
//     Notifications::where('reciver_id', Auth::id())
//         ->whereNull('read_at')
//         ->update(['read_at' => now()]);

//     return response()->noContent();
// })->name('notifications.markAllAsRead');
// //
// // ✅ Mark all notifications as read
// Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
//     ->middleware('auth')
//     ->name('notifications.markAllAsRead');

//
//
//

// ✅ Mark ONE notification as read
Route::post('/notifications/{id}/mark-as-read', function ($id) {
    $notification = Notifications::find($id);

    if (
        $notification &&
        $notification->reciver_id === Auth::id() &&
        $notification->reciver_type === \App\Models\User::class
    ) {
        $notification->update(['read_at' => now()]);
    }

    return response()->noContent();
})->middleware('auth')->name('notifications.markAsRead');

// // ✅ Mark ALL notifications as read
Route::post('/notifications/mark-all-as-read', function () {
    Notifications::where('reciver_id', Auth::id())
        ->where('reciver_type', \App\Models\User::class)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    return response()->noContent();
})->middleware('auth')->name('notifications.markAllAsRead');

// Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
//     ->middleware('auth')
//     ->name('notifications.markAllAsRead');

// Route::post('admin/notifications/mark-as-read', function () {
//     $admin = auth()->guard('admin')->user();
//     $admin->notifications()->whereNull('read_at')->update(['read_at' => now()]);
//     return back();
// })->name('admin.notifications.markAsRead');

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


Route::get('/api/search-suggestions', function (Request $request) {
    $query = $request->query('query');

    return response()->json([
        'institutes' => Institute::where('ins_name', 'like', "%{$query}%")->limit(5)->get(['id', 'ins_name']),
        'courses' => Courses::where('course_name', 'like', "%{$query}%")->limit(5)->get(['id', 'course_name']),
        'ads' => Advertisements::where('title', 'like', "%{$query}%")->limit(5)->get(['id', 'title']),
    ]);
});




Route::get('/user/search', function (Request $request) {
    $q = $request->input('query');

    $institutes = Institute::where('ins_name', 'like', "%$q%")->get();
    $courses = Courses::where('course_name', 'like', "%$q%")
        ->orWhere('course_description', 'like', "%$q%")
        ->get();
    $ads = Advertisements::where('title', 'like', "%$q%")
        ->orWhere('content', 'like', "%$q%")
        ->get();

    return view('user.search.results', compact('q', 'institutes', 'courses', 'ads'));
})->name('search.page');


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


            Route::delete('/institute/unfollow/{id}', 'unfollow')
                ->name('institute.unfollow.institute');

            // /////////////////////////////// /////////////////////////// //////////////////
            Route::put('/settings/update', 'updateInstituteName')->name('settings_updateInstituteName');
            Route::put('/settings/password', 'updateInstitutePassword')->name('settings_updateInstitutePassword');
            Route::delete('/settings/delete-account', 'deleteInstituteAccount')->name('settings_deleteInstituteAccount');


            //
            Route::post('/institute/resubmit-license', 'resubmitLicencePhoto')->name('institute_resubmitLicense');



        });

        Route::controller(CategoryInstituteController::class)->group(function () {

            Route::get('/category/manage_category', 'index')->name('institute.manage_category');
            Route::get('/category/update_category/{id}', 'edit_category')->name('institute.edit_category');
            // Route::get('/category/update_category' , 'update_category')->name('institute.category_update');
            // Route::get('/category/manage' , 'manage')->name('institute.manage_category');

                        Route::get('/categories/{category}', 'showInsCourses')->name('categories_ins_courses');


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


        Route::controller(NotificationInstituteController::class)->group(function () {




            // Route::post('/notifications/mark-read', function () {
            //     Notifications::where('reciver_id', Auth::id())
            //         ->where('reciver_type', \App\Models\User::class)
            //         ->whereNull('read_at')
            //         ->update(['read_at' => now()]);
            //     return back();
            // })->name('notifications.markRead');

        });
        // //




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

        Route::controller(InstituteTabs::class)->group(function () {


            // Route::get('/institute/{instituteId}/profile', InstituteTabs::class)->name('institute.profile');


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

            Route::post('/reports', 'store')->name('reports_store');

            //
            //
            Route::get('/user_profile', 'user_profile')->name('user_profile');
            Route::get('/user_settings', 'user_settings')->name('user_settings');
            Route::put('/settings/update', 'updateUserName')->name('settings_updateUserName');
            Route::put('/settings/password', 'updatePassword')->name('settings_updatePassword');
            Route::delete('/settings/delete-account', 'deleteAccount')->name('settings_deleteAccount');

            Route::post('/toggle-follow/{institute}', 'toggleFollow')->name('toggle_follow');

            //


            Route::get('/categories/{category}', 'showCourses')->name('categories_courses');





            //////////// ///////////////// ///////////////////// /////////////////


            // Route::get('/user_course_adv_marked', 'user_course_adv_marked')->name('user_course_adv_marked');
            Route::get('/user_following', 'user_following')->name('user_following');


            // Route::get('/user_dashboard', 'user_dashboard')->name('user_dashboard');
            // Route::get('/user_history', 'user_history')->name('user_history');

            Route::get('/user_search', 'user_search')->name('user_search');

            //
            // Route::get('/institute_profile/ins_page', 'ins_page')->name('user.ins_page');

            //
            Route::get('/user_ins_profile/{id}', 'user_ins_profile')->name('user.user_ins_profile');
            Route::get('/user_all_ins', 'user_all_ins')->name('user.all_ins');

            Route::post('/follow/institute/{institute}', 'toggleFollow')->name('user.follow_institute');

            //


        });

        Route::controller(MasterCommentsController::class)->group(function () {
            Route::post('/comments', 'store_comment')->name('user.comments_store');




        });
        Route::controller(SearchResultsController::class)->group(function () {

            Route::get('/search-results', 'index')->name('user.search_results');
            Route::get('/search', SearchResultsController::class)->name('search.page');





        });
        Route::controller(SearchController::class)->group(function () {

            Route::get('/user/search', SearchController::class)->name('search.page');




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

// Route::get('/user/search', SearchController::class)->name('search.page');

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
