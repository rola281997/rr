<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\ClientResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ClientService;
use Exception;

class ClientController extends Controller
{
    use ResponseHelper;
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name_en'=>'required',
            'name_ar'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->clientService->create($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_ar'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->clientService->update($request->all(),$id);
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function show(Request $request,$id){
        $data=$this->clientService->findWhere(['id'=>$id])->first();
        if($data){
            return $this->json(200, true, ClientResource::make($data), 'Success');
        }
        return $this->error(404, false, 'not found', 'not found');
    }

    public function index(Request $request){
        $data=$this->clientService->findAll();
        return $this->json(200, true, ClientResource::collection($data), 'Success');
    }
    public function destory(Request $request,$id){
        $data=$this->clientService->delete($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }


}
