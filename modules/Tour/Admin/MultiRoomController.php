<?php
namespace Modules\Tour\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Tour\Models\MulteRoom;

class MultiRoomController extends AdminController
{
    protected $tourClass;
    protected $travelLocation;
    /**
     * @var string
     */

    public function __construct()
    {
        $this->setActiveMenu(route('tour.admin.index'));
        $this->tourClass = MulteRoom::class;
        $this->travelLocation = MulteRoom::class;
    }

    public function index(Request $request, $id)
    {
        $this->checkPermission('tour_update');
        $row = $this->tourClass::find($id);
        if (empty($row)) {
            // return redirect(route('tour.admin.index'));
        }
        // $translation = $row->translate($request->query('lang',get_main_lang()));
        if (!$this->hasPermission('tour_manage_others')) {
            if ($row->author_id != Auth::id()) {
                // return redirect(route('tour.admin.index'));
            }
        }
        $data = [
            'id'               => $id,
            'row'               => $row,
            'travelLocations'               => $this->travelLocation::where('tour_id',$id)->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Multi Room'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Edit Multi Room'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Edit Multi Room')
        ];
        return view('Tour::admin.multiroom', $data);
    }
    public function update(Request $request, $id)
    {
        $this->travelLocation::insert([
            'name'=>$request->name,
            'price'=>$request->price,
            'tour_id'=>$request->tour_id,
            'created_at'=>date('Y-m-d\TH:i:s'),
        ]);
        return redirect()->back()->with('success', __('Package Multi Location Update'));
    }
    public function destroy(Request $request, $id){
        $travelLocation = $this->travelLocation::find($id);
        $travelLocation->delete();
        return redirect()->back()->with('success', __('Package Multi Location Delete'));
    }
}