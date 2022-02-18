<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class AdminAlertError extends Component
{
    public $errors;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($errors=array())
    {
        if(Session::has('errors'))
            $this->errors = Session::get('errors')->all();
        else
            $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-alert-error');
    }
}
