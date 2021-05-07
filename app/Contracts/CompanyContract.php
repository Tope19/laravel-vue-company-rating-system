<?php
namespace App\Contracts;

use App\Models\Company;

interface CompanyContract
{
    public function getCompanies(int $numPagination = 9, string $orderBy = 'created_at', string $sortBy = 'desc');

    public function rateCompany(Company $company, int $rating);

    public function storeCompany(array $params);

    public function updateCompany(array $params, string $id);

    public function deleteCompany(string $id);
}
