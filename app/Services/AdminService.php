<?php

namespace App\Services;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repository\AdminRepository;

class AdminService
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login($data)
    {
        $admin = $this->adminRepository->findWhere(['email' => $data['email']])->first();

        if (!$admin) {
            return null;
        }
        // is the passwords match?
        if (!Hash::check($data['password'], $admin->password)) {
            return null;
        }

        $admin->token = $admin->createToken('token')->accessToken;
        return $admin;
    }

    public function logout()
    {
        return Auth::user()->token()->revoke();                  
            
    }


}
