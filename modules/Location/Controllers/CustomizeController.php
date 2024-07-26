<?php
namespace Modules\Location\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customzie\CustomzieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Location\Models\Customize;

class CustomizeController extends Controller
{
    public $Customize;
    public function __construct(Customize $Customize)
    {
        $this->Customize = $Customize;
    }

    public function store(CustomzieRequest $request)
    {
        Customize::create($request->all());
        return redirect()->back()->with('success', __('Customzie created success') );
    }
}
