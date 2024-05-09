<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\BrandCustomerRepository;
use Illuminate\Http\Request;


class BrandCustomerController extends Controller
{
    protected $brandCustomerRepository;

    public function __construct(BrandCustomerRepository $brandCustomerRepository)
    {
        $this->brandCustomerRepository = $brandCustomerRepository;
    }

//    // TODO: Retrieves all brands.
//    public function index(Request $request)
//    {
//        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
//            $brands = $this->brandRepository->getAllBrands($request);
//            return $this->sendResponse($brands, 'All Brands');
//        });
//    }

    // TODO: Retrieves all trading brand Customer list.
    public function getAllBrandCustomerList(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $brand_customers = $this->brandCustomerRepository->getAllBrandCustomerList($request->brand_id);
            return $this->sendResponse($brand_customers, 'All brand Customer list');
        });
    }

//    // TODO: Stores a new brand.
//    public function store(BrandCreate $request)
//    {
//        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
//            $user = $this->brandRepository->createBrand($request->validated());
//            return $this->sendResponse($user, 'Brand created successfully');
//        });
//    }

//    // TODO: Retrieves a single brand by ID.
//    public function show($id)
//    {
//        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
//            $brand = $this->brandRepository->findBrandById($id);
//            return $this->sendResponse($brand, 'Single Brand');
//        });
//    }
//
//    // TODO: Updates a brand.
//    public function update(Request $request, $id)
//    {
//        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
//            $brand = $this->brandRepository->updateBrand($request->all(), $id);
//            return $this->sendResponse($brand, 'Brand updated successfully');
//        });
//    }
//
//    // TODO: Deletes a brand by ID.
//    public function destroy($id)
//    {
//        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
//            $this->brandRepository->deleteBrand($id);
//            return $this->sendResponse([], 'Brand deleted successfully');
//        });
//    }
}

