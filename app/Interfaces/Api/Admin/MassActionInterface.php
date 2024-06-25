<?php

namespace App\Interfaces\Api\Admin;


interface MassActionInterface
{

    public function massEdit(array $data,array $values);

    public function massDelete(array $data);

    public function massImport(array $data);

    public function massCloseOrders(array $ids);

}
