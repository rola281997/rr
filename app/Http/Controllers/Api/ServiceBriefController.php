<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\ServiceBriefResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ServiceBriefService;


class ServiceBriefController extends Controller
{
    use ResponseHelper;
    private $serviceBriefService;

    public function __construct(ServiceBriefService $serviceBriefService)
    {
        $this->serviceBriefService = $serviceBriefService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'brief_ar' => 'required',
            'brief_en'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->serviceBriefService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getServiceBriefContent(Request $request){
        $data=$this->serviceBriefService->findWhere(['id'=>1])->first();
        return $this->json(200, true, ServiceBriefResource::make($data), 'Success');
    }

}
