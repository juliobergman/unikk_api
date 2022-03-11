<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    
    
    public $data_select = [
        // Membership
        'memberships.id',
        'memberships.user_id',
        'memberships.company_id',
        'memberships.job_title',
        'memberships.role',
        'memberships.selected',
        // Company
        'companies.name as company_name',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();


        // Memberships
        $memberships = collect($this->user($request));
        $current_membership = $memberships->where('selected', true)->first();
        if(!$current_membership){
            $current_membership = $memberships->first();
        }
        $company_id = $current_membership->company_id;

        // return $company_id;

        // Handling Sort
        if($request->sort){$sort = explode('-', $request->sort); } else {$sort = ['id', 'asc']; }

        $wg = Membership::query();
        // Where
        $wg->where('memberships.user_id', '!=',$user->id);
        $wg->where('memberships.company_id', $company_id);


        // Search
        if(!empty($request->search)){
            $searchFields = ['users.name','memberships.job_title','countries.name','countries.region'];
            $wg->where(function($query) use($request, $searchFields){
                $searchWildcard = '%' . $request->search . '%';
                foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
                }
            });
        }

        $data_select = (new UserController)->data_select;

        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'memberships.job_title',
            'memberships.role'
        ]);

        $wg->select($user_select);
        // Join
        $wg->join('users', 'memberships.user_id', '=', 'users.id');
        $wg->join('user_data', 'users.id', '=', 'user_data.user_id');
        $wg->join('countries', 'user_data.country', '=', 'countries.iso2');
        // Sort
        $wg->orderBy($sort[0], $sort[1]);

        $workgroup = $wg->paginate(12);
        
        $implode_sort = implode('-', $sort);
        $workgroup->appends(['search' => $request->search]);
        $workgroup->appends(['sort' => $implode_sort]);

        return $workgroup;

    }

    public function search_new(Request $request)
    {
        $user = $request->user();

        // Memberships
        $memberships = collect($this->user($request));
        $current_membership = $memberships->where('selected', true)->first();
        if(!$current_membership){
            $current_membership = $memberships->first();
        }
        $company_id = $current_membership->company_id;

        $wg = Membership::query();
        // Where
        $wg->where('memberships.user_id', '!=', $user->id);
        $wg->where('memberships.company_id', '!=', $company_id);

        // Search
        if(!empty($request->search)){
            $searchFields = ['users.name','memberships.job_title','countries.name','countries.region'];
            $wg->where(function($query) use($request, $searchFields){
                $searchWildcard = '%' . $request->search . '%';
                foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
                }
            });
        }

        $data_select = (new UserController)->data_select;

        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'memberships.job_title',
            'memberships.role'
        ]);

        $wg->select($user_select);
        // Join
        $wg->join('users', 'memberships.user_id', '=', 'users.id');
        $wg->join('user_data', 'users.id', '=', 'user_data.user_id');
        $wg->join('countries', 'user_data.country', '=', 'countries.iso2');

        // Limit Results
        // $wg->limit(5);

        $workgroup = $wg->get();
        return $workgroup;

    }

    public function user(Request $request)
    {
        $user = $request->user();
        
        $mq = Membership::query();
        // Where
        $mq->where('memberships.user_id', $user->id);
        $mq->where('companies.type', 'active');
        // Selects
        $mq->select($this->data_select);
        // Join
        $mq->join('companies', 'memberships.company_id', '=', 'companies.id');
        // Order
        $memberships = $mq->get();
        return $memberships;
    }

    public function set(Membership $membership)
    {
        $user = Auth::user();
        $memberships = Membership::where('user_id', $user->id)->update(['selected' => false]);
        if($memberships){
            $set_membership = Membership::where('id', $membership->id)->update(['selected' => true]);
            if ($set_membership) {
                $ret_membership = $this->show($membership);
                return new JsonResponse(['message' => 'Membership Successfully set', 'membership' => $ret_membership], 200);
            }
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'id' => 'required',
            'company_id' => 'required',
            'job_title' => 'required',
        ]);
        
        $create = [
            'user_id' => $request->id,
            'company_id' => $request->company_id,
            'job_title' => $request->job_title,
            'role' => 'user',
        ];

        $membership = Membership::create($create);

        return new JsonResponse(['message' => 'Membership Successfully Created', 'membership' => $membership], 200);

        // $stored = Membership;
        // if($memberships){
        //     $set_membership = Membership::where('id', $membership->id)->update(['selected' => true]);
        //     if ($set_membership) {
        //         $ret_membership = $this->show($membership);
        //         return new JsonResponse(['message' => 'Membership Successfully set', 'membership' => $ret_membership], 200);
        //     }
        // }
        // return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
       
        $mq = Membership::query();
        // Where
        $mq->where('memberships.id', $membership->id);
        // Selects
        $mq->select($this->data_select);
        // Join
        $mq->join('companies', 'memberships.company_id', '=', 'companies.id');
        
        return $mq->first();
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
        $request->validate([
            'job_title' => ['required'],
            'role' => ['required'],
        ]);

        $update = [
            'job_title' => $request->job_title,
            'role' => $request->role,
        ];

        $updated = Membership::where('id', $membership->id)->update($update);

        if($updated){
            $rmembership = Membership::where('id', $membership->id)->first();
            return new JsonResponse(['message' => 'Membership Successfully Updated', 'membership' => $rmembership], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        
        $deleted = $membership->delete();
        if($deleted){
            $memberships_count = Membership::where('user_id', $membership->user_id)->count();
            if($memberships_count < 1){
                $deleted_user = (new UserController)->destroy(User::where('id', $membership->user_id)->first());
            }


            return new JsonResponse(['message' => 'Membership Successfully Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }
}
