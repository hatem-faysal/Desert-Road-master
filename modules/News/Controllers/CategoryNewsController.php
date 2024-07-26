<?php
namespace Modules\News\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\FrontendController;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;

class CategoryNewsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $slug)
    {
        $cat = NewsCategory::where('type', 'news')->where('slug', $slug)->first();
        if (empty($cat)) {
            return redirect('/news');
        }
        $listNews = News::where('type', 'news')->query();
        $listNews->select("core_news.*")
                ->join('core_news_category', function ($join) use($cat) {
                    $join->on('core_news_category.id', '=', 'core_news.cat_id')
                         ->where('core_news_category._lft', '>=', $cat->_lft)
                         ->where('core_news_category._rgt', '<=', $cat->_rgt);
                })
                ->where("core_news.status", "publish")
                ->groupBy('core_news.id');


        $translation = $cat->translate();

        $data = [
            'rows'           => $listNews->with("author")->with("category")->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish")->where('type', 'news'),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish")->where('type', 'news'),
            'breadcrumbs'    => [
                [
                    'name' => __('News'),
                    'url'  => route('news.index')
                ],
                [
                    'name'  => $translation->name,
                    'class' => 'active'
                ],
            ],
            'page_title'=>$translation->name,
            'seo_meta'  => $cat->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'translation'=>$translation,
            'header_transparent'=>true,
        ];
        return view('News::frontend.index', $data);
    }
    
    public function index_blog(Request $request, $slug)
    {
        $cat = NewsCategory::where('type', 'blogs')->where('slug', $slug)->first();
        if (empty($cat)) {
            return redirect('/news');
        }
        $listNews = News::query()->where('core_news.type', 'blogs');
        $listNews->select("core_news.*")
                ->join('core_news_category', function ($join) use($cat) {
                    $join->on('core_news_category.id', '=', 'core_news.cat_id')
                         ->where('core_news_category._lft', '>=', $cat->_lft)
                         ->where('core_news_category._rgt', '<=', $cat->_rgt);
                })
                ->where("core_news.status", "publish")
                ->groupBy('core_news.id');


        $translation = $cat->translate();

        $data = [
            'rows'           => $listNews->with("author")->with("category")->paginate(5),
            'model_category'    => NewsCategory::where('type', 'blogs')->where("status", "publish")->where('type', 'blogs'),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish")->where('type', 'blogs'),
            'breadcrumbs'    => [
                [
                    'name' => __('Blogs'),
                    'url'  => route('news.index')
                ],
                [
                    'name'  => $translation->name,
                    'class' => 'active'
                ],
            ],
            'page_title'=>$translation->name,
            'seo_meta'  => $cat->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'translation'=>$translation,
            'header_transparent'=>true,
        ];
        return view('News::frontend.index', $data);
    }
}
