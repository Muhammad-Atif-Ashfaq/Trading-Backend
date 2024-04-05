<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Models\Role;
use App\Models\User;
use App\Models\Brand;
use App\Services\GenerateRandomService;
use Illuminate\Database\Eloquent\Model;
use Str;

class BrandRepository
{
    private $model;
    private $user;

    public function __construct()
    {
        $this->model = new Brand();
        $this->user = new User();
    }

    public function getAllBrands($request)
    {
        $brands = $this->model->query();
        $brands = PaginationHelper::paginate(
            $brands,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $brands;
    }

    public function createBrand(array $data)
    {
        $password = Str::random(6);
        $user = $this->user->create([
            'name' => $data['name'],
            'email' => $data['name'] . '@gmail.com',
            'password' => bcrypt($password),
            'original_password' => $password
        ]);

        $brand = $this->model->create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'public_key' => GenerateRandomService::getBrandPublicKey(),
            'domain' => $data['domain'],
            'margin_call' => $data['margin_call'],
        ]);

        $user->assignRole(Role::BRAND);

        return $user;
    }

    public function findBrandById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateBrand(array $data, $id)
    {
        $brand = $this->model->findOrFail($id);
        $brand->update([
            'name' => $data['name'] ?? $brand->name,
            'domain' => $data['domain'] ?? $brand->domain,
            'margin_call' => $data['margin_call'] ?? $brand->margin_call
        ]);
        return $brand;
    }

    public function deleteBrand($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
