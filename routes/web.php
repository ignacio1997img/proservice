<?php

use App\Http\Controllers\AjaxController;
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

use App\Http\Controllers\MessageBusineController;

use App\Http\Controllers\MessageBeneficiaryController;
use App\Models\MessageBusine;
use App\Models\MessagePeople;
use App\Models\Department;
use App\Models\People;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('register-employe', function () {

    $department = Department::where('status',1)->get();
    return view('register-employe', compact('department'));
});
Route::get('register-busine', function () {
    $department = Department::where('status',1)->get();
    return view('register-busine', compact('department'));
});
Route::get('register-beneficiary', function () {
    $department = Department::where('status',1)->get();
    return view('register-beneficiary', compact('department'));
});


Route::get('login', function () {
    return redirect('admin/login');
})->name('login');


// Route::get('/', function () {
//     return redirect('admin');
// });
Route::get('/', [HomeController::class, 'index']);




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::resource('people', PeopleController::class);
    Route::get('people/view/{id}', [PeopleController::class, 'read'])->name('people.view');
    Route::post('people/view/aprobar-rubro', [PeopleWorkExperienceController::class, 'aprobarRubro'])->name('people.aprobarRubro');
    Route::post('people/view/rubro/modelaje-update', [PeopleWorkExperienceController::class, 'updateCategoriaModelaje'])->name('people.updateCategoriaModelaje');
    

    //rutas para exeperiencia laboral de la persona
    Route::resource('people-perfil-experience', PeopleWorkExperienceController::class);

    Route::post('people-perfil-experience/perfil/update', [PeopleController::class, 'perfilUpdate'])->name('people-perfil.update');
    Route::delete('people-perfil-experience/delete', [PeopleWorkExperienceController::class, 'destroy'])->name('work-experience.delete');
    Route::get('people-perfil-experience/requirement-create/{id}/{rubro_id}', [PeopleWorkExperienceController::class, 'requirementCreate'])->name('work-experience.requirement-create');
    Route::post('people-perfil-experience/requirement-guardia-store' , [PeopleWorkExperienceController::class, 'requirementGuardiaStore'])->name('work-experience.requirement-guardia-store');
    Route::post('people-perfil-experience/requirement-jardineria-store' , [PeopleWorkExperienceController::class, 'requirementJardineriaStore'])->name('work-experience.requirement-jardineria-store');
    Route::post('people-perfil-experience/requirement-piscinero-store' , [PeopleWorkExperienceController::class, 'requirementPiscineroStore'])->name('work-experience.requirement-piscinero-store');
    Route::post('people-perfil-experience/requirement-modelos-store' , [PeopleWorkExperienceController::class, 'requirementModelosStore'])->name('work-experience.requirement-modelos-store');

    Route::get('people-perfil-experience/ficha-tecnica/{id?}', [PeopleWorkExperienceController::class, 'fichaTecnica'])->name('work-experience.print-ficha-tecnica');


    //para la bandeja de la persona
    Route::get('message-people-bandeja', [MessagePeopleBusineController::class, 'message_people'])->name('message-people.bandeja');
    Route::post('message-ṕeople-bandeja/aceptar', [MessagePeopleBusineController::class, 'aceptar'])->name('message-people.aceptar');
    Route::post('message-people-bandeja/rechazar', [MessagePeopleBusineController::class, 'rechazar'])->name('message-people.rechazar');


