<?php

namespace App\Providers;

use App\Interfaces\BaseUnit\BaseUnitRepositoryInterface;
use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Interfaces\Material\MaterialRepositoryInterface;
use App\Interfaces\MaterialC\MaterialCRepositoryInterface;
use App\Interfaces\MaterialSubCategory\MaterialSubCategoryRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;
use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Interfaces\Supplier\SupplierRepositoryInterface;
use App\Interfaces\RoastLevels\RoastLevelsRepositoryInterface;
use App\Interfaces\Branch\BranchRepositoryInterface;
use App\Interfaces\SubCategory\SubCategoryRepositoryInterface;
use App\Interfaces\Flavor\FlavorRepositoryInterface;
use App\Interfaces\Unit\UnitRepositoryInterface;
use App\Interfaces\Warehouse\WarehouseRepositoryInterfaces;
use App\Repository\BaseUnit\BaseUnitRepository;
use App\Repository\Category\CategoryRepository;
use App\Repository\Material\MaterialRepository;
use App\Repository\MaterialC\MaterialCRepository;
use App\Repository\MaterialSubCategory\MaterialSubCategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\Supplier\SupplierRepository;
use App\Repository\RoastLevels\RoastLevelsRepository;
use App\Repository\Branch\BranchRepository;
use App\Repository\SubCategory\SubCategoryRepository;
use App\Repository\PurchaseOrder\PurchaseOrderRepository;
use App\Repository\Flavor\FlavorRepository;
use App\Repository\Unit\UnitRepository;
use App\Repository\Warehouse\WarehouseRepository;
use Illuminate\Support\ServiceProvider;
use function Psy\bin;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(FlavorRepositoryInterface::class, FlavorRepository::class);
        $this->app->bind(RoastLevelsRepositoryInterface::class, RoastLevelsRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
        $this->app->bind(BaseUnitRepositoryInterface::class, BaseUnitRepository::class);
        $this->app->bind(MaterialCRepositoryInterface::class, MaterialCRepository::class);
        $this->app->bind(MaterialSubCategoryRepositoryInterface::class, MaterialSubCategoryRepository::class);
        $this->app->bind(MaterialRepositoryInterface::class, MaterialRepository::class);
        $this->app->bind(WarehouseRepositoryInterfaces::class, WarehouseRepository::class);
        $this->app->bind(PurchaseOrderRepositoryInterface::class, PurchaseOrderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
