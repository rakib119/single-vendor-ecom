<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Monolog\Handler\IFTTTHandler;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.index');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'nullable|digits:11|numeric',
        ]);
        $user  = User::find(auth()->id());
        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ]);
        return  back()->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|alpha_num|min:9',
            'password_confirmation' => 'required',
        ]);
        $request->validate([
            'password' => 'confirmed',
        ]);
        if ($request->current_password == $request->password) {
            return back()->withErrors(['current_password' => "Current password and New Password can't be same!"]);
        }
        // check password Matched or not
        $value = $request->current_password;
        $hashedValue = auth()->user()->password;
        if (!Hash::check($value, $hashedValue)) {
            return back()->withErrors(['current_password' => "Your Current password is wrong!"]);
        }
        User::find(auth()->id())->update(
            ['password' => bcrypt($request->password)]
        );
        return  back()->with('success', 'password changed successfully');
    }
    public function changeProfilePicture(Request $request)
    {

        $request->validate(
            ['profile_photo' => 'required|mimes:jpg,jpeg']
        );
        if ($request->hasFile('profile_photo')) {
            if (auth()->user()->profile_photo != 'default_profile.jpg') {
                unlink(base_path("public/dashboard/uploads/profile" . "/" . auth()->user()->profile_photo));
            }
            // get file extention
            $photo_name = Str::random(8) . auth()->id() . "." . $request->file('profile_photo')->getClientOriginalExtension();
            $save_link = base_path("public/dashboard/uploads/profile/$photo_name");
            Image::make($request->file('profile_photo'))->resize(300, 300)->save($save_link);
            User::find(auth()->id())->update([
                "profile_photo" => $photo_name
            ]);
            return back()->with("success", "Profile photo successfully updated");
        }
    }
    public function changeCoverPhoto(Request $request)
    {
        $request->validate([
            'cover_photo' => 'required|mimes:jpg,jpeg'
        ]);
        if ($request->hasFile('cover_photo')) {
            if (auth()->user()->cover_photo != 'default_cover_photo.jpg') {
                unlink(base_path("public/dashboard/uploads/cover_photo" . "/" . auth()->user()->cover_photo));
            }
            // name Creation
            $cover_photo_name = Str::random(7) . auth()->id() . "." . $request->file('cover_photo')->getClientOriginalExtension();
            $upload_location = base_path("public/dashboard/uploads/cover_photo/$cover_photo_name");
            // upload cover photo
            Image::make($request->file('cover_photo'))->save($upload_location);
            // update database
            User::find(auth()->id())->update([
                'cover_photo' => $cover_photo_name
            ]);
            return back()->with("success", "Profile photo successfully updated");
        }
    }
}
