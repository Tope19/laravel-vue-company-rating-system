<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    private $companyRepository;

    /**
     * CompanyController constructor.
     * @param CompanyContract $companyRepository
     */
    public function __construct(CompanyContract $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function index(){

        return view('admin.company.index');

    }


    /**
     * @param StoreCompanyRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCompanyRequest $request){

        try {

            $params = $request->all();
            return $this->companyRepository->storeCompany($params);

        }catch (\Throwable $exception){

            throw $exception;

        }

    }

    /**
     * @param StoreCompanyRequest $request
     * @param Company $company
     * @return Company|null
     * @throws \Throwable
     */
    public function update(StoreCompanyRequest $request, Company $company){

        try {

            $params = $request->all();
            $this->companyRepository->updateCompany($params, $company->id);
            return $company->fresh();


        }catch (\Throwable $exception){

            throw $exception;

        }

    }

    /**
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Throwable
     */
    public function destroy(Request $request, Company $company){

        try {

            if ($company->hasRating()){

                return response()->json([

                    'message' => 'Company cant be deleted'
                ], 400);

            }

            $this->companyRepository->deleteCompany($company->id);
            return response()->json([

                'message' => 'Company deleted successfully'

            ]);

        }catch (\Throwable $exception){

            throw $exception;

        }

    }
}
