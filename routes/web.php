<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('teacher')->group(function() {
  Route::get('/login','Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
  Route::post('/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
  Route::post('logout/', 'Auth\TeacherLoginController@logout')->name('teacher.logout');
  Route::get('/', 'Auth\TeacherController@index')->name('teacher.dashboard');
});

Auth::routes(['verify' => true,'register'=>true]);

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', 'HomeController@index')->middleware('verified');
Route::get('/survey/kesehatan','SurveyKesehatanController@index')->middleware(['auth:web,teacher']);

Route::post('/surveyStudent','SurveyController@storeStudent')->middleware(['auth:web']);
Route::post('/surveyTeacher','SurveyController@storeTeacher')->middleware(['auth:teacher']);

Route::post('/surveyVisitor','VisitorController@store');
Route::get('/visitors','VisitorController@index');

Route::get('/list/siswa','BukuTamuController@Siswa')->middleware(['auth:teacher']);
Route::get('/jajak/pendapat','JajakController@index')->middleware(['auth:web']);
Route::post('/jajak','JajakController@store')->middleware(['auth:web']);

Route::post('/pernyataan','JajakController@storePernyataan')->middleware(['auth:web']);
Route::post('/surveyKesehatan','SurveyKesehatanController@store')->middleware(['auth:web']);

Route::get('/bukutamu','BukuTamuController@bukutamu');
Route::get('/report/kesehatan','BukuTamuController@kesehatan')->middleware(['auth:teacher']);
Route::get('/kesehatan/guru','SurveyKesehatanController@indexGuru')->middleware(['auth:teacher']);
Route::get('/report/jajak','JajakController@indexReport')->middleware(['auth:teacher']);
Route::get('/report/lomba','LombaController@indexReport')->middleware(['auth:teacher']);
Route::get('/report/test','ReportTestController@index')->middleware(['auth:teacher']);
Route::get('/report/test/{gender}/{class}/{lokasi}','ReportTestController@searchGender')->middleware(['auth:teacher']);
Route::get('/report/daily/corpus','ReportTestController@reportDailyStudent')->middleware(['auth:teacher']);
Route::get('/report/daily/corpus/{tgl}','ReportTestController@reportDailyStudentDate')->middleware(['auth:teacher']);

Route::get('/report/daily/staff/corpus','ReportTestController@reportDailyStaff')->middleware(['auth:teacher']);
Route::get('/report/daily/staff/corpus/{tgl}','ReportTestController@reportDailyStaffDate')->middleware(['auth:teacher']);


Route::post('/kesehatan/guru','SurveyKesehatanController@postGuru')->middleware(['auth:teacher']);

Route::get('/lomba','LombaController@index')->middleware(['auth:web']);
Route::post('/lomba','LombaController@store')->middleware(['auth:web']);
Route::get('/check_fit','FitController@index')->middleware(['auth:web']);
Route::get('/fit/create','FitController@create')->middleware(['auth:web']);
Route::get('/fit/kg/create','FitController@createKG')->middleware(['auth:web']);
Route::post('/fit_kg','FitController@storeKG')->middleware(['auth:web']);

Route::post('/fit_test','FitController@store')->middleware(['auth:web']);

Route::get('/daily_fit','DailyFitController@index')->middleware(['auth:web']);
Route::get('/daily_fit/create','DailyFitController@create')->middleware(['auth:web']);
Route::get('/daily_fit/create/{date}','DailyFitController@createDate')->middleware(['auth:web']);
Route::post('/daily_fit/store','DailyFitController@store')->middleware(['auth:web']);


Route::get('/fit_time','FitTimeController@index')->middleware(['auth:teacher']);
Route::get('/fit_time/create','FitTimeController@create')->middleware(['auth:teacher']);
Route::post('/fit_time/store','FitTimeController@store')->middleware(['auth:teacher']);
Route::get('/fit_time/edit/{id}','FitTimeController@edit')->middleware(['auth:teacher']);
Route::post('/fit_time/update','FitTimeController@update')->middleware(['auth:teacher']);
Route::get('/fit_time/delete/{id}','FitTimeController@delete')->middleware(['auth:teacher']);

// Route::get('/fit_sch','JadwalLatihanController@index')->middleware(['auth:teacher']);
// Route::get('/fit_sch/create','JadwalLatihanController@create')->middleware(['auth:teacher']);
// Route::post('/fit_sch/store','JadwalLatihanController@store')->middleware(['auth:teacher']);
// Route::get('/fit_sch/edit/{id}','JadwalLatihanController@edit')->middleware(['auth:teacher']);
// Route::post('/fit_sch/update','JadwalLatihanController@update')->middleware(['auth:teacher']);
// Route::get('/fit_sch/delete/{id}','JadwalLatihanController@delete')->middleware(['auth:teacher']);
// Route::get('/latihan','LatihanController@index')->middleware(['auth:teacher']);
// Route::get('/latihan/create','LatihanController@create')->middleware(['auth:teacher']);
// Route::get('/latihan/edit/{id}','LatihanController@edit')->middleware(['auth:teacher']);
// Route::post('/latihan/update','LatihanController@update')->middleware(['auth:teacher']);
// Route::post('/latihan/store','LatihanController@store')->middleware(['auth:teacher']);
// Route::get('/latihan/delete/{id}','LatihanController@delete')->middleware(['auth:teacher']);


Route::get('/fit_video','VideoWorkoutController@index')->middleware(['auth:teacher']);
Route::get('/fit_video/create','VideoWorkoutController@create')->middleware(['auth:teacher']);
Route::post('/fit_video/store','VideoWorkoutController@store')->middleware(['auth:teacher']);
Route::get('/fit_video/edit/{id}','VideoWorkoutController@edit')->middleware(['auth:teacher']);
Route::post('/fit_video/update','VideoWorkoutController@update')->middleware(['auth:teacher']);
Route::get('/fit_video/delete/{id}','VideoWorkoutController@delete')->middleware(['auth:teacher']);

Route::get('/export/test','ExportFitController@index');
Route::get('/export/test/create','ExportFitController@create');
Route::post('/export/test/store','ExportFitController@storeFile');
Route::get('/export/daily', 'ExportCheckDaily@index');
Route::post('/export/daily-store', 'ExportCheckDaily@storeFile');

Route::get('runSync','ExportFitController@runSync');
Route::get('runSyncDaily', 'ExportCheckDaily@runSync');

Route::get('manual/test','ManualTestController@index');
Route::get('manual/test/create','ManualTestController@create');
Route::post('manual/test/store','ManualTestController@store');
Route::get('manual/test/edit/{id}','ManualTestController@edit');
Route::post('manual/test/update','ManualTestController@update');
Route::get('manual/test/delete/{id}','ManualTestController@delete');

Route::get('/final/report','FinalReportController@index')->middleware(['auth:teacher']);;
Route::get('/final/report/show/{time}/{kelas}','FinalReportController@show')->middleware(['auth:teacher']);;
Route::get('/final/report/generate','FinalReportController@create')->middleware(['auth:teacher']);;
Route::post('/final/report/filter','FinalReportController@filter')->middleware(['auth:teacher']);;
Route::post('/final/submit','FinalReportController@submit')->middleware(['auth:teacher']);;
Route::get('corpus/print/{id}','FinalReportController@print')->middleware(['auth:teacher']);
Route::get('corpus/delete/{id}','FinalReportController@delete')->middleware(['auth:teacher']);

//fendy
Route::get('corpus/indexsetting', 'FinalReportController@indexSetting')->middleware(['auth:teacher']);
Route::get('corpus/settingPrinting/{id}', 'FinalReportController@reportSetting')->middleware(['auth:teacher']);
Route::post('corpus/settingPrinting', 'FinalReportController@storeReportSetting')->middleware(['auth:teacher']);

// /Auth::routes();

Route::get('/fit_staff','FitStaffController@index')->middleware(['auth:teacher']);
Route::get('/fit_staff/create','FitStaffController@create')->middleware(['auth:teacher']);
Route::post('/fit_staff','FitStaffController@store')->middleware(['auth:teacher']);

Route::get('/daily_fit/staff','DailyFitStaffController@index')->middleware(['auth:teacher']);
Route::get('/daily_fit/staff/create','DailyFitStaffController@create')->middleware(['auth:teacher']);
Route::get('/daily_fit/staff/create/{date}','DailyFitStaffController@createDate')->middleware(['auth:teacher']);
Route::post('/daily_fit/staff/store','DailyFitStaffController@store')->middleware(['auth:teacher']);

Route::get('/fit_video/staff','FitVideoStaffController@index')->middleware(['auth:teacher']);
Route::get('/fit_video/staff/create','FitVideoStaffController@create')->middleware(['auth:teacher']);
Route::post('/fit_video/staff/store','FitVideoStaffController@store')->middleware(['auth:teacher']);
Route::get('/fit_video/staff/edit/{id}','FitVideoStaffController@edit')->middleware(['auth:teacher']);
Route::post('/fit_video/staff/update','FitVideoStaffController@update')->middleware(['auth:teacher']);
Route::get('/fit_video/staff/delete/{id}','FitVideoStaffController@destroy')->middleware(['auth:teacher']);

Route::get('/fit_time/staff','FitTimeStaffController@index')->middleware(['auth:teacher']);
Route::get('/fit_time/staff/create','FitTimeStaffController@create')->middleware(['auth:teacher']);
Route::post('/fit_time/staff/store','FitTimeStaffController@store')->middleware(['auth:teacher']);
Route::get('/fit_time/staff/edit/{id}','FitTimeStaffController@edit')->middleware(['auth:teacher']);
Route::post('/fit_time/staff/update','FitTimeStaffController@update')->middleware(['auth:teacher']);
Route::get('/fit_time/staff/delete/{id}','FitTimeStaffController@destroy')->middleware(['auth:teacher']);
Route::get('/periode/survey','SurveyPeriodeController@index')->middleware(['auth:teacher']);
Route::get('/periode/survey/create','SurveyPeriodeController@create')->middleware(['auth:teacher']);
Route::post('/periode/survey/store','SurveyPeriodeController@store')->middleware(['auth:teacher']);
Route::get('/periode/survey/edit/{id}','SurveyPeriodeController@edit')->middleware(['auth:teacher']);
Route::post('/periode/survey/update','SurveyPeriodeController@update')->middleware(['auth:teacher']);
Route::get('/periode/survey/delete/{id}','SurveyPeriodeController@destroy')->middleware(['auth:teacher']);

Route::get('/report/pernyataan','ReportPernyataan@index')->middleware(['auth:teacher']);
Route::get('/report/pernyataan/{id}','ReportPernyataan@show')->middleware(['auth:teacher']);

Route::get('rubrick/creativity','ReportCreativity@index')->middleware(['auth:teacher']);
Route::get('rubrick/creativity/{time}/{kelas}','ReportCreativity@getData')->middleware(['auth:teacher']);
Route::post('/creativity/store','ReportCreativity@store')->middleware(['auth:teacher']);
Route::get('/creativity/edit/{id}','ReportCreativity@edit')->middleware(['auth:teacher']);
Route::post('/creativity/update','ReportCreativity@update')->middleware(['auth:teacher']);
Route::get('creativity/delete/{id}','ReportCreativity@delete')->middleware(['auth:teacher']);
Route::get('/persenDaily','ReportPersenDailyController@index')->middleware(['auth:teacher']);
Route::get('/persenDaily/{time}/{kls}','ReportPersenDailyController@show')->middleware(['auth:teacher']);


Route::get('/staff/final/report','FinalReportStaffController@index')->middleware(['auth:teacher']);;
Route::get('/staff/final/report/show/{time}/{kelas}','FinalReportStaffController@show')->middleware(['auth:teacher']);;
Route::get('/staff/final/report/generate','FinalReportStaffController@create')->middleware(['auth:teacher']);;
Route::post('/staff/final/report/filter','FinalReportStaffController@filter')->middleware(['auth:teacher']);;
Route::post('/staff/final/submit','FinalReportStaffController@submit')->middleware(['auth:teacher']);;
Route::get('staff/corpus/print/{id}','FinalReportStaffController@print')->middleware(['auth:teacher']);
Route::get('staff/corpus/delete/{id}','FinalReportStaffController@delete')->middleware(['auth:teacher']);


// fendy
Route::get('/semester', 'MasterSemester@index')->middleware(['auth:teacher']);
Route::get('/semester/create', 'MasterSemester@create')->middleware(['auth:teacher']);
Route::post('/semester/store', 'MasterSemester@store')->middleware(['auth:teacher']);
Route::get('/semester/edit/{id}', 'MasterSemester@edit')->middleware(['auth:teacher']);
Route::post('/semester/update', 'MasterSemester@update')->middleware(['auth:teacher']);
Route::get('/semester/delete/{id}', 'MasterSemester@destroy')->middleware(['auth:teacher']);