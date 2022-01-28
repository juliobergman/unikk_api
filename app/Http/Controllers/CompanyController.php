<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_id' => ['required', 'int', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:2'],
            'currency_id' => ['required', 'int', 'max:255'],
            'type' => ['required', 'string'],
        ]);
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {    
        $this->validator($request->all())->validate();
        $newCompany = $request->user()->company()->create($request->only(['name','type','company_id']));

        return $newCompany;
    }


    public function storeasd(Request $request)
    {
        $this->validator($request->all())->validate();
        $newCompany = $request->user()->company()->create($request->only(['name','currency_id','type','company_id']));
        // event(new companyCreated($newCompany, $request->country));
        // $membership = Membership::where('company_id', $newCompany->id)->where('user_id', $newCompany->user_id)->first();
        // return new JsonResponse(['company' => $newCompany, 'membership' => $membership], 201);
    }

    public function show(Company $company)
    {
        $data_select = [
            // Companies
            'companies.id',
            'companies.name',
            'companies.type',
            // CompanyData
            'company_data.address',
            'company_data.city',
            'company_data.sector',
            'company_data.country',
            'company_data.currency_id',
            'company_data.phone',
            'company_data.email',
            'company_data.website',
            'company_data.info',
            'company_data.logo',
            'company_data.shares',
            'company_data.taxrate',
            // Currency
            'currencies.name as currency_name',
            'currencies.symbol as currency_symbol',
            'currencies.code as currency_code',
            // Country
            'countries.name as country_name',
            'countries.region as country_region',
            'countries.subregion as country_subregion',
            'countries.latitude as country_latitude',
            'countries.longitude as country_longitude',
        ];

        $cq = Company::query();
        // Where
        $cq->where('companies.id', $company->id);
        // Selects
        $cq->select($data_select);
        // Join
        $cq->join('company_data', 'companies.id', '=', 'company_data.company_id');
        $cq->join('currencies', 'company_data.currency_id', '=', 'currencies.id');
        $cq->join('countries', 'company_data.country', '=', 'countries.iso2');
        $company = $cq->first();

        // $mq = Membership::query();
        // $mq->where('user_id', $user->id);
        // $memberships = $mq->get();

        return $company;
    }

    public function update(Request $request, Company $company)
    {   
        $request->validate([
            'name' => ['required'],
            'currency_id' => ['required'],
            'country' => ['required'],
        ]);
        
        $update = [
            'company' => [
                'name' => $request->name,
            ],
            'companydata' => [
                'currency_id' => $request->currency_id,
                'shares' => $request->shares ? $request->shares : 100,
                'taxrate' => $request->taxrate ? $request->taxrate : 0,
                'address' => $request->address,
                'city' => $request->city,
                'sector' => $request->sector,
                'country' => $request->country,
                'phone' => $request->phone,
                'email' => $request->email,
                'website' => $request->website,
                'info' => $request->info,
                'logo' => $request->logo,
            ],
        ];

        $updated = Company::where('id', $company->id)->update($update['company']);

        if($updated){
            $dataupdated = CompanyData::where('company_id', $company->id)->update($update['companydata']);
            if ($dataupdated) {

                $comp = $this->show($company);

                return new JsonResponse(['message' => 'Company Successfully Updated', 'company' => $comp], 200);
            }
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);

        
    }

    public function destroy(Company $company)
    {
        //
    }
}
