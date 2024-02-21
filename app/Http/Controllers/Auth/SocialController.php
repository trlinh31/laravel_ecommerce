<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    private function handleSaveAvatarUser($user)
    {
        $client = new Client();
        $response = $client->get($user->avatar);
        $imageContent = $response->getBody();
        $imageName = uniqid() . '.jpg';
        file_put_contents(public_path('images') . '/' . $imageName, $imageContent);
        return $imageName;
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $user_exist = User::where('google_id', '=', $user->id)->first();
            if ($user_exist) {
                $user_exist->avatar = $this->handleSaveAvatarUser($user);
                $user_exist->save();
                Auth::login($user_exist);
                return redirect('/');
            } else {
                $user_email = User::where('email', '=', $user->email)->first();
                if ($user_email) {
                    $user_email->avatar = $this->handleSaveAvatarUser($user);
                    $user_email->google_id = $user->id;
                    $user_email->save();
                    Auth::login($user_email);
                } else {
                    $user_new = new User();
                    $user_new->name = $user->name;
                    $user_new->email = $user->email;
                    $user_new->avatar = $this->handleSaveAvatarUser($user);
                    $user_new->google_id = $user->id;
                    $user_new->password = Hash::make('1234');
                    $user_new->save();
                    Auth::login($user_new);
                }
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
