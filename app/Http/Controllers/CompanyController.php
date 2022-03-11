<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    public $data_select = [
        // Companies
        'companies.id',
        'companies.company_id',
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

    public function index(Request $request, Company $company, $type = 'active')
    {
        
        // Handling Sort
        if($request->sort){$sort = explode('-', $request->sort); } else {$sort = ['id', 'asc']; }
        
        
        
        $cq = Company::query();
        // Where
        $cq->where('companies.company_id', $company->id);
        $cq->where('type', $type);
    
        // Search
        if(!empty($request->search)){
            $searchFields = ['companies.name','company_data.sector','countries.name','countries.region'];
            $cq->where(function($query) use($request, $searchFields){
                $searchWildcard = '%' . $request->search . '%';
                foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
                }
            });
        }

        // Select
        $cq->select($this->data_select);
        // Join
        $cq->join('company_data', 'companies.id', '=', 'company_data.company_id');
        $cq->join('currencies', 'company_data.currency_id', '=', 'currencies.id');
        $cq->join('countries', 'company_data.country', '=', 'countries.iso2');
        // Sort
        $cq->orderBy($sort[0], $sort[1]);

        $companies = $cq->paginate(12);

        $implode_sort = implode('-', $sort);
        $companies->appends(['search' => $request->search]);
        $companies->appends(['sort' => $implode_sort]);

        
        return $companies;
    }

    public function store(Request $request)
    {    
        $this->validator($request->all())->validate();

        // Create Company
        $newCompany = $request->user()->company()->create($request->only(['name','type','company_id']));
        // Create Company Data
        if($newCompany){
            $newCompanyData = $newCompany->companydata()->create($request->only(['company_id','country','currency_id']));
            $newTargetData = $newCompany->companytargetdata()->create($request->only(['company_id']));
            if($newCompanyData && $newTargetData){
                $newMembership = $request->user()->membership()->create([
                    'company_id' => $newCompany->id,
                    'role' => 'admin'
                ]);
                if($newMembership){
                    return new JsonResponse([
                        'message' => 'Company Stored',
                        'company' => $this->show($newCompany),
                        'membership' => $newMembership
                    ],
                        200);
                }
            }
        }

        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function show(Company $company, $type = null)
    {   
        $select = $this->data_select;

        $cq = Company::query();
        // Where
        $cq->where('companies.id', $company->id);
        // Join
        $cq->join('company_data', 'companies.id', '=', 'company_data.company_id');
        $cq->join('currencies', 'company_data.currency_id', '=', 'currencies.id');
        $cq->join('countries', 'company_data.country', '=', 'countries.iso2');
        if($type === 'target'){
            $cq->join('company_target_data', 'companies.id', '=', 'company_target_data.company_id');
            $select = 
            array_merge(
            $this->data_select,
            [
                // Target Data
                'company_target_data.company_ov as target_company_ov',
                'company_target_data.financial_ov as target_financial_ov',
                'company_target_data.milestones as target_milestones',
                'company_target_data.competitors as target_competitors',
                'company_target_data.goals as target_goals',
                'company_target_data.channels as target_channels',
                'company_target_data.challenges as target_challenges',
            ]);
        }
        // Selects
        $cq->select($select);
        // Result
        $company = $cq->first();
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
