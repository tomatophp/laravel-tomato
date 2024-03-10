<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasView
{
    /**
     * @var ?string
     * @example new
     */
    public ?string $view = "";

    /**
     * @param string $view
     * @return $this
     */
    public function view(string $view): static
    {
        $this->view = $view;
        return $this;
    }
}
