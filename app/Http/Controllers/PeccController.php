<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Pecc;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PeccController extends Controller
{

    public $data_select = [
        // Peccs
        'peccs.id',
        'peccs.company_id',
        'peccs.user_id',
        'peccs.name',
        'peccs.type',
        'peccs.region',
        'peccs.based',
        'peccs.main_countries',
        'peccs.main_cities',
        'peccs.sector',
        'peccs.geo_focus',
        'peccs.logo',
        'peccs.notes',
        'peccs.deleted_at',
        'peccs.created_at',
        'peccs.updated_at',
        // Country
        'countries.name as country_name',
        'countries.region as country_region',
        'countries.subregion as country_subregion',
        'countries.latitude as country_latitude',
        'countries.longitude as country_longitude',
    ];
    
    public function index($id)
    {
        $peccs = Pecc::query();
        // Where
        $peccs->where('company_id', $id);
        // Selects
        $peccs->select($this->data_select);
        // Join
        $peccs->leftJoin('countries', 'peccs.based', '=', 'countries.iso2');
        // $peccs->limit(5);
        $peccs->orderBy('id','desc');
        return $peccs->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => ['required'],
            'name' => ['required'],
        ]);
        
        $pecc = [
            'company_id' => $request->company_id,
            'name' => $request->name,
            'type' => $request->type,
            'region' => $request->region,
            'based' => $request->based,
            'main_countries' => $request->main_countries,
            'main_cities' => $request->main_cities,
            'sector' => $request->sector,
            'geo_focus' => $request->geo_focus,
            'notes' => $request->notes,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // return $pecc;

        $stored = $request->user()->pecc()->create($pecc);
        if($stored){
            return new JsonResponse(['message' => 'New PECC Added', 'pecc' => $stored], 201);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function show(Pecc $pecc)
    {
        $peccs = Pecc::query();
        // Where
        $peccs->where('peccs.id', $pecc->id);
        // Selects
        $peccs->select($this->data_select);
        // Join
        $peccs->leftJoin('countries', 'peccs.based', '=', 'countries.iso2');
        return $peccs->first();
    }

    public function update(Request $request, Pecc $pecc)
    {   
        $update = [
            'name' => $request->name,
            'type' => $request->type,
            'region' => $request->region,
            'based' => $request->based,
            'main_countries' => $request->main_countries,
            'main_cities' => $request->main_cities,
            'sector' => $request->sector,
            'geo_focus' => $request->geo_focus,
            'notes' => $request->notes,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $updated = Pecc::where('id', $pecc->id)->update($update);
        if($updated){
            $peccRet = $this->show($pecc);
            return new JsonResponse(['message' => 'PECC Updated', 'pecc' => $peccRet], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy($id)
    {
        $pecc = Pecc::where('id', $id)->first();
        if(!$pecc){
            return new JsonResponse(['message' => 'No Company has been found.'], 404);
        }
        if(!$pecc->is_owned){
            return new JsonResponse(['message' => 'You dont have permissions to delete this Company.'], 403);
        }
        $deleted = $pecc->delete();
        if($deleted){
            return new JsonResponse(['message' => 'Company Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function trashed(Request $request, Company $company)
    {
        $pecc = Pecc::query();
        $pecc->where('company_id', $company->id);
        $pecc->select($this->data_select);
        $pecc->leftJoin('countries', 'peccs.based', '=', 'countries.iso2');
        $pecc->onlyTrashed();
        return $pecc->get();
    }

    public function restore($id)
    {   
        $pecc = Pecc::where('id', $id)->onlyTrashed()->first();

        if(!$pecc){
            return new JsonResponse(['message' => 'No company has been found.'], 404);
        }
        if(!$pecc->is_owned){
            return new JsonResponse(['message' => 'You dont have permissions to restore this company.'], 403);
        }
        $restored = $pecc->restore();
        if($restored){
            return new JsonResponse(['message' => 'Company Restored'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy_forever(Request $request)
    {
        $pecc = Pecc::withTrashed()
        ->where('id', $request->id)
        ->first();

        $deleted = $pecc->forceDelete();
        if($deleted){
            return new JsonResponse(['message' => 'Company Permanently Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }
}