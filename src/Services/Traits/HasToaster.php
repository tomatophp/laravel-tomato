<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

trait HasToaster
{
    public function toaster(string $message, bool $success=true): void
    {
        if(class_exists(\ProtoneMedia\Splade\Facades\Toast::class)){
            if($success){
                \ProtoneMedia\Splade\Facades\Toast::title($message)->success()->autoDismiss(2);
            }
            else {
                \ProtoneMedia\Splade\Facades\Toast::title($message)->danger()->autoDismiss(2);
            }
        }
        else if(class_exists(Yoeunes\Toastr\Toastr::class)){
            if($success){
                toastr()->success($message);
            }
            else {
                toastr()->error($message);
            }
        }
        else {
            session()->flash('toaster', [
                'message' => $message,
                'type' => $success ? 'success' : 'danger',
            ]);
        }
    }
}
