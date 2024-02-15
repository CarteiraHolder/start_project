<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Address\FindByCep;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\TokenValidationController;
use App\Http\Controllers\Brand\FindBrandIdController;
use App\Http\Controllers\Brand\RegisterBrandController;
use App\Http\Controllers\Brand\UpdateBrandController;
use App\Http\Controllers\ComboBox\ApiGeolocationController;
use App\Http\Controllers\ComboBox\BrandController;
use App\Http\Controllers\ComboBox\CityController;
use App\Http\Controllers\ComboBox\ContractorController;
use App\Http\Controllers\ComboBox\FlagController;
use App\Http\Controllers\ComboBox\IndustryController;
use App\Http\Controllers\ComboBox\RoleAllPermissionsController;
use App\Http\Controllers\ComboBox\RoleController;
use App\Http\Controllers\ComboBox\StateController;
use App\Http\Controllers\Contractor\ChangeStatusContractorController;
use App\Http\Controllers\Contractor\ExportListContractorController;
use App\Http\Controllers\Contractor\FindByCnpjInApiContractorController;
use App\Http\Controllers\Contractor\FindByIdContractorController;
use App\Http\Controllers\Contractor\HasContractorByCnpjController;
use App\Http\Controllers\Contractor\ListContractorController;
use App\Http\Controllers\Contractor\RegisterContractorController;
use App\Http\Controllers\Contractor\UpdateContractorController;
use App\Http\Controllers\Flag\FindFlagByIdController;
use App\Http\Controllers\Flag\RegisterFlagController;
use App\Http\Controllers\Flag\UpdateFlagController;
use App\Http\Controllers\Import\ImportCsvController;
use App\Http\Controllers\Import\ListImportCsvController;
use App\Http\Controllers\Import\ListImportCsvLogController;
use App\Http\Controllers\Industry\FindIndustryIdController;
use App\Http\Controllers\Industry\RegisterIndustryController;
use App\Http\Controllers\Industry\UpdateIndustryController;
use App\Http\Controllers\Notification\AllNotifyController;
use App\Http\Controllers\Notification\CountNotifyController;
use App\Http\Controllers\Notification\DeleteByIdNotifyController;
use App\Http\Controllers\Pdv\ChangeStatusPdvController;
use App\Http\Controllers\Pdv\ExportListPdvController;
use App\Http\Controllers\Pdv\FindPdvByIdController;
use App\Http\Controllers\Pdv\ListPdvController;
use App\Http\Controllers\Pdv\RegisterPdvController;
use App\Http\Controllers\Pdv\UpdatePdvController;
use App\Http\Controllers\Setting\CreateBackupController;
use App\Http\Controllers\Setting\GetSettinsController;
use App\Http\Controllers\Setting\UpdateSettinsController;
use App\Http\Controllers\Sku\ChangeStatusSkuController;
use App\Http\Controllers\Sku\ExportListSkuController;
use App\Http\Controllers\Sku\FindSkuIdController;
use App\Http\Controllers\Sku\ListSkuController;
use App\Http\Controllers\Sku\RegisterSkuController;
use App\Http\Controllers\Sku\UpdateSkuController;
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
    Route::get('Flag', FlagController::class)->middleware('auth:sanctum');
    Route::get('Contractor', ContractorController::class)->middleware('auth:sanctum');
    Route::get('Industry', IndustryController::class)->middleware('auth:sanctum');
    Route::get('Brand', BrandController::class)->middleware('auth:sanctum');
    Route::get('Role', RoleController::class)->middleware('auth:sanctum');
    Route::get('All/Role', RoleAllPermissionsController::class)->middleware('auth:sanctum');
    Route::get('Api/Geolocation', ApiGeolocationController::class)->middleware('auth:sanctum');
});

Route::prefix('Notification')->group(function () {
    Route::get('Count', CountNotifyController::class)->middleware('auth:sanctum');
    Route::get('All', AllNotifyController::class)->middleware('auth:sanctum');
    Route::get('Delete/{id}', DeleteByIdNotifyController::class)->middleware('auth:sanctum');
});

Route::prefix('Address')->group(function () {
    Route::get('Cep/{zipCode}', FindByCep::class)->middleware('auth:sanctum');
});

Route::prefix('Contractor')->group(function () {
    Route::get('{id}', FindByIdContractorController::class)->middleware('auth:sanctum');
    Route::get('find/{cnpj}', FindByCnpjInApiContractorController::class)->middleware('auth:sanctum');
    Route::get('Status/Change/{id}', ChangeStatusContractorController::class)->middleware('auth:sanctum');
    Route::post('Register', RegisterContractorController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateContractorController::class)->middleware('auth:sanctum');
    Route::post('List', ListContractorController::class)->middleware('auth:sanctum');
    Route::post('Export', ExportListContractorController::class)->middleware('auth:sanctum');
    Route::get('Has/Cnpj/{cnpj}', HasContractorByCnpjController::class)->middleware('auth:sanctum');
});

Route::prefix('Flag')->group(function () {
    Route::post('Register', RegisterFlagController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateFlagController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindFlagByIdController::class)->middleware('auth:sanctum');
});

Route::prefix('Industry')->group(function () {
    Route::post('Register', RegisterIndustryController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateIndustryController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindIndustryIdController::class)->middleware('auth:sanctum');
});

Route::prefix('Brand')->group(function () {
    Route::post('Register', RegisterBrandController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateBrandController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindBrandIdController::class)->middleware('auth:sanctum');
});

Route::prefix('Sku')->group(function () {
    Route::post('Register', RegisterSkuController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdateSkuController::class)->middleware('auth:sanctum');
    Route::post('List', ListSkuController::class)->middleware('auth:sanctum');
    Route::get('Status/Change/{id}', ChangeStatusSkuController::class)->middleware('auth:sanctum');
    Route::post('Export', ExportListSkuController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindSkuIdController::class)->middleware('auth:sanctum');
});

Route::prefix('Pdv')->group(function () {
    Route::post('Register', RegisterPdvController::class)->middleware('auth:sanctum');
    Route::post('Update', UpdatePdvController::class)->middleware('auth:sanctum');
    Route::post('List', ListPdvController::class)->middleware('auth:sanctum');
    Route::get('Status/Change/{id}', ChangeStatusPdvController::class)->middleware('auth:sanctum');
    Route::post('Export', ExportListPdvController::class)->middleware('auth:sanctum');
    Route::get('{id}', FindPdvByIdController::class)->middleware('auth:sanctum');
});

Route::prefix('Import')->group(function () {
    Route::post('Csv', ImportCsvController::class)->middleware('auth:sanctum');
    Route::post('List', ListImportCsvController::class)->middleware('auth:sanctum');
    Route::post('List/{id}', ListImportCsvLogController::class)->middleware('auth:sanctum');
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
