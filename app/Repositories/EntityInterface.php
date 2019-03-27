<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/26/2019
 * Time: 11:25 AM
 */

namespace App\Repositories;


interface EntityInterface
{
    public function store($data);

    public function getAll();

    public function getById($id);

    public function update($id, $data, $excepts = [], $only = []);

    public function delete($id);

}
