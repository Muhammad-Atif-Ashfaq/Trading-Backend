<?php

namespace App\Http\Controllers\Api\Brand;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\BrandCustomerRepository;
use Illuminate\Http\Request;


class BrandCustomerController extends Controller
{
    protected $brandCustomerRepository;

    public function __construct(BrandCustomerRepository $brandCustomerRepository)
    {
        $this->brandCustomerRepository = $brandCustomerRepository;
    }

    // TODO: Retrieves all trading brand Customer list.
    public function getAllBrandCustomerList(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $brand_customers = $this->brandCustomerRepository->getAllBrandCustomerList($request->brand_id);
            return $this->sendResponse($brand_customers, 'All brand Customer list');
        });
    }
}

