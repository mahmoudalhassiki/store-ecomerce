<?php


namespace App\Repositories;


use App\Http\interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        return $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    public function show($id)
    {
        return $this->model->findorFail($id);
    }
    public function getModel()
    {
        return $this->model;
    }
    public function setModel($model)
    {
        return $this->model=$model;
    }
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
