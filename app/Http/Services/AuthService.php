<?php

namespace App\Http\Services;

use Auth;
use Hash;
use App\Models\User;
use App\Enums\RoleUserEnum;
use Laravel\Passport\HasApiTokens;
use App\Exceptions\GeneralException;
use Illuminate\Auth\AuthenticationException;

class AuthService{
    public function register($attrs, $role = RoleUserEnum::Client)
    {
        $attrs['password'] = Hash::make($attrs['password']);
        $user = User::create(array_merge(
            $attrs,
            [
                "role" => $role
            ]
        ));
        $user->access_token = $user->createToken("API Token")->accessToken;
        return [
    'user' => $user,
    'access_token' => $user->access_token ,
];

    }

    public function login($attrs, RoleUserEnum ...$roles){
        $allowedRoles = array_map(fn($r) => $r->value, $roles);

        $user = User::where('email', $attrs['email'])
                ->whereIn('role', $allowedRoles)->first();

        if (!$user || !Hash::check($attrs['password'], $user->password)) {
            throw new AuthenticationException("Invalid credentials");
        }
        Auth::login($user);

        $user->access_token = $user->createToken("API Token")->accessToken;

        return $user;
        }

    public function profile(){
        return Auth::user();
    }
}