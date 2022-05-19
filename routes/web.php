<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusineController;
use App\Http\Controllers\PeopleWorkExperienceController;

use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\SearchWorkController;

use App\Http\Controllers\MessagePeopleBusineController;
use App\Http\Controllers\SearchBusineController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::resource('people', PeopleController::class);


    //rutas para exeperiencia laboral de la persona
    Route::resource('people-perfil-experience', PeopleWorkExperienceController::class);
    Route::post('people-perfil-experience/perfil/update', [PeopleController::class, 'perfilUpdate'])->name('people-perfil.update');
    Route::delete('people-perfil-experience/delete', [PeopleWorkExperienceController::class, 'destroy'])->name('work-experience.delete');
    Route::get('people-perfil-experience/requirement-create/{id}/{rubro_id}', [PeopleWorkExperienceController::class, 'requirementCreate'])->name('work-experience.requirement-create');
    Route::post('people-perfil-experience/requirement-guardia-store' , [PeopleWorkExperienceController::class, 'requirementGuardiaStore'])->name('work-experience.requirement-guardia-store');
    Route::post('people-perfil-experience/requirement-jardineria-store' , [PeopleWorkExperienceController::class, 'requirementJardineriaStore'])->name('work-experience.requirement-jardineria-store');



    Route::resource('busines', BusineController::class);    
    Route::post('busines/aprobar-busine', [BusineController::class, 'aprobarBusine'])->name('busines.aprobar-busine');

    //para que la empresa vea su perfil y pueda editarlo
    Route::get('busines_perfil_view', [BusineController::class, 'perfilView'])->name('busines.perfil-view');
    Route::post('busines/perfil/update', [BusineController::class, 'perfilUpdate'])->name('busines.perfil-update');//para actualizar el perfil de la empresa
    Route::post('busine/perfil/requirement-jardineria-store' , [BusineController::class, 'requirementJardineriaStore'])->name('busine.perfil.requirement-jardineria-store');
    Route::post('busine/perfil/requirement-guardia-store' , [BusineController::class, 'requirementGuardiaStore'])->name('busine.perfil.requirement-guardia-store');

    // buscar trabajadores de empresas 
    Route::resource('search-work',SearchWorkController::class);
    Route::post('search-work/search', [SearchWorkController::class, 'search'])->name('search-work.search');

    // para enviar solicicitudes de una empresa a los trabaladores
    Route::resource('message-people-busine', MessagePeopleBusineController::class);

    //para la bandeja de la persona
    Route::get('message-people-bandeja', [MessagePeopleBusineController::class, 'message_people'])->name('message-people.bandeja');
    Route::post('message-ṕeople-bandeja/aceptar', [MessagePeopleBusineController::class, 'aceptar'])->name('message-people.aceptar');
    Route::post('message-people-bandeja/rechazar', [MessagePeopleBusineController::class, 'rechazar'])->name('message-people.rechazar');




    // BENEFICIARY
    // Route::resource('beneficiary', BeneficiaryController::class);
    Route::get('beneficiary-perfil-view', [BeneficiaryController::class , 'perfilView'])->name('beneficiary.perfil-view');
    Route::post('beneficiary/perfil/update', [BeneficiaryController::class, 'update'])->name('beneficiary.perfil-update');

    //para buscar empresas
    Route::resource('search-busine', SearchBusineController::class);
    Route::post('search-busine/search', [SearchBusineController::class, 'search'])->name('search-busine.search');
});

    Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome');

    Route::get('people/create-people', [PeopleController::class, 'create'])->name('people.create');
    Route::post('people/people-store', [PeopleController::class, 'store'])->name('people.store');

    Route::get('busines/create-busine', [BusineController::class, 'create'])->name('busine.create');
    Route::post('busines/busine-store', [BusineController::class, 'store'])->name('busine.store');

    Route::get('beneficiary/create-beneficiary', [BeneficiaryController::class, 'create'])->name('beneficiary.create');
    Route::post('beneficiary/beneficiary-store', [BeneficiaryController::class, 'store'])->name('beneficiary.store');


// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
