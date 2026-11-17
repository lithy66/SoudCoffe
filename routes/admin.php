<?php

use App\Http\Controllers\Admin\BaseUnitController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\MaterialCategoryController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MaterialSubCategoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\RoastLevelsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FlavorController;
use App\Http\Controllers\Admin\TwoFactorController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::prefix(LaravelLocalization::setLocale())->middleware('localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin', 'two.factor', 'force.password']], function () {
        /* ############################### Dashboard ######################################## */
        Route::get('/two-factor/setup', [TwoFactorController::class, 'setup'])->name('two-factor.setup');
        Route::post('/two-factor/setup', [TwoFactorController::class, 'confirm'])->name('two-factor.confirm');
        Route::get('/two-factor/recovery', [TwoFactorController::class, 'recovery'])->name('two-factor.recovery');
        Route::post('/two-factor/recovery', [TwoFactorController::class, 'done'])->name('two-factor.done');
        Route::get('/two-factor/challenge', [TwoFactorController::class, 'challenge'])->name('two-factor.challenge');
        Route::post('/two-factor/challenge', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/password/change', [ChangePasswordController::class, 'edit'])->name('password.change');
        Route::post('/password/change', [ChangePasswordController::class, 'update'])->name('password.update');

        /* ############################### Begin Settings ######################################## */
        Route::group(['prefix' => 'settings', 'middleware' => ['role:admin']], function () {
            Route::get('/general', [SettingController::class, 'index'])->name('general.setting');
            Route::post('/update-general/{setting}', [SettingController::class, 'update'])->name('general.setting.update');
        });
        /* ############################### End Settings ######################################## */

        Route::middleware(['role:admin|branch manager'])->group(function (){
            /* ############################### Begin Branches ######################################## */
            /* ############################### Begin Category ######################################## */
            Route::group(['prefix' => 'Category', 'as' => 'category'], function () {
                Route::get('/', [CategoryController::class, 'index'])->name('');
                Route::get('/add', [CategoryController::class, 'create'])->name('.add');
                Route::post('/add', [CategoryController::class, 'store'])->name('.store');
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [CategoryController::class, 'update'])->name('.update');
                Route::post('/delete/', [CategoryController::class, 'destroy'])->name('.delete');
                Route::post('/status', [CategoryController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Category ######################################## */
            /* ############################### Begin Sub Category ######################################## */
            Route::group(['prefix' => 'subCategory', 'as' => 'subCategory'], function () {
                Route::get('/', [subCategoryController::class, 'index'])->name('');
                Route::get('/add', [subCategoryController::class, 'create'])->name('.add');
                Route::post('/add', [subCategoryController::class, 'store'])->name('.store');
                Route::get('/edit/{sub}', [subCategoryController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [subCategoryController::class, 'update'])->name('.update');
                Route::post('/delete/', [subCategoryController::class, 'destroy'])->name('.delete');
                Route::post('/status', [subCategoryController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Sub Category ######################################## */
            /* ############################### Begin flavor ######################################## */
            Route::group(['prefix' => 'Flavor', 'as' => 'flavor'], function () {
                Route::get('/', [FlavorController::class, 'index'])->name('');
                Route::get('/add', [FlavorController::class, 'create'])->name('.add');
                Route::post('/add', [FlavorController::class, 'store'])->name('.store');
                Route::get('/edit/{flavor}', [FlavorController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [FlavorController::class, 'update'])->name('.update');
                Route::post('/delete/', [FlavorController::class, 'destroy'])->name('.delete');
                Route::post('/status', [FlavorController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End flavor ######################################## */
            /* ############################### Begin RoastLevels ######################################## */
            Route::group(['prefix' => 'RoastLevels', 'as' => 'roastLevels'], function () {
                Route::get('/', [RoastLevelsController::class, 'index'])->name('');
                Route::get('/add', [RoastLevelsController::class, 'create'])->name('.add');
                Route::post('/store', [RoastLevelsController::class, 'store'])->name('.store');
                Route::get('/edit/{roastLevels}', [RoastLevelsController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [RoastLevelsController::class, 'update'])->name('.update');
                Route::post('/delete/', [RoastLevelsController::class, 'destroy'])->name('.delete');
                Route::post('/status', [RoastLevelsController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End RoastLevels ######################################## */
            /* ############################### Begin Product ######################################## */
            Route::group(['prefix' => 'Product', 'as' => 'product'], function () {
                Route::get('/', [ProductController::class, 'index'])->name('');
                Route::get('/add', [ProductController::class, 'create'])->name('.add');
                Route::get('/subCategory/{sub}', [ProductController::class, 'subCategory'])->name('.subCategory');
                Route::post('/add', [ProductController::class, 'store'])->name('.store');
                Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [ProductController::class, 'update'])->name('.update');
                Route::post('/delete/', [ProductController::class, 'destroy'])->name('.delete');
                Route::post('/status', [ProductController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Product ######################################## */
            /* ############################### Begin Branch ######################################## */
            Route::group(['prefix' => 'Branch', 'as' => 'branch', 'middleware' => ['role:admin']], function () {
                Route::get('/', [BranchController::class, 'index'])->name('');
                Route::get('/add', [BranchController::class, 'create'])->name('.add');
                Route::post('/add', [BranchController::class, 'store'])->name('.store');
                Route::get('/update/{branch}', [BranchController::class, 'edit'])->name('.edit');
                Route::post('/update/', [BranchController::class, 'update'])->name('.update');
                Route::post('/delete/', [BranchController::class, 'destroy'])->name('.delete');
                Route::post('/status', [BranchController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Branch ######################################## */
        });
    /***********************************************************************************************/
        /* ############################### Begin Storage ######################################## */
        Route::middleware(['role:admin|warehouse manager|warehouse keeper'])->group(function (){
            /* ############################### Begin Unit ######################################## */
            Route::group(['prefix' => 'Unit', 'as' => 'unit'], function () {
                Route::get('/', [UnitController::class, 'index'])->name('');
                Route::get('/add', [UnitController::class, 'create'])->name('.add');
                Route::post('/store', [UnitController::class, 'store'])->name('.store');
                Route::get('/edit/{unit}', [UnitController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [UnitController::class, 'update'])->name('.update');
                Route::post('/delete/', [UnitController::class, 'destroy'])->name('.delete');
                Route::post('/status', [UnitController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Unit ######################################## */
            /* ############################### Begin Base Unit ######################################## */
            Route::group(['prefix' => 'BaseUnit', 'as' => 'baseUnit'], function () {
                Route::get('/', [BaseUnitController::class, 'index'])->name('');
                Route::get('/add', [BaseUnitController::class, 'create'])->name('.add');
                Route::post('/store', [BaseUnitController::class, 'store'])->name('.store');
                Route::get('/edit/{base}', [BaseUnitController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [BaseUnitController::class, 'update'])->name('.update');
                Route::post('/delete/', [BaseUnitController::class, 'destroy'])->name('.delete');
                Route::post('/status', [BaseUnitController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Base Unit ######################################## */
            /* ############################### Begin Supplier ######################################## */
            Route::group(['prefix' => 'Supplier', 'as' => 'supplier'], function () {
                Route::get('/', [SupplierController::class, 'index'])->name('');
                Route::get('/add', [SupplierController::class, 'create'])->name('.add');
                Route::post('/add', [SupplierController::class, 'store'])->name('.store');
                Route::get('/edit/{supplier}', [SupplierController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [SupplierController::class, 'update'])->name('.update');
                Route::post('/delete/', [SupplierController::class, 'destroy'])->name('.delete');
                Route::post('/status', [SupplierController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Supplier ######################################## */
            /* ############################### Begin MaterialCategory ######################################## */
            Route::group(['prefix' => 'materialCategory', 'as' => 'materialC'], function () {
                Route::get('/', [MaterialCategoryController::class, 'index'])->name('');
                Route::get('/add', [MaterialCategoryController::class, 'create'])->name('.add');
                Route::post('/add', [MaterialCategoryController::class, 'store'])->name('.store');
                Route::get('/edit/{mCategory}', [MaterialCategoryController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [MaterialCategoryController::class, 'update'])->name('.update');
                Route::post('/delete/', [MaterialCategoryController::class, 'destroy'])->name('.delete');
                Route::post('/status', [MaterialCategoryController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End MaterialCategory ######################################## */
            /* ############################### Begin MaterialSub Category ######################################## */
            Route::group(['prefix' => 'materialSubCategory', 'as' => 'materialSC'], function () {
                Route::get('/', [MaterialSubCategoryController::class, 'index'])->name('');
                Route::get('/add', [MaterialSubCategoryController::class, 'create'])->name('.add');
                Route::post('/add', [MaterialSubCategoryController::class, 'store'])->name('.store');
                Route::get('/edit/{mSub}', [MaterialSubCategoryController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [MaterialSubCategoryController::class, 'update'])->name('.update');
                Route::post('/delete/', [MaterialSubCategoryController::class, 'destroy'])->name('.delete');
                Route::post('/status', [MaterialSubCategoryController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End MaterialSub Category ######################################## */
            /* ############################### Begin material ######################################## */
            Route::group(['prefix' => 'material', 'as' => 'material'], function () {
                Route::get('/', [MaterialController::class, 'index'])->name('');
                Route::get('/add', [MaterialController::class, 'create'])->name('.add');
                Route::post('/add', [MaterialController::class, 'store'])->name('.store');
                Route::get('/edit/{material}', [MaterialController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [MaterialController::class, 'update'])->name('.update');
                Route::post('/delete/', [MaterialController::class, 'destroy'])->name('.delete');
                Route::post('/status', [MaterialController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End material ######################################## */
            /* ############################### Begin Warehouse ######################################## */
            Route::group(['prefix' => 'Warehouse', 'as' => 'warehouse'], function () {
                Route::get('/', [WarehouseController::class, 'index'])->name('');
                Route::get('/add', [WarehouseController::class, 'create'])->name('.add');
                Route::post('/add', [WarehouseController::class, 'store'])->name('.store');
                Route::get('/edit/{warehouse}', [WarehouseController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [WarehouseController::class, 'update'])->name('.update');
                Route::post('/delete/', [WarehouseController::class, 'destroy'])->name('.delete');
                Route::post('/status', [WarehouseController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End Warehouse ######################################## */
            /* ############################### Begin purchase order ######################################## */
            Route::group(['prefix' => 'purchaseOrder', 'as' => 'purchaseOrder'], function () {
                Route::get('/', [PurchaseOrderController::class, 'index'])->name('');
                Route::get('/add', [PurchaseOrderController::class, 'create'])->name('.add');
                Route::post('/add', [PurchaseOrderController::class, 'store'])->name('.store');
                Route::get('/edit/{purchaseOrder}', [PurchaseOrderController::class, 'edit'])->name('.edit');
                Route::post('/edit/', [PurchaseOrderController::class, 'update'])->name('.update');
                Route::post('/delete/', [PurchaseOrderController::class, 'destroy'])->name('.delete');
                Route::post('/status', [PurchaseOrderController::class, 'updateStatus'])->name('.status');
            });
            /* ############################### End purchase order ######################################## */
        });
        /* ############################### End Storage ######################################## */
        /* ############################### Start Admin ######################################## */
        Route::middleware(['role:admin'])->group(function (){
            /* ############################### Start Role ######################################## */
            Route::group(['prefix' => 'register', 'as' => 'roles.'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::get('/add', [RoleController::class, 'create'])->name('add');
                Route::post('/add', [RoleController::class, 'store'])->name('store');
                Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
                Route::put('/{role}', [RoleController::class, 'update'])->name('update');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
            });
            /* ############################### End Role ######################################## */
            /* ############################### Start Authentication ######################################## */
            /* ############################### Authentication With Login ######################################## */
            Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
                Route::get('/register', [AdminController::class, 'create'])->name('register');
                Route::post('/register', [AdminController::class, 'store'])->name('postRegister');
                Route::get('/admin-list', [AdminController::class, 'AccountList'])->name('admin-list');
                Route::post('/delete/{admin}', [AdminController::class, 'destroy'])->name('delete');
                Route::get('/recover/{admin}', [AdminController::class, 'recover'])->name('recover');
            });
        });

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/profile/{admin}', [AdminController::class, 'edit'])->name('profileEdit');
            Route::post('/profile/{admin}', [AdminController::class, 'update'])->name('profileUpdate');
            Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
            Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
            Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
            Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

        });
    });
    /* ############################### Authentication Without Login ######################################## */
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('login-admin', [AdminController::class, 'login'])->name('login');
        Route::post('login-admin', [AdminController::class, 'postLogin'])->name('posLogin');
    });

    /* ############################### End Authentication ######################################## */

    require __DIR__ . '/auth.php';
    /* ############################### Livewire Route ######################################## */
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});








