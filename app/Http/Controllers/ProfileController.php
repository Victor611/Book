<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        return view ('profile', ['user' => Auth::user()]);
    }
    
    public function update_avatar(Request $request)
    {
        $validator = ProfileController::checkProfile($request);
        if ($validator->fails())
        {
            return redirect('/profile')
                ->withInput()
                ->withErrors($validator);
        }
        
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() .'.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatars/'.$filename));
            
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', ['user' => Auth::user()]);
    }
    
    public function checkProfile(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'avatar' => 'image|mimes:jpeg,bmp,png|max:2000',
        ]);        
    }
}
