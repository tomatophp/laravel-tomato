<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TomatoPHP\LaravelTomato\Services\Response;

trait HandleMedia
{
    /**
     * @param array $collection
     * @param Request $request
     * @param $record
     * @return void
     */
    public function handelStoreMedia(array $collection, Request $request, $record): void
    {
        if(class_exists(\Spatie\MediaLibrary\MediaCollections\Models\Media::class) && method_exists($record, 'addMedia') && method_exists($record, 'addMediaCollection')){
            foreach ($collection as $key=>$multi){
                if($multi){
                    if($request->has($key) && is_array($request->{$key}) && count($request->{$key})){
                        foreach ($request->{$key} as $item) {
                            $record->addMedia($item)
                                ->preservingOriginal()
                                ->toMediaCollection($key);
                        }
                    }
                }
                else{
                    if($request->hasFile($key)){
                        $record->addMedia($request->{$key})
                            ->preservingOriginal()
                            ->toMediaCollection($key);
                    }
                }
            }
        }
    }

    /**
     * @param array $collection
     * @param $model
     * @return void
     */
    public function handelGetMedia(array $collection, &$model): void
    {
        if(class_exists(\Spatie\MediaLibrary\MediaCollections\Models\Media::class) && method_exists($model, 'addMediaCollection')) {
            foreach ($collection as $key => $multi) {
                if ($multi) {
                    $model->{$key} = $model->getMedia($key)->map(function ($file) {
                        return $file->getUrl();
                    });
                } else {
                    $model->{$key} = $model->getMedia($key)->first() ? $model->getMedia($key)->first()->getUrl() : null;
                }
            }

            unset($model->media);
        }
    }

    /**
     * @param array $collection
     * @param Request $request
     * @param $model
     * @return void
     */
    public function handelUpdateMedia(array $collection, Request $request, $model): void
    {
        if(class_exists(\Spatie\MediaLibrary\MediaCollections\Models\Media::class) && method_exists($record, 'addMediaCollection')){
            foreach ($collection as $key=>$multi){
                if($multi){
                    if($request->has($key) && is_array($request->{$key}) && count($request->{$key})){
                        $model->clearMediaCollection($key);
                        foreach ($request->{$key} as $item) {
                            if(!is_string($item)){
                                if($item->getClientOriginalName() === 'blob'){
                                    $model->addMedia($item)
                                        ->usingFileName(strtolower(Str::random(10).'_'.$key.'.'.$item->extension()))
                                        ->preservingOriginal()
                                        ->toMediaCollection($key);
                                }
                                else {
                                    $model->addMedia($item)
                                        ->preservingOriginal()
                                        ->toMediaCollection($key);
                                }
                            }
                        }
                    }
                }
                else{
                    if($request->hasFile($key)){
                        $model->clearMediaCollection($key);
                        if($request->{$key}->getClientOriginalName() === 'blob'){
                            $model->addMedia($request->{$key})
                                ->usingFileName(strtolower(Str::random(10).'_'.$key.'.'.$request->{$key}->extension()))
                                ->preservingOriginal()
                                ->toMediaCollection($key);
                        }
                        else {
                            $model->addMedia($request->{$key})
                                ->preservingOriginal()
                                ->toMediaCollection($key);
                        }
                    }

                }
            }
        }
    }

    /**
     * @param array $collection
     * @param $record
     * @return void
     */
    public function handelDestroyMedia(array $collection, $record): void
    {
        if(class_exists(\Spatie\MediaLibrary\MediaCollections\Models\Media::class) && method_exists($record, 'addMediaCollection')){
            foreach ($collection as $key => $multi) {
                $record->clearMediaCollection($key);
            }
        }
    }
}
