<?php
namespace Modules\Tour\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Location\Models\Location;
use Modules\Location\Models\LocationCategory;
use Modules\Tour\Hook;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Tour\Models\TourTerm;
use Modules\Tour\Models\TourTranslation;
use Modules\Tour\Models\TravelLocation;


class MultiLocationController extends AdminController
{
    protected $tourClass;
    protected $tourTranslationClass;
    protected $tourCategoryClass;
    protected $tourTermClass;
    protected $attributesClass;
    protected $locationClass;
    protected $travelLocation;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        $this->setActiveMenu(route('tour.admin.index'));
        $this->tourClass = Tour::class;
        $this->travelLocation = TravelLocation::class;
        $this->tourTranslationClass = TourTranslation::class;
        $this->tourCategoryClass = TourCategory::class;
        $this->tourTermClass = TourTerm::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function index(Request $request, $id)
    {
        $this->checkPermission('tour_update');
        $row = $this->tourClass::find($id);
        if (empty($row)) {
            return redirect(route('tour.admin.index'));
        }
        $translation = $row->translate($request->query('lang',get_main_lang()));
        if (!$this->hasPermission('tour_manage_others')) {
            if ($row->author_id != Auth::id()) {
                return redirect(route('tour.admin.index'));
            }
        }
        $data = [
            'row'               => $row,
            'travelLocations'               => $this->travelLocation::where('tour_id',$id)->get(),
            'translation'       => $translation,
            "selected_terms"    => $row->tour_term->pluck('term_id'),
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Edit Tour'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Edit Tour')
        ];
        return view('Tour::admin.multilocation', $data);
    }
    public function update(Request $request, $id)
    {
        $this->travelLocation::insert([
            'tour_id'=>$id,
            'location_id'=>$request->location_id,
            'address'=>$request->address,
            'map_lat'=>$request->map_lat,
            'map_lng'=>$request->map_lng,
            'map_zoom'=>$request->map_zoom,
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