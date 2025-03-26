<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

// ユーザーがメール内のリンクをクリックしたときの処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();

    if($user->role_id == 2){
        return redirect()->route('company.project.on_going');
    }elseif($user->role_id == 3){
        return redirect()->route('freelancer.index'); // 認証成功後のリダイレクト先
    }

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



require __DIR__.'/company.php';
require __DIR__.'/freelancer.php';

//admin
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

    // freelancer management
    Route::get('freelancer', [App\Http\Controllers\Admin\FreelancerController::class, 'getAllFreelancers'])->name('freelancer');
    Route::get('freelancer/profile/{id}/', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
    Route::delete('/freelancer/{id}/deactivate', [App\Http\Controllers\Admin\FreelancerController::class, 'deactivate'])->name('freelancer.deactivate');
    Route::patch('/freelancer/{id}/activate', [App\Http\Controllers\Admin\FreelancerController::class, 'activate'])->name('freelancer.activate');

    // company management
    Route::get('company', [App\Http\Controllers\Admin\CompanyController::class, 'getAllCompanies'])->name('company');
    Route::get('company/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('company.profile');
    Route::delete('/company/{id}/deactivate', [App\Http\Controllers\Admin\CompanyController::class, 'deactivateCompany'])->name('company.deactivate');
    Route::patch('/company/{id}/activate', [App\Http\Controllers\Admin\CompanyController::class, 'activateCompany'])->name('company.activate');

    // project list
    Route::get('project', [App\Http\Controllers\Admin\ProjectController::class, 'getAllProjects'])->name('project');

    // transaction
    Route::get('transaction', [App\Http\Controllers\Admin\TransactionController::class, 'getAllTransactions'])->name('transaction');

    // statistics
    Route::get('/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('statistics');
    Route::get('/statistics/data', [App\Http\Controllers\Admin\StatisticsController::class, 'getStatisticsData'])->name('statistics.data');
    Route::get('/statistics/skills', [App\Http\Controllers\Admin\StatisticsController::class, 'getProjectSkillStatistics'])->name('statistics.skills');
    Route::get('/statistics/freelancer-skills', [App\Http\Controllers\Admin\StatisticsController::class, 'getFreelancerSkillStatistics'])->name('statistics.freelancer_skills');
    Route::get('/statistics/project-skill-top10', [App\Http\Controllers\Admin\StatisticsController::class, 'getProjectSkillTop10'])->name('statistics.project_skill_top10');
    Route::get('/statistics/freelancer-skill-top10', [App\Http\Controllers\Admin\StatisticsController::class, 'getFreelancerSkillTop10'])->name('statistics.freelancer_skill_top10');
    Route::get('/statistics/project_ranks', [App\Http\Controllers\Admin\StatisticsController::class, 'projectRanks'])->name('statistics.project_ranks');
    Route::get('/statistics/freelancer_ranks', [App\Http\Controllers\Admin\StatisticsController::class, 'freelancerRanks'])->name('statistics.freelancer_ranks');
});
