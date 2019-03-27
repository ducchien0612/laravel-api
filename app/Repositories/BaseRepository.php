<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/26/2019
 * Time: 11:23 AM
 */

namespace App\Repositories;


abstract class BaseRepository implements EntityInterface
{
    protected $model;

    public function getAll()
    {
        return $this->model->paginate(1);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }


    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = $this->getById($id);
        $record->fill($data)->save();
        return $record;
    }


    public function getById($id)
    {
        $model = $this->model;
        return $model->findOrFail($id);
    }


    public function delete($id)
    {
        $record = $this->getById($id);
        return $record->delete();
    }


    public function destroy($id)
    {
        $record = $this->getById($id);
        return $record->forceDelete();
    }

}
