<?php

namespace App\Http\Controllers;

use App\Models\Pecc;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PeccController extends Controller
{

    public function index($id)
    {
        return Pecc::where('company_id', $id)->get();
    }

    public function store(Request $request)
    {
        $pecc = [
            'company_id' => $request->company_id,
            'fund' => $request->fund,
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
        return $pecc;   
    }

    public function update(Request $request, Pecc $pecc)
    {   
        $update = [
            'fund' => $request->fund,
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
            return new JsonResponse(['message' => 'PECC Updated', 'pecc' => $update], 200);
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

    public function trashed(Request $request)
    {
        $user = $request->user();
        $pecc = Pecc::query();
        $pecc->where('user_id', $user->id);
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