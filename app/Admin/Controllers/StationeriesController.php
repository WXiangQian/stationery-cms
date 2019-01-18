<?php

namespace App\Admin\Controllers;

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
        $show->user('申请人', function ($user_id) {
            // 为了能够正常使用这个面板右上角的工具，必须用setResource()方法设置用户资源的url访问路径
            // $d_id->setResource('/admin/departments');
            $user_id->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });;
            $user_id->name('申请人');
        });
        $show->created_at('申请时间');
        // style的取值可以是 primary、info、danger、warning、default
        $show->panel()
            ->style('info')
            ->title('申请办公用品的基本信息');
        return $show;
    }

    protected function grid()
    {
        $grid = new Grid(new Stationery());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->column('user.name', '申请人');
        $grid->name('申请的办公用品');
        $grid->created_at('创建时间');

        $grid->filter(function($filter){
            $filter->like('user.name', '申请人');
            $filter->equal('name', '申请的办公用品');
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
        return $form;
    }
}
