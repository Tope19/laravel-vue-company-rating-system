<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Tests\TestCase;

class CompanyUserTest extends TestCase
{

    /**
     * Function to reset DB
     */
    public function resetDB(){

        $this->artisan("migrate:fresh");
        $this->artisan("db:seed");

    }

    /**
     * Function to log user in
     * @param $email
     */
    public function loginUser($email)
    {
        $user = User::where('email', $email)->first();
        auth()->login($user);
    }

    /**
     * GET /companies
     * Success test for fetching companies
     */
    public function testSuccessForFetchingCompanies(){

        $this->resetDB();
        $this->json('GET', '/companies')
            ->assertStatus(200)
            ->assertJson([
                'current_page' => 1,
            ]);

    }


    /**
     * GET /api/companies
     * Success test for fetching companies for API (Include total_ratings)
     */
    public function testSuccessForFetchingCompaniesForAPI(){

        $this->json('GET', '/api/companies')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Companies fetched successfully'
            ]);

    }

    /**
     * POST /company/{company}/rate
     * Failure test when un authenticated user rate a company
     */
    public function testForFailureWhenUnauthenticatedUserRateACompany(){

        $this->resetDB();

        $company = Company::first();
        $rating = 3;
        $data = [

            'rating' => $rating,

        ];

        $this->json('POST', '/company/'. $company->id .'/rate', $data, ['Accept' => 'application/json'])
            ->assertStatus(401);

    }

    /**
     * POST /company/{company}/rate
     * Success test when authenticated user rate a company
     * Success test for asserting the value AVG RATINGS and TOTAL VOTES when two users rated a company
     */
    public function testForSuccessWhenRatingCompany(){

        $this->resetDB();
        $this->loginUser('john@gmail.com');

        $company = Company::first();
        $rating1 = 3;
        $data = [
            'rating' => $rating1,
        ];
        $this->json('POST', '/company/'. $company->id .'/rate', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "company" => [
                    "has_rating" => true,
                    "is_rated" => true,
                    "avg_rating" => $rating1,
                ]
            ]);

        $this->assertEquals($company->fresh()->totalVotes(), $rating1);

        $this->loginUser('user@user.com');

        $rating2 = 5;
        $data = [
            'rating' => $rating2,
        ];
        $this->json('POST', '/company/'. $company->id .'/rate', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "company" => [
                    "has_rating" => true,
                    "is_rated" => true,
                    "avg_rating" => ($rating2 + $rating1) / 2,
                ]
            ]);

        $this->assertEquals($company->fresh()->totalVotes(), $rating1 + $rating2);

    }

    /**
     * POST /company/{company}/rate
     * Failure test when a user rates a company that has already been rated
     */
    public function testForFailureWhenRatingCompanyThatHasBeenRatedByUser(){

        $this->loginUser('user@user.com');

        $company = Company::first();

        $data = [
            'rating' => 3,
        ];

        $this->json('POST', '/company/'. $company->id .'/rate', $data, ['Accept' => 'application/json'])
            ->assertStatus(500);

    }

    /** --------------------- ADMIN ------------------- */

    /**
     * POST /admin/companies
     * Success test when saving company with an authenticated admin user
     */
    public function testForSuccessWhenSavingCompanyWithAdminUser(){

//        Login with admin credentials
        $this->loginUser('topeolotu75@gmail.com');

        $data = [

            'name' => 'Xsotechs',
            'phone' => '235902343d45',
            'email' => 'info@xsotechs.com',
            'website' => 'https://www.xsotechs.com',

        ];

        $this->json('POST', '/admin/companies', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'website' => $data['website'],
            ]);

    }

    /**
     * POST /admin/companies
     * Failure test when saving company with an un authenticated admin user
     */
    public function testForFailureWhenSavingCompanyWithUnAuthenticatedUser(){

        $data = [

            'name' => 'Wusob',
            'phone' => '235902343d45',
            'email' => 'info@wusob.com',
            'website' => 'https://www.wusobtech.com',

        ];

        $this->json('POST', '/admin/companies', $data, ['Accept' => 'application/json'])
            ->assertStatus(302);

    }

    /**
     * POST /admin/companies
     * Failure test when saving company without all the required fields
     */
    public function testForFailureWhenSavingCompanyWithoutAllTheRequiredFields(){

        $this->loginUser('topeolotu75@gmail.com');

        $data = [

            'name' => 'New Company',
            'phone' => '235902343d45',

        ];

        $this->json('POST', '/admin/companies', $data, ['Accept' => 'application/json'])
            ->assertStatus(422);

    }

    /**
     * PUT /admin/companies/{company}
     * Success test when updating a company
     */
    public function testForSuccessWhenUpdatingCompanyWithAdminUser(){

        $this->loginUser('topeolotu75@gmail.com');

        $data = [

            'name' => 'Updated Company',
            'phone' => '23590234333',
            'email' => 'updated@gmail.com',
            'website' => 'https://www.intellicore.co.uk',

        ];

        $company = Company::first();

        $this->json('PUT', '/admin/companies/' . $company->id, $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'website' => $data['website'],
            ]);

    }

    /**
     * DELETE /admin/companies/{company}
     * Success test for deleting a company without a rating
     */
    public function testForSuccessWhenDeletingCompanyWithAdminUser(){

        $this->loginUser('topeolotu75@gmail.com');

        $company = Company::latest()->first();

        $this->json('DELETE', '/admin/companies/' . $company->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Company deleted successfully',
            ]);

    }

    /**
     * DELETE /admin/companies/{company}
     * failure test when updating a company
     */
    public function testFailureWhenDeletingCompanyThatHasRating(){

        $this->loginUser('topeolotu75@gmail.com');

        $company = Company::first();

        $this->json('DELETE', '/admin/companies/' . $company->id)
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Company cant be deleted',
            ]);

    }



}
