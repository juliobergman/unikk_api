<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{

    public function index(Request $request, $id)
    {
        $contacts = Contact::query()
                    ->where('user_id', $request->user()->id)
                    ->orWhere('public', $id);
        return $contacts->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'public' => ['exists:companies,id'],
            'name' => ['required'],
            'company' => [],
            'email' => ['email'],
            'phone' => [],
            'address' => [],
            'notes' => [],
        ]);

        $contact = [
            'public' => $request->public,
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'profile_pic' => '/storage/factory/avatar/misc/avatar-user.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $stored = $request->user()->contact()->create($contact);
        if($stored){
            return new JsonResponse(['message' => 'New Contact Added', 'contact' => $contact], 201);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function show(Request $request, Contact $contact)
    { 
        $memberships = Membership::where('user_id', $request->user()->id)
        ->where('company_id', $contact->public)
        ->count();

        if(!$memberships){
            return new JsonResponse(['message' => 'No Contact has been found.'], 404);
        }
        if(!$contact->is_public){
            return new JsonResponse(['message' => 'No Contact has been found.'], 404);
        }
        if($contact->is_public || $contact->is_owned){
            return $contact;
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function update(Request $request, Contact $contact)
    {
        if(!$contact->is_owned){
            return new JsonResponse(['message' => 'You dont have permissions to edit this contact.'], 403);
        }

        $request->validate([
            'public' => ['exists:companies,id'],
            'name' => ['required'],
            'company' => [],
            'email' => ['email'],
            'phone' => [],
            'address' => [],
            'notes' => [],
        ]);

        $update = [
            'public' => $request->public,
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'profile_pic' => '/storage/factory/avatar/misc/avatar-user.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $updated = Contact::where('id', $contact->id)->update($update);
        if($updated){
            return new JsonResponse(['message' => 'Contact Updated', 'contact' => $update], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy($id)
    {   
        $contact = Contact::where('id', $id)->first();
        if(!$contact){
            return new JsonResponse(['message' => 'No Contact has been found.'], 404);
        }
        if(!$contact->is_owned){
            return new JsonResponse(['message' => 'You dont have permissions to delete this contact.'], 403);
        }

        $deleted = $contact->delete();
        if($deleted){
            return new JsonResponse(['message' => 'Contact Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function trashed(Request $request)
    {
        $user = $request->user();
        $contacts = Contact::query();
        $contacts->where('user_id', $user->id);
        $contacts->onlyTrashed();
        return $contacts->get();
    }

    public function restore($id)
    {   
        $contact = Contact::where('id', $id)->onlyTrashed()->first();

        if(!$contact){
            return new JsonResponse(['message' => 'No Contact has been found.'], 404);
        }
        if(!$contact->is_owned){
            return new JsonResponse(['message' => 'You dont have permissions to restore this contact.'], 403);
        }

        $restored = $contact->restore();
        if($restored){
            return new JsonResponse(['message' => 'Contact Restored'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }
}