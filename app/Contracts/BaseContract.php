<?php
namespace App\Contracts;

interface BaseContract
{
    // Creating a model instance
    public function create(array $attributes);

    //Find by Id
    public function find(string $id);

    //Updating a model instance
    public function update(array $attributes, string $id);

    //Return All
    public function all(int $numPaginated = 9, string $orderBy = 'created_at', string $sortBy = 'desc', array $relationship = []);

    //Pagination
    public function paginate(array $data, int $paginate);

    //Delete model instance
    public function delete(string $id);
}
