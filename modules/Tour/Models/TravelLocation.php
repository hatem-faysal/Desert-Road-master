<?php
namespace Modules\Tour\Models;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Modules\Location\Models\Location;
use Modules\Tour\Models\Tour;


class TravelLocation extends Model
{

    protected $table = 'travel_locations';
    protected $fillable = [
        'tour_id',
        'location_id',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
        'created_at',
    ];

    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

    public function Tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
