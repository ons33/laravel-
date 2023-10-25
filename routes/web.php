<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CondidatureController;

use App\Http\Controllers\OffredemploiController;
use App\Http\Controllers\SocieteController;

use App\Http\Controllers\ContratController;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->middleware(['auth', 'verified'])->name('dashboard-analytics');

// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');



Route::get('/frontoffice', function () {
  return view('Template.master');
})->name('index');


Route::get('/blog', function () {
  return view('Template.blog');
})->name('blog');

Route::get('/about', function () {
  return view('Template.about');
})->name('about');

Route::get('/product', function () {
  return view('Template.product');
})->name('shop');

Route::get('/contact', function () {
  return view('Template.contact');
})->name('contact');

Route::get('/cart', function () {
  return view('Template.cart');
})->name('cart');
Route::get('/condidature', function () {
  return view('Template.cart');
})->name('cart');
Route::get('/condidature', [CondidatureController::class,'apply'])->name('condidature');
Route::get('/offreemploi/{id}', [CondidatureController::class, 'showoffrecondidature'])->name('offreemploi.showoffrecondidature');
Route::get('/apply', [CondidatureController::class,'render'])->name('jobapplicants');
Route::delete('/deletecondidature/{id}', [CondidatureController::class, 'destroy'])->name('deletecondidature');
// For applying for a job (POST request)
Route::post('/addCondidature/{offre_emploi_id}', [CondidatureController::class , 'applyJobSaveRecord'])->name('addCondidature');
Route::get('/creatportfolio/{id}', [CondidatureController::class , 'create'])->name('creatportfolio');
// Route::get('download/{id}', [CondidatureController::class, 'downloadCV'])->name('download');
Route::get('/download/{id}', [CondidatureController::class, 'downloadCV'])->name('download.cv');
Route::get('/showcondidature/{id}', [CondidatureController::class , 'edit'])->name('showcondidature');
Route::put('/updatecondidature/{id}', [CondidatureController::class, 'update'])->name('condidatur.update');
Route::get('/contrat/{id}', [ContratController::class, 'show'])->name('contrat.show');
Route::get('/contrats', [ContratController::class, 'showAll'])->name('contrats.showAll');
Route::get('/show-contract-pdf', [CondidatureController::class, 'showContractPdf'])->name('show.contract.pdf');
// Dans votre fichier de routes (web.php)
Route::get('/add-contract/{id}', [ContratController::class, 'addContractForm'])->name('add.contract.form');
Route::get('/view-contract-template/{id}', [ContratController::class, 'viewContractTemplate'])->name('view.contract.template');
Route::get('/creatcontrat/{id}', [ContratController::class, 'createContrat'])->name('creatcontrat');
Route::post('/add-contract/{condidature_id}', [ContratController::class, 'addContract'])->name('add.contract');
Route::get('/contrat/{contratId}/showAll', [ContratController::class, 'showAll'])->name('contrat.showAll');
Route::get('/contrat/{contractId}/pdf', [ContratController::class, 'getContractPDF'])->name('contrat.pdf');
Route::delete('/deletecontract/{id}', [ContratController::class, 'destroy'])->name('deletecontract');
Route::get('/offre/{id}/candidatures', [OffredemploiController::class, 'showCandidatures'])->name('offre.candidatures');
Route::get('/offre', [OffredemploiController::class,'index'])->name('OffreEmplois');
Route::get('/societe', [SocieteController::class,'index'])->name('Societe');
Route::get('/societes/create', [SocieteController::class, 'create'])->name('societes.create');
Route::post('/addsoc', [SocieteController::class, 'store'])->name('societe.store');
Route::delete('/deletesociete/{id}', [SocieteController::class, 'destroyy'])->name('destroyy');
Route::get('/societes/edit/{id}', [SocieteController::class, 'edit'])->name('societes.edit');

Route::delete('/deleteoffre/{id}',[OffredemploiController::class,'destroy'])->name('deleteoffre');
Route::post('/addo', [OffredemploiController::class, 'store'])->name('offre.store');
Route::put('/offre/edit/{id}', [OffredemploiController::class, 'update'])->name('offre.update');
Route::put('/societes/edit/{id}', [SocieteController::class, 'update'])->name('societes.update');

Route::get('/offre/create', [OffredemploiController::class,'create'])->name('offre.create');
Route::get('/offre/frontoffre', [OffredemploiController::class,'frontoffre'])->name('offre.frontoffre');

Route::get('/offre/edit/{id}',[OffredemploiController::class, 'edit'])->name('offre.edit');
require __DIR__.'/auth.php';