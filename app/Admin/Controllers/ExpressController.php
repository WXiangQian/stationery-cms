<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;

class ExpressController extends Controller
{
    use HasResourceActions;

    protected $title = '快递';

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->title . '管理')
            ->description($this->title . '查询')
            ->body(view('admin.express'));
    }


    public function getExpressInfo()
    {

    }

}
