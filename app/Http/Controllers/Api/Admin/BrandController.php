<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Services\GenerateRandomService;
use App\Http\Requests\Api\Admin\Brands\Create as BrandCreate;
use Illuminate\Http\Request;
use App\Models\{User, Brand};
use Str;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $brands = User::whereHas('roles', function ($query) {
                $query->where('name', 'brand');
            });
            $brands = PaginationHelper::paginate(
                $brands,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($brands, 'All Brands');
        });
    }


    public function store(Request $request)
    {

        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $password = Str::random(6);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->name . '@gmail.com',
                'password' => $password,
                'original_password' => $password
            ]);
            if ($user) {
                $brand = Brand::create([
                    'user_id' => $user->id,
                    'name'    => $request->name,
                    'public_key'=> GenerateRandomService::getBrandPublicKey(),
                    'login_id'=>GenerateRandomService::RandomBrand(),
                ]);
                $user->assignRole('brand');
                return $this->sendResponse($user, 'All Store Successfully');
            }
        });
    }


    public function show(string $id)
    {

        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $brands = User::find($id);
            return $this->sendResponse($brands, 'Single Brands');
        });
    }


    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $brands = User::find($id);
            $update = $brands->update([
                'name' => $request->name,
                'email' => $request->name . 'gmail.com'
            ]);
            if ($update) {
                return $this->sendResponse($brands, 'Brands Update Successfully');
            }
        });
    }


    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $brands = User::find($id)->delete();
            return $this->sendResponse([], 'Brands Deleted');
        });
    }
}
