<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller {

    protected function createNewToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }

    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $existCustomer = Customer::where('google_id', $user->id)->first();
            $token = null;
            if ($existCustomer != null) {
                $token = Auth::login($existCustomer);
            } else {
                $newCustomer = new Customer();
                $newCustomer->name = $user->name;
                $newCustomer->email = $user->email;
                $newCustomer->google_id = $user->id;
                $newCustomer->password = bcrypt('123456789');
                $newCustomer->save();
                $token = Auth::login($newCustomer);
            }
            return $this->createNewToken($token);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
