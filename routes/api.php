<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Address\FindByCep;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\TokenValidationController;
use App\Http\Controllers\ComboBox\CityController;
use App\Http\Controllers\ComboBox\RoleAllPermissionsController;
use App\Http\Controllers\ComboBox\RoleController;
use App\Http\Controllers\ComboBox\StateController;
use App\Http\Controllers\Notification\AllNotifyController;
use App\Http\Controllers\Notification\CountNotifyController;
use App\Http\Controllers\Notification\DeleteByIdNotifyController;
use App\Http\Controllers\Setting\CreateBackupController;
use App\Http\Controllers\Setting\GetSettinsController;
use App\Http\Controllers\Setting\UpdateSettinsController;
use App\Http\Controllers\User\ChangeStatusUserController;
use App\Http\Controllers\User\ExportListUserController;
use App\Http\Controllers\User\FindUserByHashController;
use App\Http\Controllers\User\FindUserByIdController;
use App\Http\Controllers\User\ForgotPasswordUserController;
use App\Http\Controllers\User\HasUserByCpfController;
use App\Http\Controllers\User\HasUserByEmailController;
use App\Http\Controllers\User\ListUserController;
use App\Http\Controllers\User\LoggedUserController;
use App\Http\Controllers\User\LoginBecomeUserController;
use App\Http\Controllers\User\NewPasswordUserController;
use App\Http\Controllers\User\RegisterUserController;
use App\Http\Controllers\User\TestPasswordUserController;
use App\Http\Controllers\User\UpdateUserController;
use App\Http\Controllers\User\UpdateUserProfileController;
use App\Http\Controllers\User\UpdateUserProfilePasswordController;

Route::prefix('ComboBox')->group(function () {
    Route::post('City', CityController::class)->middleware('auth:sanctum');
    Route::post('State', StateController::class)->middleware('auth:sanctum');
    Route::get('Role', RoleController::class)->middleware('auth:sanctum');
    Route::get('All/Role', RoleAllPermissionsController::class)->middleware('auth:sanctum');
});

Route::prefix('Notification')->group(function () {
    Route::get('Count', CountNotifyController::class)->middleware('auth:sanctum');
    Route::get('All', AllNotifyController::class)->middleware('auth:sanctum');
    Route::get('Delete/{id}', DeleteByIdNotifyController::class)->middleware('auth:sanctum');
});

Route::prefix('Address')->group(function () {
    Route::get('Cep/{zipCode}', FindByCep::class)->middleware('auth:sanctum');
});

Route::prefix('Settings')->group(function () {
    Route::get('Get', GetSettinsController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateSettinsController::class)->middleware('auth:sanctum');
    Route::get('Backup/Create', CreateBackupController::class)->middleware('auth:sanctum');
});

Route::prefix('User')->group(function () {
    Route::post('List', ListUserController::class)->middleware('auth:sanctum');
    Route::post('Export', ExportListUserController::class)->middleware('auth:sanctum');
    Route::get('Status/Change/{id}', ChangeStatusUserController::class)->middleware('auth:sanctum');
    Route::get('Has/Cpf/{cpf}', HasUserByCpfController::class)->middleware('auth:sanctum');
    Route::get('Has/Email/{email}', HasUserByEmailController::class)->middleware('auth:sanctum');
    Route::post('Register', RegisterUserController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateUserController::class)->middleware('auth:sanctum');
    Route::post('Prifile/Update', UpdateUserProfileController::class)->middleware('auth:sanctum');
    Route::post('Prifile/Change/Password', UpdateUserProfilePasswordController::class)->middleware('auth:sanctum');
    Route::get('Login/Become/{id}', LoginBecomeUserController::class)->middleware('auth:sanctum');
    Route::get('Logged', LoggedUserController::class)->middleware('auth:sanctum');
    Route::get('Teste/Password/{password}', TestPasswordUserController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindUserByIdController::class)->middleware('auth:sanctum');

    // NO AUTH
    Route::get('Hash/{hase}', FindUserByHashController::class);
    Route::post('New/Password', NewPasswordUserController::class);
    Route::post('Forgot/Password', ForgotPasswordUserController::class);
});


Route::prefix('Auth')->group(function () {
    Route::post('Login', LoginController::class);

    Route::get('Check', TokenValidationController::class)->middleware('auth:sanctum');
    Route::get('Logout', LogoutController::class)->middleware('auth:sanctum');
});
