<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\TeamResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\TeamService;
use Exception;

class TeamController extends Controller
{
    use ResponseHelper;
    private $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name_en'=>'required',
            'name_ar'=>'required',
            'position_en'=>'required',
            'position_ar'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->teamService->create($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_ar'=>'required',
            'position_en'=>'required',
            'position_ar'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->teamService->update($request->all(),$id);
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function show(Request $request,$id){
        $data=$this->teamService->findWhere(['id'=>$id])->first();
        if($data){
            return $this->json(200, true, TeamResource::make($data), 'Success');
        }
        return $this->error(404, false, 'not found', 'not found');
    }

    public function index(Request $request){
        $data=$this->teamService->findAll();
        return $this->json(200, true, TeamResource::collection($data), 'Success');
    }
    public function destory(Request $request,$id){
        $data=$this->teamService->delete($id);
        if($data){
            return $this->json(200, true,'Success' , 'Success');
        }
        return $this->error(400, false, 'error', 'error');
    }


}
