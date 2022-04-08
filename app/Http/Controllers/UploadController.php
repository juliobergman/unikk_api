<?php

namespace App\Http\Controllers;

use App\Models\Pecc;
use App\Models\Company;
use App\Models\Contact;
use App\Models\UserData;
use App\Models\CompanyData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    protected $maxSize = [
        'width' => '2880',
        'height' => '2880',
    ];

    protected $avsize = [
        'width' => '900',
        'height' => '900',
    ];

    public function useravatar(Request $request)
    {
        
        // Validation
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $file = $request->file('image');
        if(!$file){
            return new JsonResponse(['message' => 'No File'], 200);
        }
        $user_id = $request->user()->id;
        $folder = 'user';

        // Create Directory if not Exists
        if(!file_exists(storage_path('app/public/avatars/'.$folder.'/'.$user_id.'/'))) {
            Storage::makeDirectory('/public/avatars/'.$folder.'/'.$user_id); //creates directory
        }

        // Delete Old Avatar
        $oldpath = UserData::select('profile_pic')->where('user_id', $user_id)->first();
        $deletepath = str_replace('/storage/', '/public/', $oldpath->profile_pic);
        $factory = strstr($deletepath, '/factory/');
        if(!$factory){
            Storage::delete($deletepath);
        };
        // Upload New Avatar
        $original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $random_number = rand(1,5000);
        $hash = hash('md5', $original_filename.time().$random_number);

        $ext = 'jpg';
        $img = Image::make($file->getRealPath());
        $name = $hash.'.'.$ext;
        $path = storage_path('app/public/avatars/'.$folder.'/'.$user_id.'/'.$name);
        $img->fit($this->avsize['width'], $this->avsize['height'], function ($constraint) {
            $constraint->upsize();
        });
        $img->save($path, 60, $ext);
        $newpath = '/storage/avatars/'.$folder.'/'.$user_id.'/'.$name;
        $update = array('profile_pic' => $newpath);
        UserData::where('user_id', $user_id)->update($update);
        // Response
        return new JsonResponse(['message' => 'Success', 'path' => $newpath], 200);

    }
    public function companyavatar(Request $request, Company $company)
    {
                
        // Validation
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $file = $request->file('image');
        if(!$file){
            return new JsonResponse(['message' => 'No File'], 200);
        }
        $company_id = $company->id;
        $folder = 'company';

        // Create Directory if not Exists
        if(!file_exists(storage_path('app/public/avatars/'.$folder.'/'.$company_id.'/'))) {
            Storage::makeDirectory('/public/avatars/'.$folder.'/'.$company_id); //creates directory
        }

        // Delete Old Avatar
        $oldpath = CompanyData::select('logo')->where('company_id', $company_id)->first();
        $deletepath = str_replace('/storage/', '/public/', $oldpath->logo);
        $factory = strstr($deletepath, '/factory/');
        if(!$factory){
            Storage::delete($deletepath);
        };
        // Upload New Avatar
        $original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $random_number = rand(1,5000);
        $hash = hash('md5', $original_filename.time().$random_number);

        $ext = 'jpg';
        $img = Image::make($file->getRealPath());
        $name = $hash.'.'.$ext;
        $path = storage_path('app/public/avatars/'.$folder.'/'.$company_id.'/'.$name);
        $img->fit($this->avsize['width'], $this->avsize['height'], function ($constraint) {
            $constraint->upsize();
        });
        $img->save($path, 60, $ext);
        $newpath = '/storage/avatars/'.$folder.'/'.$company_id.'/'.$name;
        $update = array('logo' => $newpath);
        CompanyData::where('company_id', $company_id)->update($update);
        // Response
        return new JsonResponse(['message' => 'Success', 'path' => $newpath], 200);

    }
    public function contactavatar(Request $request, Contact $contact)
    {
        
        // Validation
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $file = $request->file('image');
        if(!$file){
            return new JsonResponse(['message' => 'No File'], 404);
        }
        $contact_id = $contact->id;
        $folder = 'contact';

        // Create Directory if not Exists
        if(!file_exists(storage_path('app/public/avatars/'.$folder.'/'.$contact_id.'/'))) {
            Storage::makeDirectory('/public/avatars/'.$folder.'/'.$contact_id); //creates directory
        }

        // Delete Old Avatar
        $oldpath = Contact::select('profile_pic')->where('id', $contact_id)->first();
        $deletepath = str_replace('/storage/', '/public/', $oldpath->profile_pic);
        $factory = strstr($deletepath, '/factory/');
        if(!$factory){
            Storage::delete($deletepath);
        };
        // Upload New Avatar
        $original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $random_number = rand(1,5000);
        $hash = hash('md5', $original_filename.time().$random_number);

        $ext = 'jpg';
        $img = Image::make($file->getRealPath());
        $name = $hash.'.'.$ext;
        $path = storage_path('app/public/avatars/'.$folder.'/'.$contact_id.'/'.$name);
        $img->fit($this->avsize['width'], $this->avsize['height'], function ($constraint) {
            $constraint->upsize();
        });
        $img->save($path, 60, $ext);
        $newpath = '/storage/avatars/'.$folder.'/'.$contact_id.'/'.$name;
        $update = array('profile_pic' => $newpath);
        Contact::where('id', $contact_id)->update($update);
        // Response
        return new JsonResponse(['message' => 'Success', 'path' => $newpath], 200);

    }
    public function peccavatar(Request $request, Pecc $pecc)
    {
        
        // Validation
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $file = $request->file('image');
        if(!$file){
            return new JsonResponse(['message' => 'No File'], 404);
        }
        $pecc_id = $pecc->id;
        $folder = 'pecc';

        // Create Directory if not Exists
        if(!file_exists(storage_path('app/public/avatars/'.$folder.'/'.$pecc_id.'/'))) {
            Storage::makeDirectory('/public/avatars/'.$folder.'/'.$pecc_id); //creates directory
        }

        // Delete Old Avatar
        $oldpath = Pecc::select('logo')->where('id', $pecc_id)->first();
        $deletepath = str_replace('/storage/', '/public/', $oldpath->logo);
        $factory = strstr($deletepath, '/factory/');
        if(!$factory){
            Storage::delete($deletepath);
        };
        // Upload New Avatar
        $original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $random_number = rand(1,5000);
        $hash = hash('md5', $original_filename.time().$random_number);

        $ext = 'jpg';
        $img = Image::make($file->getRealPath());
        $name = $hash.'.'.$ext;
        $path = storage_path('app/public/avatars/'.$folder.'/'.$pecc_id.'/'.$name);
        $img->fit($this->avsize['width'], $this->avsize['height'], function ($constraint) {
            $constraint->upsize();
        });
        $img->save($path, 60, $ext);
        $newpath = '/storage/avatars/'.$folder.'/'.$pecc_id.'/'.$name;
        $update = array('logo' => $newpath);
        Pecc::where('id', $pecc_id)->update($update);
        // Response
        return new JsonResponse(['message' => 'Success', 'path' => $newpath], 200);

    }

}
