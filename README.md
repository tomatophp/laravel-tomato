# Laravel Tomato

Basic Laravel Helpers for requests and controllers build by TomatoPHP

## Installation

```bash
composer require tomatophp/laravel-tomato
```

## Features

- [x] `Tomato::menu()` inject and handle menus across your application
- [x] `Tomato::widget()` inject and handle widgets across your application
- [x] `Tomato::slot()` inject and handle slots across your application
- [x] `Tomato::request()` handle and validate requests
- [x] `Tomato::response()` handle api responses

## Usage

you can use the helper by Facade class or by using the helper function

```php
use TomatoPHP\LaravelTomato\Facades\Tomato::register();
```
or just

```php
tomato()::register();
```

## Register Components

you can register your menu, widget, or slot in your service provider `boot()` method

```php
Tomato::register([
    Menu::make()
        ->group(__('CRM'))
        ->label(__('Name'))
        ->route('home')
        ->icon('home'),
    Widget::make()
        ->group(__('CRM'))
        ->label(__('Name'))
        ->counter(100)
        ->icon("bx bx-user"),
    Slot::make()
        ->position(Positions::dashboardTop)
        ->view('dashboard-top'),
]);
```

you can register any type of component and we will check it and handle it for you

all components have a macroable methods to add more functionality to it.

## Get Components

you can get your components like this

```php
Tomato::menu()->get();
Tomato::widget()->get();
Tomato::slot()->get();
```

it will return an array of registered components for you

## Request

you can use the request helper to handle and validate your requests like this

```php
return Tomato::request()->index(
   request: request(),
   model: App\Models\User::class,
);
```

### 🔁 Index Request

this method returns view or JsonResponse based on the request type. and we get the request type by check if the route has `auth:sanctum` middleware or not.

this method accept some arguments:

- `request` the request object
- `model` the model you want to get
- `view` the view you want to return
- `table` the table class you want to use
- `data` the data you want to pass to the view
- `api` if you want to return JsonResponse or not
- `resource` resource class to resource your returned data
- `query` if you want to add some query to the model
- `filters` if you want to add some filters to the table

```php
public function index(Request $request): View|JsonResponse
{
    return Tomato::index(
        request: $request, //Required
        model: $this->model, //Required
        view: 'users.index', 
        table: \App\Tables\UserTable::class,
        data: [
            'name' => 'john doe',
        ],
        api: true,
        resource: UserResource::class,
        query: User::query()->where('is_activated',true),
        filters: [
            'is_activated',
        ],
    );
}
```

### 🔁 JSON Request

this method return only json response of the model to make it easy to access it with `x-splade-select` or `x-tomato-admin-select`

this method accept some arguments:

* `request` the request object
* `model` the model you want to get
* `data` the data you want to pass to the view
* `paginate` if you want to paginate the response or not
* `query` if you want to add some query to the model
* `filters` if you want to add some filters to the table

```php
public function api(Request $request): JsonResponse
{
    return Tomato::json(
        request: $request, //Required
        model: \App\Models\User::class, //Required
        data: [
            'name' => 'john doe',
        ],
        paginate: 10,
        query: User::query()->where('is_activated',true),
        filters: [
            'is_activated',
        ],
    );
}
```

### 🔁 Get Request

this method returns view or JsonResponse based on the request type. and we get the request type by check if the route has `auth:sanctum` middleware or not.

this method accept some arguments:

* `model` the model you want to get
* `view` the view you want to return
* `data` the data you want to pass to the view
* `hasMedia` if you want to get the media of the model or not
* `collection [array]` the media collection you want to get as array take true if it's multi or false if it's single
* `attach [array]` to attach some data to the model
* `api` if you want to return JsonResponse or not
* `resource` resource class to resource your returned data
* `query` if you want to add some query to the model

```php
public function show(\App\Models\User $model): View|JsonResponse
{
    return Tomato::get(
        model: $model, //Required
        view: 'users.show', //Required
        data: [
            'name' => 'john doe',
        ],
        hasMedia: true,
        collection: [
            'avatar' => false,
            'gallery' => true
        ],
        attach: [
            'roles' => $model->roles,
        ],
        api: true,
        resource: UserResource::class,
        query: User::query()->where('is_activated',true)
    );
}
```

### 🔁 Store Request

this method returns RedirectResponse or JsonResponse based on the request type. and we get the request type by check if the route has `auth:sanctum` middleware or not.

this method accept some arguments:

* `request` the request object
* `model` the model you want to get
* `validation` the validation rules you want to use
* `message` the message you want to return with the response
* `validationError` the message you want to return if the validation failed
* `redirect` the redirect route you want to redirect to
* `hasMedia` if you want to get the media of the model or not
* `collection [array]` the media collection you want to get as array take true if it's multi or false if it's single
* `api` if you want to return JsonResponse or not

```php
public function store(Request $request): RedirectResponse|JsonResponse
{
    $response = Tomato::store(
        request: $request, //Required
        model: \App\Models\User::class, //Required
        validation: [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ],
        message: __('User created successfully'),
        validationError: __('Error When Try To Store User'),
        redirect: 'admin.users.index',
        hasMedia: true,
        collection: [
            'avatar' => false,
            'gallery' => true
        ],
        api: true,
    );

    if($response instanceof JsonResponse){
        return $response;
    }

    return $response->redirect;
}
```

### 🔁 Update Request

this method returns RedirectResponse or JsonResponse based on the request type. and we get the request type by check if the route has `auth:sanctum` middleware or not.

this method accept some arguments:

* `request` the request object
* `model` the model you want to get
* `validation` the validation rules you want to use
* `message` the message you want to return with the response
* `validationError` the message you want to return if the validation failed
* `redirect` the redirect route you want to redirect to
* `hasMedia` if you want to get the media of the model or not
* `collection [array]` the media collection you want to get as array take true if it's multi or false if it's single
* `api` if you want to return JsonResponse or not

```php
public function update(Request $request, \App\Models\User $model): RedirectResponse|JsonResponse
{
    $response = Tomato::update(
        request: $request, //Required
        model: $model, //Required
        validation: [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ],
        message: __('User updated successfully'),
        redirect: 'admin.users.index',
        hasMedia: true,
        collection: [
            'avatar' => false,
            'gallery' => true
        ],
        api: true,
    );

     if($response instanceof JsonResponse){
         return $response;
     }

     return $response->redirect;
}
```

### 🔁 Destroy Request

this method returns RedirectResponse or JsonResponse based on the request type. and we get the request type by check if the route has `auth:sanctum` middleware or not.

this method accept some arguments:

* `model` the model you want to get
* `message` the message you want to return with the response
* `redirect` the redirect route you want to redirect to
* `api` if you want to return JsonResponse or not

```php
public function destroy(\App\Models\User $model): RedirectResponse|JsonResponse
{
    $response = Tomato::destroy(
        model: $model, //Required
        message: __('User deleted successfully'), //Required
        redirect: 'admin.users.index',
    );

    if($response instanceof JsonResponse){
        return $response;
    }

    return $response->redirect;
}
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/Xqmt35Uh)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
