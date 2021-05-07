<?php


namespace App\Repositories;


use App\Contracts\CompanyContract;
use App\Models\Company;

class CompanyRepository extends BaseRepository implements CompanyContract
{
    public function __construct(Company $model){
        parent::__construct($model);
        $this->model = $model;
    }

    public function getCompanies(int $numPagination = 9, string $orderBy = 'created_at', string $sortBy = 'desc'){
        return $this->all($numPagination, $orderBy, $sortBy);
    }

    public function rateCompany(Company $company, int $rating){
        $company->ratings()->attach(auth()->id(), ['rating' => $rating]);
        $company->fresh();
        $company->update(['avg_rating' => $company->averageRating()]);
        return $company;
    }

    public function storeCompany(array $params){
        return $this->create($params);
    }

    public function updateCompany(array $params, string $id){
        return $this->update($params, $id);
    }

    public function deleteCompany(string $id){
        return $this->delete($id);
    }
}
