<?php

namespace TomatoPHP\LaravelTomato\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class Response
{
    /**
     * @var RedirectResponse
     */
    public RedirectResponse $redirect;
    /**
     * @var Model|null
     */
    public ?Model $record=null;

    /**
     * @return self
     */
    public static function make(): static
    {
        return new self();
    }


    /**
     * @param string|null $errorsArray
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    public static function errors(
        ?string $errorsArray =null,
        int $code=400,
        string $message="Something Went Wrong"
    ): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $errorsArray ?? $message
        ],$code);
    }


    /**
     * @param array|object $data
     * @param string|null $message
     * @param int $code
     * @param array $meta
     * @return JsonResponse
     */
    public static function data(
        array|object $data,
        ?string $message =null,
        int $code=200,
        array $meta=[]
    ):JsonResponse
    {
        $response = [
            'message'=>$message ?? __("Data Retrieved Successfully"),
            'data' => $data,
            'status' => true
        ];

        count($meta) ? $response['meta'] = $meta : null;

        return response()->json($response,$code);
    }


    /**
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public static function success(
        string $message = null,
        int $code=200
    ): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message ?? __("Done !")
        ],$code);
    }


    /**
     * @return JsonResponse
     */
    public static function bannedMessage(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'account_status' => 'banned',
            'errors' => [
                'token' => [__('Account Is Banned')]
            ]
        ], 403);
    }


    /**
     * @return JsonResponse
     */
    public static function emptyToken(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'errors' => [
                'unauthorized'=>[__('You are unauthorized')]
            ]
        ],401);
    }


    /**
     * @return JsonResponse
     */
    public static function emptyTokenHeader(): JsonResponse
    {
        return response()->json([
            'unauthorized'=>[
                __('You are unauthorized')
            ]
        ],400);
    }

    /**
     * @param RedirectResponse $redirect
     * @return $this
     */
    public function redirect(RedirectResponse $redirect): static
    {
        $this->redirect = $redirect;
        return $this;
    }

    /**
     * @param Model $record
     * @return $this
     */
    public function record(Model $record): static
    {
        $this->record = $record;
        return $this;
    }
}
