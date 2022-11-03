<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\ClientBriefResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ClientBriefService;


class ClientBriefController extends Controller
{
    use ResponseHelper;
    private $clientBriefService;

    public function __construct(ClientBriefService $clientBriefService)
    {
        $this->clientBriefService = $clientBriefService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'brief_ar' => 'required',
            'brief_en'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->clientBriefService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getClientBriefContent(Request $request){
        $data=$this->clientBriefService->findWhere(['id'=>1])->first();
        return $this->json(200, true, ClientBriefResource::make($data), 'Success');
    }

}
