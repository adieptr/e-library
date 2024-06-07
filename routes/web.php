<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogintuController;
use App\Http\Controllers\RegadController;
use App\Http\Controllers\ProfileadController;
use App\Http\Controllers\ProfilespController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ContentadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('index');
});
// Route::get('/login', function () {
//     return view('login');
// });
Route::get('/regis', function () {
    return view('regis');
});

Route::get('/load-email', function () {
    return view('email');
});

// Route::get('/login', [LoginController::class, 'index']);
// Route::get('/logreg', [RegisterController::class, 'register']);
// Route::post('/logreg', [RegisterController::class, 'register']);

Route::get('/logreg', [RegisterController::class, 'index'])->name('logreg');
Route::post('/logreg', [RegisterController::class, 'store']);
Route::resource('user', RegisterController::class);

Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('updatePassword');
Route::get('/logreg', [LoginController::class, 'index'])->name('loginnn');
Route::post('/logreg', [LoginController::class, 'login']);
Route::get('/logoutsp', [LoginController::class, 'logoutsp'])->name('logoutsp');
Route::get('/logoutad', [LoginController::class, 'logoutad'])->name('logoutad');
Route::get('/logoutsiswa', [LoginController::class, 'logoutsiswa'])->name('logoutsiswa');

Route::get('/tutors//tambahtutor', [RegadController::class, 'index'])->name('tutors.index');;
Route::post('/tutors//tambahtutor', [RegadController::class, 'store'])->name('tutors.store');;

Route::get('/tambahtutor', [LogintuController::class, 'index'])->name('login');;
Route::post('/tambahtutor', [LogintuController::class, 'login']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/', 'PagesController@landing')->name('pages.landing');
    Route::get('/dashboarduser', 'PagesControllerUser@dashboard')->name('pages.dashboarduser');
    Route::get('/profileuser', 'PagesControllerUser@profileuser')->name('pages.profileuser');
    Route::get('/game', 'PagesControllerUser@game')->name('pages.game');
    Route::get('/tictac', 'PagesControllerUser@tictac')->name('pages.tictac');
    Route::get('/cardlv1', 'PagesControllerUser@cardlv1')->name('pages.cardlv1');
    Route::get('/batu', 'PagesControllerUser@batu')->name('pages.batu');
    Route::get('/ular', 'PagesControllerUser@ular')->name('pages.ular');
    Route::get('/gambar', 'PagesControllerUser@gambar')->name('pages.gambar');
    Route::get('/ninja', 'PagesControllerUser@ninja')->name('pages.ninja');
    // Route::get('/landing', 'PagesController@landing')->name('pages.landing');
    // Route::get('/datawarga', 'PagesController@datawarga')->name('pages.datawarga');
    // Route::get('/info', 'PagesController@info')->name('pages.info');
    // Route::get('/bantuansosial', 'PagesController@bantuansosial')->name('pages.bantuansosial');
    // Route::get('/keuangan', 'PagesController@keuangan')->name('pages.keuangan');
    // Route::get('/berita/{slug}',
    // 'PagesController@luwe')->name('pages.berita');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/profileadmin', 'PagesControllerAdmin@profileadmin')->name('pages.profileadmin');
    Route::get('/dashboardad', 'PagesControllerAdmin@dashboard')->name('pages.dashboardad');
    Route::post('/carisiswaad', 'PagesControllerAdmin@carisiswaad')->name('pages.carisiswaad');
    Route::get('/profileadmin', 'ProfileadController@profileadmin')->name('pages.profileadmin');
    // Route::get('/landing', 'PagesController@landing')->name('pages.landing');
    // Route::get('/datawarga', 'PagesController@datawarga')->name('pages.datawarga');
    // Route::get('/info', 'PagesController@info')->name('pages.info');
    // Route::get('/bantuansosial', 'PagesController@bantuansosial')->name('pages.bantuansosial');
    // Route::get('/keuangan', 'PagesController@keuangan')->name('pages.keuangan');
    // Route::get('/berita/{slug}',
    // 'PagesController@luwe')->name('pages.berita');
});



Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboardsp', 'PagesControllerSp@dashboard')->name('pages.dashboardsp');
    Route::get('/profilesp', 'ProfilespController@profilesp')->name('pages.profilesp');
    Route::post('/carisiswasp', 'PagesControllerSp@carisiswasp')->name('pages.carisiswasp');
    Route::get('/datatransaksi', 'PagesControllerSp@datatransaksi')->name('pages.datatransaksi');
    Route::get('/caritransaksi', 'PagesControllerSp@datatransaksi')->name('caritransaksi');
    // Route::get('/dashboardad', 'PagesControllerAdmin@dashboard')->name('pages.dashboardad');
    // Route::get('/kursus', 'PagesControllerAdmin@kursus')->name('pages.kursus');
    // Route::get('/landing', 'PagesController@landing')->name('pages.landing');
    // Route::get('/datawarga', 'PagesController@datawarga')->name('pages.datawarga');
    // Route::get('/info', 'PagesController@info')->name('pages.info');
    // Route::get('/bantuansosial', 'PagesController@bantuansosial')->name('pages.bantuansosial');
    // Route::get('/keuangan', 'PagesController@keuangan')->name('pages.keuangan');
    // Route::get('/berita/{slug}',
    // 'PagesController@luwe')->name('pages.berita');
});

Route::get('/tutors/edit', [ProfileadController::class, 'edit'])->name('tutors.edit');
Route::put('/tutors/update', [ProfileadController::class, 'update'])->name('tutors.update');

