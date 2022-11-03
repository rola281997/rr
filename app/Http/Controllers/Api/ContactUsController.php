<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\ContactUsResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ContactUsService;


class ContactUsController extends Controller
{
    use ResponseHelper;
    private $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'address_ar' => 'required',
            'address_en'=>'required',
            'phone'=>'required',
            'whatsapp_phone'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->contactUsService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getContactUsContent(Request $request){
        $data=$this->contactUsService->findWhere(['id'=>1])->first();
        return $this->json(200, true, ContactUsResource::make($data), 'Success');
    }

}
