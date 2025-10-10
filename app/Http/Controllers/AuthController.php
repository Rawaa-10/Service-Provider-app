<?php

namespace App\Http\Controllers;

use App\Enums\RoleUserEnum;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Global\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function loginView(){
        return view("auth.login");
    }

    public function login(LoginRequest $request){
        // $attr = $request->validated();
        // $roles = array_map(fn($role) => $role->value, RoleUserEnum::cases());
        // $user = $this->authService->login($attr, $roles);
        // // $user = $this->authService->login($attr, RoleUserEnum::);
        // Auth::login($user);
        // return redirect()->route('home');
        
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email or Password is not correct'],
            ]);
        }
        Auth::login($user);
        return redirect()->to($this->redirectUserByRole($user));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    private function redirectUserByRole(User $user): string
    {
        return match ($user->role) {
            RoleUserEnum::Admin->value => route('home'),
            RoleUserEnum::Client->value, 
            RoleUserEnum::Provider->value => route('services.index'),
            default => '/',
        };
    }

    // protected $authService;
    // public function __construct(AuthService $authService){
    //     $this->authService = $authService;
    // }

    // public function loginView(Request $request){
    //     return view("auth.login");
    // }

    // public function login(LoginRequest $request){
    //     $attr = $request->validated();
    //     $user = $this->authService->login($attr, RoleUserEnum::Admin);
    //     return view("admin.dashboard", compact("user"));
    // }

    // public function profile(){
    //     return view("");
    // }

    // public function dashboard(){
    //     return view("admin.dashboard");
    // }
}
