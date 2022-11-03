<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Transformers\TeamResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\TeamService;
use App\Transformers\CategoryResource;
use Exception;

class CategoryController extends Controller
{
    use ResponseHelper;
    private $cateogryService;

    public function __construct(CategoryService $cateogryService)
    {
        $this->cateogryService = $cateogryService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_ar'=>'required',
            
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->cateogryService->create($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_ar'=>'required',
            
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->cateogryService->update($request->all(),$id);
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function destory(Request $request,$id){
        $data=$this->cateogryService->delete($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function show(Request $request,$id){
        $data=$this->cateogryService->findWhere(['id'=>$id])->first();
        if($data){
            return $this->json(200, true, CategoryResource::make($data), 'Success');
        }
        return $this->error(404, false, 'not found', 'not found');
    }

    public function index(Request $request){
        $data=$this->cateogryService->findAll();
        return $this->json(200, true, CategoryResource::collection($data), 'Success');
    }




}
