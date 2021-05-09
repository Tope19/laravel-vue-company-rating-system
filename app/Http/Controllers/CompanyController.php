<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyContract;
use App\Http\Requests\CompanyRateRequest;
use App\Models\Company;
use App\Transformers\CompanyCollection;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    /**
     * @var CompanyContract
     */
    private $companyRepository;

    /**
     * CompanyController constructor.
     * @param CompanyContract $companyRepository
     */
    public function __construct(CompanyContract $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanies(Request $request){


        if ($request->get('orderBy') && $request->get('sortBy')){

            $companies = $this->companyRepository->getCompanies(6,
                $request->get('orderBy'), $request->get('sortBy')
            );

        }else{

            $companies = $this->companyRepository->getCompanies(6);

        }

        return response()->json($companies);

    }

    /**
     * @param CompanyRateRequest $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function rateCompany(CompanyRateRequest $request, Company $company){

        return response()->json([

            'company' => $this->companyRepository->rateCompany($company, $request['rating'])

        ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApiCompanies(){

        $companies = $this->companyRepository->getCompanies(10);

        return response()->json([

            'success' => true,
            'message' => 'Companies fetched successfully',
            'data' => new CompanyCollection($companies)

        ]);

    }
}


