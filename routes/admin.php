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

        /* ############################### Change Password (أول دخول) ######################################## */
        Route::get('/password/change', [ChangePasswordController::class, 'edit'])->name('password.change');
        Route::post('/password/change', [ChangePasswordController::class, 'update'])->name('password.update');

        /* ############################### Begin Settings ######################################## */
        Route::group(['prefix' => 'settings', 'middleware' => ['role:admin,admin']], function () {
            Route::get('/general', [SettingController::class, 'index'])->name('general.setting');
            Route::post('/update-general/{setting}', [SettingController::class, 'update'])->name('general.setting.update');
        });

        /* ############################### End Settings ######################################## */
        /* ############################### Begin Category ######################################## */
        Route::group(['prefix' => 'Category', 'as' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('')->middleware('permission:view-catalog,admin');
            Route::get('/add', [CategoryController::class, 'create'])->name('.add')->middleware('permission:create-catalog,admin');
            Route::post('/add', [CategoryController::class, 'store'])->name('.store')->middleware('permission:create-catalog,admin');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('.edit')->middleware('permission:edit-catalog,admin');
            Route::post('/edit/', [CategoryController::class, 'update'])->name('.update')->middleware('permission:edit-catalog,admin');
            Route::post('/delete/', [CategoryController::class, 'destroy'])->name('.delete')->middleware('permission:delete-catalog,admin');
            Route::post('/status', [CategoryController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-catalog,admin');
        });
        /* ############################### End Category ######################################## */
        /* ############################### Begin Sub Category ######################################## */
        Route::group(['prefix' => 'subCategory', 'as' => 'subCategory'], function () {
            Route::get('/', [subCategoryController::class, 'index'])->name('')->middleware('permission:view-catalog,admin');
            Route::get('/add', [subCategoryController::class, 'create'])->name('.add')->middleware('permission:create-catalog,admin');
            Route::post('/add', [subCategoryController::class, 'store'])->name('.store')->middleware('permission:create-catalog,admin');
            Route::get('/edit/{sub}', [subCategoryController::class, 'edit'])->name('.edit')->middleware('permission:edit-catalog,admin');
            Route::post('/edit/', [subCategoryController::class, 'update'])->name('.update')->middleware('permission:edit-catalog,admin');
            Route::post('/delete/', [subCategoryController::class, 'destroy'])->name('.delete')->middleware('permission:delete-catalog,admin');
            Route::post('/status', [subCategoryController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-catalog,admin');
        });
        /* ############################### End Sub Category ######################################## */
        /* ############################### Begin flavor ######################################## */
        Route::group(['prefix' => 'Flavor', 'as' => 'flavor'], function () {
            Route::get('/', [FlavorController::class, 'index'])->name('')->middleware('permission:view-catalog,admin');
            Route::get('/add', [FlavorController::class, 'create'])->name('.add')->middleware('permission:create-catalog,admin');
            Route::post('/add', [FlavorController::class, 'store'])->name('.store')->middleware('permission:create-catalog,admin');
            Route::get('/edit/{flavor}', [FlavorController::class, 'edit'])->name('.edit')->middleware('permission:edit-catalog,admin');
            Route::post('/edit/', [FlavorController::class, 'update'])->name('.update')->middleware('permission:edit-catalog,admin');
            Route::post('/delete/', [FlavorController::class, 'destroy'])->name('.delete')->middleware('permission:delete-catalog,admin');
            Route::post('/status', [FlavorController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-catalog,admin');
        });
        /* ############################### End flavor ######################################## */
        /* ############################### Begin RoastLevels ######################################## */
        Route::group(['prefix' => 'RoastLevels', 'as' => 'roastLevels'], function () {
            Route::get('/', [RoastLevelsController::class, 'index'])->name('')->middleware('permission:view-catalog,admin');
            Route::get('/add', [RoastLevelsController::class, 'create'])->name('.add')->middleware('permission:create-catalog,admin');
            Route::post('/store', [RoastLevelsController::class, 'store'])->name('.store')->middleware('permission:create-catalog,admin');
            Route::get('/edit/{roastLevels}', [RoastLevelsController::class, 'edit'])->name('.edit')->middleware('permission:edit-catalog,admin');
            Route::post('/edit/', [RoastLevelsController::class, 'update'])->name('.update')->middleware('permission:edit-catalog,admin');
            Route::post('/delete/', [RoastLevelsController::class, 'destroy'])->name('.delete')->middleware('permission:delete-catalog,admin');
            Route::post('/status', [RoastLevelsController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-catalog,admin');
        });
        /* ############################### End RoastLevels ######################################## */
        /* ############################### Begin Product ######################################## */
        Route::group(['prefix' => 'Product', 'as' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('')->middleware('permission:view-catalog,admin');
            Route::get('/add', [ProductController::class, 'create'])->name('.add')->middleware('permission:create-catalog,admin');
            Route::get('/subCategory/{sub}', [ProductController::class, 'subCategory'])->name('.subCategory')->middleware('permission:view-catalog,admin');
            Route::post('/add', [ProductController::class, 'store'])->name('.store')->middleware('permission:create-catalog,admin');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('.edit')->middleware('permission:edit-catalog,admin');
            Route::post('/edit/', [ProductController::class, 'update'])->name('.update')->middleware('permission:edit-catalog,admin');
            Route::post('/delete/', [ProductController::class, 'destroy'])->name('.delete')->middleware('permission:delete-catalog,admin');
            Route::post('/status', [ProductController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-catalog,admin');
        });
        /* ############################### End Product ######################################## */
    /***********************************************************************************************/
        /* ############################### Begin Storage ######################################## */
        /* ############################### Begin Unit ######################################## */
        Route::group(['prefix' => 'Unit', 'as' => 'unit'], function () {
            Route::get('/', [UnitController::class, 'index'])->name('')->middleware('permission:view-units,admin');
            Route::get('/add', [UnitController::class, 'create'])->name('.add')->middleware('permission:create-unit,admin');
            Route::post('/store', [UnitController::class, 'store'])->name('.store')->middleware('permission:create-unit,admin');
            Route::get('/edit/{unit}', [UnitController::class, 'edit'])->name('.edit')->middleware('permission:edit-unit,admin');
            Route::post('/edit/', [UnitController::class, 'update'])->name('.update')->middleware('permission:edit-unit,admin');
            Route::post('/delete/', [UnitController::class, 'destroy'])->name('.delete')->middleware('permission:delete-unit,admin');
            Route::post('/status', [UnitController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-unit,admin');
        });
        /* ############################### End Unit ######################################## */
        /* ############################### Begin Base Unit ######################################## */
        Route::group(['prefix' => 'BaseUnit', 'as' => 'baseUnit'], function () {
            Route::get('/', [BaseUnitController::class, 'index'])->name('')->middleware('permission:view-units,admin');
            Route::get('/add', [BaseUnitController::class, 'create'])->name('.add')->middleware('permission:create-unit,admin');
            Route::post('/store', [BaseUnitController::class, 'store'])->name('.store')->middleware('permission:create-unit,admin');
            Route::get('/edit/{base}', [BaseUnitController::class, 'edit'])->name('.edit')->middleware('permission:edit-unit,admin');
            Route::post('/edit/', [BaseUnitController::class, 'update'])->name('.update')->middleware('permission:edit-unit,admin');
            Route::post('/delete/', [BaseUnitController::class, 'destroy'])->name('.delete')->middleware('permission:delete-unit,admin');
            Route::post('/status', [BaseUnitController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-unit,admin');
        });
        /* ############################### End Base Unit ######################################## */
        /* ############################### Begin Supplier ######################################## */
        Route::group(['prefix' => 'Supplier', 'as' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index'])->name('')->middleware('permission:view-suppliers,admin');
            Route::get('/add', [SupplierController::class, 'create'])->name('.add')->middleware('permission:create-supplier,admin');
            Route::post('/add', [SupplierController::class, 'store'])->name('.store')->middleware('permission:create-supplier,admin');
            Route::get('/edit/{supplier}', [SupplierController::class, 'edit'])->name('.edit')->middleware('permission:edit-supplier,admin');
            Route::post('/edit/', [SupplierController::class, 'update'])->name('.update')->middleware('permission:edit-supplier,admin');
            Route::post('/delete/', [SupplierController::class, 'destroy'])->name('.delete')->middleware('permission:delete-supplier,admin');
            Route::post('/status', [SupplierController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-supplier,admin');
        });
        /* ############################### End Supplier ######################################## */
        /* ############################### Begin MaterialCategory ######################################## */
        Route::group(['prefix' => 'materialCategory', 'as' => 'materialC'], function () {
            Route::get('/', [MaterialCategoryController::class, 'index'])->name('')->middleware('permission:view-material-categories,admin');
            Route::get('/add', [MaterialCategoryController::class, 'create'])->name('.add')->middleware('permission:create-material-category,admin');
            Route::post('/add', [MaterialCategoryController::class, 'store'])->name('.store')->middleware('permission:create-material-category,admin');
            Route::get('/edit/{mCategory}', [MaterialCategoryController::class, 'edit'])->name('.edit')->middleware('permission:edit-material-category,admin');
            Route::post('/edit/', [MaterialCategoryController::class, 'update'])->name('.update')->middleware('permission:edit-material-category,admin');
            Route::post('/delete/', [MaterialCategoryController::class, 'destroy'])->name('.delete')->middleware('permission:delete-material-category,admin');
            Route::post('/status', [MaterialCategoryController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-material-category,admin');
        });
        /* ############################### End MaterialCategory ######################################## */
        /* ############################### Begin MaterialSub Category ######################################## */
        Route::group(['prefix' => 'materialSubCategory', 'as' => 'materialSC'], function () {
            Route::get('/', [MaterialSubCategoryController::class, 'index'])->name('')->middleware('permission:view-material-categories,admin');
            Route::get('/add', [MaterialSubCategoryController::class, 'create'])->name('.add')->middleware('permission:create-material-category,admin');
            Route::post('/add', [MaterialSubCategoryController::class, 'store'])->name('.store')->middleware('permission:create-material-category,admin');
            Route::get('/edit/{mSub}', [MaterialSubCategoryController::class, 'edit'])->name('.edit')->middleware('permission:edit-material-category,admin');
            Route::post('/edit/', [MaterialSubCategoryController::class, 'update'])->name('.update')->middleware('permission:edit-material-category,admin');
            Route::post('/delete/', [MaterialSubCategoryController::class, 'destroy'])->name('.delete')->middleware('permission:delete-material-category,admin');
            Route::post('/status', [MaterialSubCategoryController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-material-category,admin');
        });
        /* ############################### End MaterialSub Category ######################################## */
        /* ############################### Begin material ######################################## */
        Route::group(['prefix' => 'material', 'as' => 'material'], function () {
            Route::get('/', [MaterialController::class, 'index'])->name('')->middleware('permission:view-materials,admin');
            Route::get('/add', [MaterialController::class, 'create'])->name('.add')->middleware('permission:create-material,admin');
            Route::post('/add', [MaterialController::class, 'store'])->name('.store')->middleware('permission:create-material,admin');
            Route::get('/edit/{material}', [MaterialController::class, 'edit'])->name('.edit')->middleware('permission:edit-material,admin');
            Route::post('/edit/', [MaterialController::class, 'update'])->name('.update')->middleware('permission:edit-material,admin');
            Route::post('/delete/', [MaterialController::class, 'destroy'])->name('.delete')->middleware('permission:delete-material,admin');
            Route::post('/status', [MaterialController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-material,admin');
        });
        /* ############################### End material ######################################## */
        /* ############################### Begin Warehouse ######################################## */
        Route::group(['prefix' => 'Warehouse', 'as' => 'warehouse'], function () {
            Route::get('/', [WarehouseController::class, 'index'])->name('')->middleware('permission:view-warehouses,admin');
            Route::get('/add', [WarehouseController::class, 'create'])->name('.add')->middleware('permission:create-warehouse,admin');
            Route::post('/add', [WarehouseController::class, 'store'])->name('.store')->middleware('permission:create-warehouse,admin');
            Route::get('/edit/{warehouse}', [WarehouseController::class, 'edit'])->name('.edit')->middleware('permission:edit-warehouse,admin');
            Route::post('/edit/', [WarehouseController::class, 'update'])->name('.update')->middleware('permission:edit-warehouse,admin');
            Route::post('/delete/', [WarehouseController::class, 'destroy'])->name('.delete')->middleware('permission:delete-warehouse,admin');
            Route::post('/status', [WarehouseController::class, 'updateStatus'])->name('.status')->middleware('permission:edit-warehouse,admin');
        });
        /* ############################### End Warehouse ######################################## */
        /* ############################### Begin purchase order ######################################## */
        Route::group(['prefix' => 'purchaseOrder', 'as' => 'purchaseOrder'], function () {
            Route::get('/', [PurchaseOrderController::class, 'index'])->name('')->middleware('permission:create-purchase-order|approve-purchase-order,admin');
            Route::get('/add', [PurchaseOrderController::class, 'create'])->name('.add')->middleware('permission:create-purchase-order,admin');
            Route::post('/add', [PurchaseOrderController::class, 'store'])->name('.store')->middleware('permission:create-purchase-order,admin');
            Route::get('/edit/{purchaseOrder}', [PurchaseOrderController::class, 'edit'])->name('.edit')->middleware('permission:create-purchase-order,admin');
            Route::post('/edit/', [PurchaseOrderController::class, 'update'])->name('.update')->middleware('permission:create-purchase-order,admin');
            Route::post('/delete/', [PurchaseOrderController::class, 'destroy'])->name('.delete')->middleware('permission:approve-purchase-order,admin');
            Route::post('/status', [PurchaseOrderController::class, 'updateStatus'])->name('.status')->middleware('permission:approve-purchase-order,admin');
        });
        /* ############################### End purchase order ######################################## */
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
        /* ############################### End Storage ######################################## */

        /* ############################### Start Role ######################################## */
        Route::group(['prefix' => 'register', 'as' => 'roles.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('permission:view-roles,admin');
            Route::get('/add', [RoleController::class, 'create'])->name('add')->middleware('permission:create-role,admin');
            Route::post('/add', [RoleController::class, 'store'])->name('store')->middleware('permission:create-role,admin');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('permission:edit-role,admin');
            Route::put('/{role}', [RoleController::class, 'update'])->name('update')->middleware('permission:edit-role,admin');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('permission:delete-role,admin');
        });
        /* ############################### End Role ######################################## */

        /* ############################### Start Authentication ######################################## */
        /* ############################### Authentication With Login ######################################## */
        // إدارة المستخدمين: للأدمن بس
        Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['role:admin,admin']], function () {
            Route::get('/register', [AdminController::class, 'create'])->name('register');
            Route::post('/register', [AdminController::class, 'store'])->name('postRegister');
            Route::get('/admin-list', [AdminController::class, 'AccountList'])->name('admin-list');
            Route::post('/delete/{admin}', [AdminController::class, 'destroy'])->name('delete');
            Route::get('/recover/{admin}', [AdminController::class, 'recover'])->name('recover');
        });
        // الخروج والإشعارات: لأي أدمن مسجّل دخول
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








