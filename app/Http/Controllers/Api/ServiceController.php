<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\ServiceResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ServiceService;
use Exception;

class ServiceController extends Controller
{
    use ResponseHelper;
    private $clientService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'icon'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->serviceService->create($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
           'description_ar'=>'required',
            'description_en'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->serviceService->update($request->all(),$id);
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function show(Request $request,$id){
        $data=$this->serviceService->findWhere(['id'=>$id])->first();
        if($data){
            return $this->json(200, true, ServiceResource::make($data), 'Success');
        }
        return $this->error(404, false, 'not found', 'not found');
    }

    public function index(Request $request){
        $data=$this->serviceService->findAll();
        return $this->json(200, true, ServiceResource::collection($data), 'Success');
    }
    public function destory(Request $request,$id){
        $data=$this->serviceService->delete($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }


}
