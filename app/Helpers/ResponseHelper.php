<?php
namespace App\Helpers;

use Response;
use Validator;

trait ResponseHelper
{

    /**
     * @var Request
     */
    protected $request;


    /**
     * @var array
     */
    protected $body;

    /**
     * Set response data.
     *
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->body['data'] = $data;
        return $this;
    }

    public function setStatus($status)
    {
        $this->body['status'] = $status;
        return $this;
    }

    public function setCode($code)
    {
        $this->body['code'] = $code;
        return $this;
    }

    public function setMessage($message)
    {
        $this->body['message'] = $message;
        return $this;
    }

    public function setError($error)
    {
        $this->body['errors'] = $error;
        return $this;
    }

    public function json($code, $status, $data, $message)
    {
        $this->setCode($code);
        $this->setStatus($status);
        $this->setData($data);
        $this->setMessage($message);
        return response()->json($this->body, $code);
    }

    public function error($code, $status, $errors, $message = '')
    {
        $this->setCode($code);
        $this->setStatus($status);
        $this->setError($errors);
        $this->setMessage($message);
         return response()->json($this->body, $code);
    }

    public function reFormatValidationErr($validation_obj)
    {
        $response = [];
        $arr_errors = $validation_obj->toArray();
        if (count($arr_errors) > 0) {
            foreach ($arr_errors as $errs) {
                foreach ($errs as $one_err_msg) {
                    $response[] = $one_err_msg;
                }
            }
        }
        return $response[0];
    }
}
