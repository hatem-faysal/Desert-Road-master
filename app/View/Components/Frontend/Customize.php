<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\Location\Models\Location;


class Customize extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $cities = Location::get();
        $NumberOfPeople = Location::NUMBEROFPEOPLE;
        return view('components.frontend.customize',compact('cities','NumberOfPeople'));
    }
}
