<?php
namespace Modules\Tour\Admin;

use App\Http\Requests\BookRequest;
use App\Http\Requests\MultiRoom\MultiRoomStoreRequest;
use App\Http\Requests\MultiRoom\MultiRoomUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Location\Models\Location;
use Modules\Location\Models\LocationCategory;
use Modules\Tour\Hook;
use Modules\Tour\Models\MulteRoom;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Tour\Models\TourTerm;
use Modules\Tour\Models\TourTranslation;
use Modules\Tour\Models\TravelLocation;

class MultiRoomController extends AdminController
{
    protected $multiRoomClass;
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
        $this->setActiveMenu(route('multiroom.admin.index'));
        $this->multiRoomClass = MulteRoom::class;
        $this->travelLocation = TravelLocation::class;
        $this->tourTranslationClass = TourTranslation::class;
        $this->tourCategoryClass = TourCategory::class;
        $this->tourTermClass = TourTerm::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('tour_view');
        $query = $this->multiRoomClass::query();
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('name', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('price', 'asc');
        }
        $data = [
            'rows'               => $query->paginate(20),
            'page_title'         => __("Tour Management"),
            'breadcrumbs'        => [
                [
                    'name' => __('Multi Room'),
                    'url'  => route('multiroom.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.multiroom.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('tour_view');
        $query = $this->multiRoomClass::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if ($this->hasPermission('tour_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('author_id', $author);
            }
        } else {
            $query->where('author_id', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'author',
                'category_tour'
            ])->paginate(20),
            'tour_categories'    => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_manage_others' => $this->hasPermission('tour_manage_others'),
            'page_title'         => __("Recovery Tour Management"),
            'recovery'           => 1,
            'breadcrumbs'        => [
                [
                    'name' => __('Multi Room'),
                    'url'  => route('multiroom.admin.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.multiroom.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('tour_create');
        $row = new Tour();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'               => $row,
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'translation'       => new $this->tourTranslationClass(),
            'breadcrumbs'       => [
                [
                    'name' => __('Multi Room'),
                    'url'  => route('multiroom.admin.index')
                ],
                [
                    'name'  => __('Add Multi Room'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.multiroom.detail', $data);
    }

    public function edit(Request $request, $id)
    {

        $this->checkPermission('tour_update');
        $row = $this->multiRoomClass::find($id);
        if (empty($row)) {
            return redirect(route('multiroom.admin.index'));
        }
        
        // $translation = $row->translate($request->query('lang',get_main_lang()));
        // dd($translation);
        if (!$this->hasPermission('tour_manage_others')) {
            if ($row->author_id != Auth::id()) {
                return redirect(route('multiroom.admin.index'));
            }
        }
        
        $data = [
            'row'               => $row,    
            // 'translation'       => $translation,
            // "selected_terms"    => $row->tour_term->pluck('term_id'),
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Multi Room'),
                    'url'  => route('multiroom.admin.index')
                ],
                [
                    'name'  => __('Edit Multi Room'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Edit Multi Room')
        ];
        return view('Tour::admin.multiroom.detail', $data);
    }

    public function store(Request $request, $id)
    {
        if ($id > 0) {
           $id= Request()->segment(6);
            $this->validate($request, [
                'name'=>['required','unique:multe_rooms,name,'.$id],
                'price'=>['required','unique:multe_rooms,price,'.$id],
            ]);
            $this->checkPermission('tour_update');  
            $row = $this->multiRoomClass::find($id);
            $row->update(['price'=>$request->price,'name'=>$request->name,'slug'=>Str::slug($request->name)]);
            return redirect(route('multiroom.admin.edit', $row->id))->with('success', __('Multi Room created'));
        } else {
            $this->validate($request, [
                'name'=>['required','unique:multe_rooms,name'],
                'price'=>['required','unique:multe_rooms,price'],
            ]);
            $this->checkPermission('tour_create');
            $row = new $this->multiRoomClass();
            $row = $row::create(['name'=>$request->name,'slug'=>Str::slug($request->name),'price'=>$request->price]);
            
            return redirect(route('multiroom.admin.edit', $row->id))->with('success', __('Multi Room created'));
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->tourTermClass::where('tour_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->tourTermClass::firstOrCreate([
                    'term_id' => $term_id,
                    'tour_id' => $row->id
                ]);
            }
            $this->tourTermClass::where('tour_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->multiRoomClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->forceDelete();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->multiRoomClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Permanently delete success!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->multiRoomClass::withTrashed()->where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Recovery success!'));
                break;
            case "clone":
                $this->checkPermission('tour_create');
                foreach ($ids as $id) {
                    (new $this->multiRoomClass())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->multiRoomClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_update');
                    }
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                    event(new UpdatedServiceEvent($row));
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        if ($pre_selected && $selected) {
            if (is_array($selected)) {
                $items = $this->multiRoomClass::select('id', 'title as text')->whereIn('id', $selected)->take(50)->get();
                return $this->sendSuccess([
                    'items' => $items
                ]);
            } else {
                $item = $this->multiRoomClass::find($selected);
            }
            if (empty($item)) {
                return $this->sendSuccess([
                    'text' => ''
                ]);
            } else {
                return $this->sendSuccess([
                    'text' => $item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->multiRoomClass::select('id', 'title as text')->where("status", "publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return $this->sendSuccess([
            'results' => $res
        ]);
    }
}
