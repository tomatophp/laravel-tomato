<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\LaravelTomato\Services\Response;

trait HasValidator
{
    /**
     * @param array $validation
     * @param Request $request
     * @param string $validationError
     * @param bool $api
     * @return Application|ResponseFactory|JsonResponse|\Illuminate\Http\Response|bool
     */
    public function hasValidator(array $validation, Request &$request, string $validationError, bool $api=false): bool|Application|ResponseFactory|JsonResponse|\Illuminate\Http\Response
    {
        $isAPIRequest = $this->checkAPIRequest();
        if(count($validation)){
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                if($api  && (!$isAPIRequest)){
                    return Response::errors(
                        errorsArray: $validator->errors(),
                        message: $validationError
                    );
                }
                else {
                    Toast::danger($validationError)->autoDismiss(2);
                    $validator->validate();
                }
            }
        }

        return true;
    }
}
