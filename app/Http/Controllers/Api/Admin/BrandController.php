<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Http\Request;
use App\Models\User;

class BrandController extends Controller
{
    
    public function index()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $brands = User::whereHas('roles', function ($query) {
                $query->where('name', 'brand');
            })->get();
            return $this->sendResponse($brands, 'All Brands');
        });
    }

    
    public function store(Request $request)
    {
        // $brands = User::create([
        //     'name' => $request->name,
        //     'email'=> $request->name.'@gmail.com',
        //     'password' => 
        // ])
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
