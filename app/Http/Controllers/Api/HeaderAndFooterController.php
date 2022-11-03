<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Transformers\HeaderAndFooterResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\HeaderAndFooterService;
use Exception;

class HeaderAndFooterController extends Controller
{
    use ResponseHelper;
    private $headerAndFooterService;

    public function __construct(HeaderAndFooterService $headerAndFooterService)
    {
        $this->headerAndFooterService = $headerAndFooterService;
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'title_ar' => 'required',
            'title_en'=>'required',
            'description_ar'=>'required',
            "description_en"=>'required'
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $data=$this->headerAndFooterService->update($request->all());
        if($data){
            return $this->json(200,true,'success', 'success');
        }
        return $this->error(400, false, 'error', 'error');
    }

    public function getHeaderContent(Request $request){
        $data=$this->headerAndFooterService->findWhere(['id'=>1])->first();
        return $this->json(200, true, HeaderAndFooterResource::make($data), 'Success');
    }

    public function uploadLogo(Request $request){
        $validator = Validator::make($request->all(), [
            'logo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error(400, false, $this->reFormatValidationErr($validator->errors()), 'Validation Error');
        }
        $requests = $request->all();
        $header_and_footer=$this->headerAndFooterService->uploadImage($requests['logo']);
        return $this->json(200, true, $header_and_footer->logoFullPath, 'Success');
    }
}
