<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\Stationery;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StationeriesController extends Controller
{
    use HasResourceActions;

    protected $title = '办公用品';

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
            ->description($this->title . '列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header($this->title . '管理')
            ->description('查看' . $this->title . '信息')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title . '管理')
            ->description('修改' . $this->title . '信息')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header($this->title . '管理')
            ->description('创建' . $this->title . '信息')
            ->body($this->form());
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Stationery::findOrFail($id));

        $show->id('ID');
        $show->name('申请的办公用品');
        // 如果要在字段之间添加一条分隔线：
        // $show->divider();
        $show->user('申请人', function ($user_id) {
            // 为了能够正常使用这个面板右上角的工具，必须用setResource()方法设置用户资源的url访问路径
            // $d_id->setResource('/admin/departments');
            // 面板右上角默认有三个按钮编辑、删除、列表，可以分别用下面的方式关掉它们：
            $user_id->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });
            $user_id->name('申请人');
        });
        $show->created_at('申请时间');
        $show->url('购买链接');
        // style的取值可以是 primary、info、danger、warning、default
        $show->panel()
            ->style('info')
            ->title('申请办公用品的基本信息');
        return $show;
    }

    protected function grid()
    {
        $grid = new Grid(new Stationery());
        // 导出
        $excel = new ExcelExpoter();
        $date = date('Y-m-d H:i:s', time());
        $excel->setAttr('办公用品管理'.$date, '办公用品管理',
            ['id','申请人','申请的办公用品','申请时间'],
            ['id','user.name','name','created_at']
        );
        $grid->exporter($excel);

        $grid->tools(function ($tools) {
            $tools->append("<a href='/admin/express' class='btn btn-sm btn-primary' title='查询快递信息'><span class='hidden-xs'>&nbsp;&nbsp;查询快递信息</span></a>");
        });
        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->column('user.name', '申请人');
        $grid->name('申请的办公用品');
        $grid->url('购买链接')->display(function ($url) {
            return "<a href='{$url}' target='_blank'>$url</a>";
        });
        $grid->created_at('创建时间');
        $grid->actions(function ($actions) {
            // $actions->disableDelete();
            // $actions->disableEdit();
            //禁用显示详情按钮
            $actions->disableView();
        });
        $grid->filter(function($filter){
            $filter->like('user.name', '申请人');
            $filter->like('name', '申请的办公用品');
            $filter->between('created_at', '创建时间')->datetime();
        });
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Stationery());
        $form->text('name', '申请的办公用品');
        $form->select('user_id', '申请人')
            ->options(User::pluck('name', 'id'))
            ->rules('required');
        $form->url('url', '购买链接');
        return $form;
    }
}
