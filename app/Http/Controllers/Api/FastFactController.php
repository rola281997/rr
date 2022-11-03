<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\FastFactResource;
use App\Transformers\AboutUsResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\FastFactService;
use Exception;

class FastFactController extends Controller
{
    use ResponseHelper;
    private $fastFactService;

    public function __construct(FastFactService $fastFactService)
    {
        $this->fastFactService = $fastFactService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'description_ar' => 'required',
            'description_en' => 'required',
            'happy_clients' => 'required',
            'employees' => 'required',
            'expert_developers' =>'required',
            'successful_projects' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->fastFactService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }


    public function updateAboutUs(Request $request){
        $validator = Validator::make($request->all(), [
            'about_us_description_ar' => 'required',
            'about_us_description_en' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->fastFactService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getFastFactsContact(Request $request){
        $data=$this->fastFactService->findWhere(['id'=>1])->first();
        return $this->json(200, true, FastFactResource::make($data), 'Success');
    }

    public function getAboutUsContact(Request $request){
        $data=$this->fastFactService->findWhere(['id'=>1])->first();
        return $this->json(200, true, AboutUsResource::make($data), 'Success');
    }

    public function uploads_fast_facts_video_en(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'video_en' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
            }
            $this->fastFactService->uploadVideo('video_en',$request->video_en,'videos_en');
            return $this->json(200,true,'success', 'success');
        }
        catch(Exception $exception){
            return $this->json(400,false,'please choose video with less size', 'please choose video with less size');
        }

    }

    public function uploads_fast_facts_video_ar(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'video_ar' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
            }
            $this->fastFactService->uploadVideo('video_ar',$request->video_ar,'videos_ar');
            return $this->json(200,true,'success', 'success');
        }
        catch(Exception $exception){
            return $this->json(400,false,'please choose video with less size', 'please choose video with less size');
        }
    }

}
