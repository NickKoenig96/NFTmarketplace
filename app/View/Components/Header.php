<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $firstname;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
