<?php

namespace TomatoPHP\LaravelTomato\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Macroable\Macroable;
use TomatoPHP\LaravelTomato\Services\Interfaces\RequestsInterface;
use TomatoPHP\LaravelTomato\Services\Traits\CheckAPIRequest;
use TomatoPHP\LaravelTomato\Services\Traits\HandleMedia;
use TomatoPHP\LaravelTomato\Services\Traits\HasFilters;
use TomatoPHP\LaravelTomato\Services\Traits\HasSorting;
use TomatoPHP\LaravelTomato\Services\Traits\HasToaster;
use TomatoPHP\LaravelTomato\Services\Traits\HasValidator;

class Requests implements RequestsInterface
{
    use CheckAPIRequest;
    use Macroable;
    use HasFilters;
    use HasSorting;
    use HasValidator;
    use HandleMedia;
    use HasToaster;

    private string $sorting = 'desc';

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
    ): View| JsonResponse
    {
        //There Is No Custom Query
        if(!$query){
            $query = $model::query();
        }

        //Has Filters?
        $this->hasFilters($filters, $request, $query);

        //Check Sorting
        $this->hasSorting($this->sorting, $query);

        //Is API Request?
        $isAPIRequest = $this->checkAPIRequest();
        if($isAPIRequest && $api){
            $response = $query->paginate(10);
            if($resource){
                $response = $resource::collection($response);
            }

            return Response::data(
                data: $response,
                meta: $data
            );
        }

        //Is Not API Request And API Not Active
        elseif($isAPIRequest && (!$api)){
            abort(404);
        }

        //Has Spatie Splade Table
        if($table){
            return view($view, array_merge([
                'table' => (new $table($query)),
            ],$data));
        }

        //Return View
        return view($view, $data);
    }

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
    ): JsonResponse
    {
        if(!$query){
            $query = $model::query();
        }

        $this->hasFilters($filters, $request, $query);
        $this->hasSorting($this->sorting, $query);

        if($request->has('search') && !empty($request->get('search'))){
            $query->where($request->get('searchBy')?: 'name','LIKE', '%'.$request->get('search').'%');
        }

        if($request->has('id') && !empty($request->get('id'))){
            $query->where('id',$request->get('id'));
        }

        if($request->has('paginated')){
            $paginate  = $request->get('paginated');
        }


        $response = $paginate ? $query->paginate($paginate) : $query->get();
        return Response::data(data: $response);
    }

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public function create(string $view, array $data=[]): View
    {
        return view($view, $data);
    }


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
    ): Response|JsonResponse
    {
        $isAPIRequest = $this->checkAPIRequest();

        //Check Validation
        $this->hasValidator($validation, $request, $validationError, $api);

        $record = $model::create($request->all());

        //Interact With Media
        if($hasMedia){
            $this->handelStoreMedia($collection, $request, $record);
        }

        if($api && $isAPIRequest){
            return Response::data(
                data: $record,
                message: $message
            );
        }

        $this->toaster($message);
        return  Response::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back())->record($record);
    }


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
    ): View|JsonResponse
    {
        $isAPIRequest = $this->checkAPIRequest();

        if(count($attach)){
            foreach ($attach as $key=>$value){
                $model->{$key} = $value;
            }
        }

        if($hasMedia){
            $this->handelGetMedia($collection, $model);
        }

        if($api  && $isAPIRequest){
            $response = $model;
            if($resource){
                $response = $resource::make($response);
            }
            return Response::data(
                data: $response,
                message: "Record Fetched Success"
            );
        }

        return view($view, array_merge([
            "model" => $model
        ], $data));
    }


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
    ) : Response|JsonResponse
    {
        $isAPIRequest = $this->checkAPIRequest();

        $this->hasValidator($validation, $request, $validationError, $api);

        $model->update(collect($request->all())->filter( function($value, $key) {
            return $value !== null;
        })->toArray());

        if($hasMedia){
            $this->handelUpdateMedia($collection, $request, $model);
        }

        if($api  && $isAPIRequest){
            return Response::data(
                data: $model,
                message: $message
            );
        }

        $this->toaster($message);
        return  Response::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back())->record($model);
    }

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
    ): Response|JsonResponse
    {
        $isAPIRequest = $this->checkAPIRequest();

        if($hasMedia) {
            $this->handelDestroyMedia($collection, $model);
        }

        $model->delete();

        if($api && $isAPIRequest){
            return Response::data(
                data: [],
                message: $message
            );
        }

        $this->toaster($message, true);
        return  Response::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back());
    }
}
