<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Transformers\TeamResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\TeamService;
use App\Transformers\ProjectImageResource;
use App\Transformers\ProjectResource;
use Exception;

class ProjectController extends Controller
{
    use ResponseHelper;
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name_en'=>'required',
            'name_ar'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            "images"=>'required|array',
            "images.*"=>'required',
            "category_id"=>'required|integer|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->projectService->create($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_ar'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            "images"=>'nullable|array',
            
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->projectService->update($request->all(),$id);
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function destory(Request $request,$id){
        $data=$this->projectService->delete($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function destoryProjectImage(Request $request,$id){
        $data=$this->projectService->destoryProjectImage($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }


    public function show(Request $request,$id){
        $data=$this->projectService->findWhere(['id'=>$id])->first();
        if($data){
            return $this->json(200, true, ProjectResource::make($data), 'Success');
        }
        return $this->error(404, false, 'not found', 'not found');
    }

    public function index(Request $request){
        $data=$this->projectService->findAll();
        return $this->json(200, true, ProjectResource::collection($data), 'Success');
    }

    public function getProjectsByCategory(Request $request,$category_id=null){
        if($category_id){
            $projects=$this->projectService->findWhere(['category_id'=>$category_id]);
        }
        else{
            $projects=$this->projectService->findAll();
        }
        return $this->json(200, true, ProjectResource::collection($projects), 'Success');
        
    }

    public function uploadProjectImages(Request $request){
        $validator = Validator::make($request->all(), [
            "images"=>'required|array',
            "images.*"=>'required',
            "project_id"=>'required|integer|exists:projects,id'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->projectService->uploadProjectImages($request->all());
        if($data){
            return $this->json(200,true, ProjectImageResource::collection($data), 'success');
        }
        return $this->error(400, false, 'error', 'error');

    }
   


}