Route::get('/tutors/editsp', [ProfilespController::class, 'editsp'])->name('tutors.editsp');
Route::put('/tutors/updatesp', [ProfilespController::class, 'updatesp'])->name('tutors.updatesp');

Route::get('/watch-video/{id}', 'VideoController@show')->name('watch.video');



use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PlaylistadController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoadController;
use App\Http\Controllers\CoursesadController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswassssController;

Route::get('/playlist/{id}', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlist/{id}', [PlaylistController::class, 'showPlaylist'])->name('playlist.showPlaylist');
Route::get('/playlistad/{id}', [PlaylistadController::class, 'index'])->name('playlist.index');
Route::get('/playlistad/{id}', [PlaylistadController::class, 'showPlaylistad'])->name('playlist.showPlaylistad');
Route::post('/playlistad/{id}/search', [PlaylistadController::class, 'cariplaydalamad'])->name('playlist.search');
Route::get('/detailsiswa/{id}', [SiswassssController::class, 'index'])->name('detailsiswa.index');
Route::get('/detailsiswa/{id}', [SiswassssController::class, 'showPlaylistad'])->name('detailsiswa.showPlaylistad');
Route::post('/carisiswa', [SiswaController::class, 'carisiswa'])->name('siswa.carisiswa');
Route::post('/carisiswadalam', [SiswassssController::class, 'carisiswadalam'])->name('detailsiswa.carisiswadalam');


Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::post('/complete-course/{playlist_id}', [CoursesController::class, 'completeCourse'])->name('complete.course');
Route::get('/riwayatcourses', [CoursesController::class, 'riwayatkur'])->name('courses.riwayatkur');
Route::get('/coursesad', [CoursesadController::class, 'index'])->name('coursesad.index');
Route::post('/cariplayad', [CoursesadController::class, 'cariplayad'])->name('coursesad.cariplayad');
Route::get('/tutor', [TutorController::class, 'index'])->name('tutor.index');
Route::get('/trans/{id}', [TutorController::class, 'trans'])->name('tutor.trans');
Route::get('/', [TutorController::class, 'landtutor'])->name('tutor.landtutor');
Route::get('/course/{id}', [TutorController::class, 'detailcor'])->name('course.detailcor');
Route::post('/create-transaction', [TutorController::class, 'createTransaction'])->name('create.transaction');
Route::get('/transaksi/{id_transaksi}/edit', [TutorController::class, 'tampiluptra'])->name('transaksi.tampiluptra');
Route::put('/transaksi/{id_transaksi}', [TutorController::class, 'updateTransaksi'])->name('transaksi.update');
Route::post('/caritutor', [TutorController::class, 'caritutor'])->name('tutor.caritutor');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/add_courses', [CoursesadController::class, 'addCourses'])->name('add_courses');
Route::post('/add_playlist', [CoursesadController::class, 'addPlaylist'])->name('add.playlist');
Route::post('/delete-playlist', [CoursesadController::class, 'deletePlaylist'])->name('delete_playlist');
Route::post('/coursesad', [CoursesadController::class, 'deletePlaylist'])->name('delete.playlist');
Route::post('/update-playlist', [CoursesadController::class, 'updatePlaylist'])->name('update_playlist');
Route::get('/update-playlist/{get_id}', [CoursesadController::class, 'updatePlaylistView'])->name('update_playlist_view');






Route::get('/contentad', [ContentadController::class, 'index'])->name('contentad.index');
Route::post('/delete-video', [ContentadController::class, 'delete'])->name('delete_video');
Route::get('/add-content', [ContentadController::class, 'showAddContentForm'])->name('add_content');
Route::post('/upload-content', [ContentadController::class, 'uploadContent'])->name('upload_content');
Route::get('/update-content/{videoId}', [ContentadController::class, 'updateContentForm'])->name('update.content.form');
Route::post('update-content/{videoId}', [ContentadController::class, 'updateContent'])->name('update.content');
Route::get('/commentsad', [ContentAdController::class, 'commentsAd'])->name('commentsad');
Route::post('/caricommentsad', [ContentAdController::class, 'caricommentsad'])->name('caricommentsad');
Route::post('/caricontentad', [ContentAdController::class, 'caricontentad'])->name('caricontentad');
Route::post('/delete-comment', [ContentAdController::class, 'deleteComment'])->name('delete.comment');




// Definisikan route untuk menampilkan video
Route::get('/watch-video/{id}', [VideoController::class, 'showVideo'])->name('watch.video');
Route::post('/video/{videoId}/store-comment', [VideoController::class, 'storeComment'])->name('video.storeComment');
// Route::post('watch-video/{videoId}/like', 'VideoController@likeVideo');
Route::post('watch-video/{videoId}/like', [VideoController::class, 'likeVideo'])->name('like.video');
Route::post('/video/{videoId}/comment/{commentId}/edit', [VideoController::class, 'editComment'])->name('video.editComment');
Route::delete('/video/{videoId}/comment/{commentId}/delete', [VideoController::class, 'deleteComment'])->name('video.deleteComment');
Route::post('/video/{videoId}/comment/{commentId}/update', [VideoController::class, 'updateComment'])->name('video.updateComment');
Route::get('/watch-videoad/{id}', [VideoadController::class, 'showVideo'])->name('watchad.video');
Route::get('/watch-content/{id}', [ContentadController::class, 'lihatcoment'])->name('watchad.content');
// Route::get('/update-pass', function () {
//     return view('updatepass');
// });


use App\Http\Controllers\ForgotPasswordController;
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');


use App\Http\Controllers\EmailController;
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendmail');
Route::get('/updatepass', [EmailController::class, 'uppas'])->name('updatepass');


