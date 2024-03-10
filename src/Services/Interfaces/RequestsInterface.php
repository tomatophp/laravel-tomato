<?php

namespace TomatoPHP\LaravelTomato\Services\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\LaravelTomato\Services\Response;

interface RequestsInterface
{
    /**
     * @param Request $request
     * @param string $model
     * @param string|null $view
     * @param mixed|null $table
     * @param array $data
     * @param bool|null $api
     * @param string|null $resource
     * @param Builder|null $query
     * @param array $filters
     * @return View|JsonResponse
     */
    public function index(
        Request $request,
        string $model,
        ?string $view=null,
        mixed $table=null,
        array $data=[],
        ?bool $api =true,
        ?string $resource=null,
        ?Builder $query=null,
        array $filters = []
    ): View| JsonResponse;

    /**
     * @param Request $request
     * @param string $model
     * @param array $data
     * @param bool|int $paginate
     * @param Builder|null $query
     * @param array $filters
     * @return JsonResponse
     */
    public function json(
        Request $request,
        string $model,
        array $data=[],
        bool|int $paginate=false,
        ?Builder $query=null,
        array $filters = []
    ): JsonResponse;

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public function create(
        string $view,
        array $data=[]
    ): View;

    /**
     * @param Model $model
     * @param string $view
     * @param array $data
     * @param bool $hasMedia
     * @param array $collection
     * @param array $attach
     * @param bool|null $api
     * @param string|null $resource
     * @param Builder|null $query
     * @return View|JsonResponse
     */
    public function get(
        Model $model,
        string $view,
        array $data=[],
        bool $hasMedia=false,
        array $collection=[],
        array $attach = [],
        ?bool $api=true,
        ?string $resource=null,
        ?Builder $query=null,
    ): View|JsonResponse;

    /**
     * @param Request $request
     * @param string $model
     * @param array|null $validation
     * @param string|null $message
     * @param string|null $validationError
     * @param string|null $redirect
     * @param bool|null $hasMedia
     * @param array|null $collection
     * @param bool|null $api
     * @return Response|JsonResponse
     */
    public function store(
        Request $request,
        string $model,
        ?array $validation = [],
        ?string $message="Record Created Success",
        ?string $validationError="Validation Error",
        ?string $redirect=null,
        ?bool $hasMedia=false,
        ?array $collection=[],
        ?bool $api=true
    ): Response|JsonResponse;

    /**
     * @param Request $request
     * @param Model $model
     * @param array|null $validation
     * @param string|null $message
     * @param string|null $validationError
     * @param string|null $redirect
     * @param bool|null $hasMedia
     * @param array|null $collection
     * @param bool|null $api
     * @return Response|JsonResponse
     */
    public function update(
        Request $request,
        Model $model,
        ?array $validation = [],
        ?string $message="Record Updated Success",
        ?string $validationError="Validation Error",
        ?string $redirect=null,
        ?bool $hasMedia=false,
        ?array $collection=[],
        ?bool $api=true
    ): Response|JsonResponse;

    /**
     * @param Model $model
     * @param string $message
     * @param string $redirect
     * @param bool|null $hasMedia
     * @param array|null $collection
     * @param bool|null $api
     * @return Response|JsonResponse
     */
    public function destroy(
        Model $model,
        string $message,
        string $redirect,
        ?bool $hasMedia=false,
        ?array $collection=[],
        ?bool $api=true
    ): Response|JsonResponse;
}
