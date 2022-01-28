<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'membership/index';
    }

    public function set(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        $data_select = [
            // Membership
            'memberships.id',
            'memberships.user_id',
            'memberships.company_id',
            'memberships.job_title',
            'memberships.role',
            // Company
            'companies.name as company_name',
        ];

        $user = Auth::user();
        $memberships = Membership::where('user_id', $user->id)->update(['default' => null]);
        
        if($memberships){
            $membership = Membership::where('id', $request->id)->update(['default' => 1]);
            if ($membership) {

                $mq = Membership::query();
                // Where
                $mq->where('memberships.id', $request->id);
                // Selects
                $mq->select($data_select);
                // Join
                $mq->join('companies', 'memberships.company_id', '=', 'companies.id');
                $rmembership = $mq->first();

                return new JsonResponse(['message' => 'Membership Successfully set', 'membership' => $rmembership], 200);
            }
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
