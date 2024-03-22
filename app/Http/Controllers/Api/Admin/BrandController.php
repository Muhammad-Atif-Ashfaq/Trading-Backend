<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\BrandRepository;
use App\Http\Requests\Api\Admin\Brands\Create as BrandCreate;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $brands = $this->brandRepository->getAllBrands($request);
            return $this->sendResponse($brands, 'All Brands');
        });
    }

    public function store(BrandCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->brandRepository->createBrand($request->validated());
            return $this->sendResponse($user, 'Brand created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $brand = $this->brandRepository->findBrandById($id);
            return $this->sendResponse($brand, 'Single Brand');
        });
    }

    public function update(BrandCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $brand = $this->brandRepository->updateBrand($request->validated(), $id);
            return $this->sendResponse($brand, 'Brand updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->brandRepository->deleteBrand($id);
            return $this->sendResponse([], 'Brand deleted successfully');
        });
    }
}

