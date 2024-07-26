<?php
    namespace Modules\Location\Models;

    use App\BaseModel;
    use Illuminate\Http\Request;
    use Kalnoy\Nestedset\NodeTrait;
    use Modules\Booking\Models\Bookable;
    use Modules\Media\Helpers\FileHelper;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\Core\Models\SEO;
    use Illuminate\Database\Eloquent\Model;


    class Customize extends Model
    {
        protected $table         = 'customizes';
        protected $fillable      = [
            'name',
            'phone',
            'email',
            'city_id',
            'number_of_people',
            'date_from',
            'date_to',
            'message',
            'url',
        ];
        const NUMBEROFPEOPLE     = [1,2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20];

        public function city()
        {
            return $this->belongsTo(Location::class,'city_id');
        }
    }
