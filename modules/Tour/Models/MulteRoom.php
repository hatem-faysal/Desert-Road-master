<?php
namespace Modules\Tour\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Modules\Booking\Models\Bookable;
use Modules\Tour\Models\Tour;

class MulteRoom extends Model
{

    use Notifiable;
    protected $fillable= ['name','slug','price','tour_id'];

    public function Tour()
    {
        return $this->belongsTo(Tour::class,'tour_id');
    }
}