//######## BUSIBNES ##############
    Route::resource('busines', BusineController::class);    
    Route::post('busines/aprobar-busine', [BusineController::class, 'aprobarBusine'])->name('busines.aprobar-busine');

    //para que la empresa vea su perfil y pueda editarlo
    Route::get('busines_perfil_view', [BusineController::class, 'perfilView'])->name('busines.perfil-view');
    Route::post('busines/perfil/update', [BusineController::class, 'perfilUpdate'])->name('busines.perfil-update');//para actualizar el perfil de la empresa
    Route::post('busine/perfil/requirement-jardineria-store' , [BusineController::class, 'requirementJardineriaStore'])->name('busine.perfil.requirement-jardineria-store');
    Route::post('busine/perfil/requirement-guardia-store' , [BusineController::class, 'requirementGuardiaStore'])->name('busine.perfil.requirement-guardia-store');
    Route::post('busine/perfil/requirement-piscina-store' , [BusineController::class, 'requirementPiscinaStore'])->name('busine.perfil.requirement-piscina-store');
    Route::post('busine/perfil/requirement-modelo-store' , [BusineController::class, 'requirementModeloStore'])->name('busine.perfil.requirement-modelo-store');


    // buscar trabajadores de empresas 
    Route::resource('search-work',SearchWorkController::class);
    Route::post('search-work/search', [SearchWorkController::class, 'search'])->name('search-work.search');

    // para enviar solicicitudes de una empresa a los trabaladores
    Route::resource('message-people-busine', MessagePeopleBusineController::class);

    //para la bandeja de la empresa
    Route::get('message-busine-bandeja', [MessageBusineController::class, 'message_busine'])->name('message-busine.bandeja');
    Route::post('message-busine-bandeja/aceptar', [MessageBusineController::class, 'aceptar'])->name('message-busine.aceptar');
    Route::post('message-busine-bandeja/rechazar', [MessageBusineController::class, 'rechazar'])->name('message-busine.rechazar');

    //para  que la empresa pueda cancelar o eliminar una solicitud
    Route::post('message-busine-bandeja/cancelar', [MessageBusineController::class, 'cancelar'])->name('message-busine.cancelar');

    //para que la empresa pueda ver los perfiles de las personas que aceptaron sus solicitudes de la empresa
    Route::get('message-busine.bandeja/people-perfil-view/{id}/{people_id}/{rubro_id}/{experience?}', [MessageBusineController::class, 'people_perfil_view'])->name('message-busine.bandeja.people-perfil-view');
 
    //calificacion
    Route::post('message-busine.bandeja/calificacion', [MessagePeopleBusineController::class, 'calification'])->name('message-busine.bandeja.calificacion');




    // BENEFICIARY
    // Route::resource('beneficiary', BeneficiaryController::class);
    Route::get('beneficiary-perfil-view', [BeneficiaryController::class , 'perfilView'])->name('beneficiary.perfil-view');
    Route::post('beneficiary/perfil/update', [BeneficiaryController::class, 'update'])->name('beneficiary.perfil-update');

    //para buscar empresas
    Route::resource('search-busine', SearchBusineController::class);
    Route::post('search-busine/search', [SearchBusineController::class, 'search'])->name('search-busine.search');

    // para enviar solicicitudes de una empresa a los trabaladores
    Route::resource('message-beneficiary-busine', MessageBusineController::class);

    //para  la bandeja del beneficiario
    Route::get('message-beneficiary-bandeja', [MessageBeneficiaryController::class, 'message_beneficiary'])->name('message-beneficiary.bandeja');

    //para  que la empresa pueda cancelar o eliminar una solicitud
    Route::post('message-beneficiary-bandeja/cancelar', [MessageBeneficiaryController::class, 'cancelar'])->name('message-beneficiary.cancelar');

        
    //para que la empresa pueda ver los perfiles de las personas que aceptaron sus solicitudes de la empresa
    Route::get('message-beneficiary.bandeja/busine-perfil-view/{id}/{busine_id}', [MessageBeneficiaryController::class, 'busine_perfil_view'])->name('message-beneficiary.bandeja.busine-perfil-view');


    //calificacion
    Route::post('message-beneficiary.bandeja/calificacion', [MessageBusineController::class, 'calification'])->name('message-beneficiary.bandeja.calificacion');







    //  notificaciones
    Route::get('notification-message', [AjaxController::class, 'getNotifications'])->name('get.notifications');

    Route::get('get/city/{id?}', [AjaxController::class , 'getCity'])->name('ajax.get_city');

});

    // Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome');

    Route::get('people/create-people', [PeopleController::class, 'create'])->name('people.create');
    Route::post('people/people-store', [PeopleController::class, 'store'])->name('people.store');

    Route::get('busines/create-busine', [BusineController::class, 'create'])->name('busine.create');
    Route::post('busines/busine-store', [BusineController::class, 'store'])->name('busine.store');

    Route::get('beneficiary/create-beneficiary', [BeneficiaryController::class, 'create'])->name('beneficiary.create');
    Route::post('beneficiary/beneficiary-store', [BeneficiaryController::class, 'store'])->name('beneficiary.store');


// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
