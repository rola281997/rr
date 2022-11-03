<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\AdminAuthResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\AdminService;
use Exception;

class AdminController extends Controller
{
    use ResponseHelper;
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }

        $data = $this->adminService->login($request->only('email', 'password'));
        
        if ($data) {
           return $this->json(200, true, AdminAuthResource::make($data), 'Success');
        }

        return $this->error(401, false, 'Error_in_Email_or_Password', 'Success');
    }

    public function logout(Request $request)
    {
        try{
            $data = $this->adminService->logout();

            if ($data) {
            return $this->json(200, true,'Success', 'Success');
            }
        }
        catch (Exception $e) {
            return $this->error(400, false, 'Something is wrong', 'Something is wrong');
        }
    }
}
