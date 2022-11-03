<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\TeamBriefResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\TeamBriefService;


class TeamBriefController extends Controller
{
    use ResponseHelper;
    private $teamBriefService;

    public function __construct(TeamBriefService $teamBriefService)
    {
        $this->teamBriefService = $teamBriefService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'brief_ar' => 'required',
            'brief_en'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->teamBriefService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getTeamBriefContent(Request $request){
        $data=$this->teamBriefService->findWhere(['id'=>1])->first();
        return $this->json(200, true, TeamBriefResource::make($data), 'Success');
    }

}
