<?php
namespace Modules\News\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Core\Models\SEO;

class NewsCategory extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'core_news_category';
    protected $fillable = [
        'name',
        'content',
        'status',
        'parent_id',
        'type',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';
    protected $seo_type = 'news_category';

    public static function getModelName()
    {
        return __("News Category");
    }

    public function filterbyCat($id)
    {
        $posts = News::where('news_id', $this->id)->get();
        return $posts;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {

            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->orderBy('id', 'desc')->limit(10)->get();
        return $a;
    }

    public function getDetailUrl($locale = false)
    {
        return route('news.category.index',['slug'=>$this->slug]);
    }

    public function dataForApi(){
        $translation = $this->translate();
        return [
            'name'=>$translation->name,
            'id'=>$this->id,
            'url'=>$this->getDetailUrl()
        ];
    }

    public function news(){
        return $this->hasMany(News::class,'cat_id');
    }

}
