<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseContract
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function all(int $numPaginated = 9, string $orderBy = 'created_at', string $sortBy = 'desc', array $relationship = []){
        return $this->model->orderBy($orderBy, $sortBy)->with($relationship)->paginate($numPaginated);
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    public function find(string $id){
        return $this->model->find($id);
    }

    public function update(array $attributes, string $id) : bool{
        return $this->find($id)->update($attributes);
    }

    public function paginate(array $data, int $paginate){
        return $this->model->where($data)->paginate($paginate);
    }

    public function delete(string $id): bool{
        return $this->model->find($id)->delete();
    }
}
