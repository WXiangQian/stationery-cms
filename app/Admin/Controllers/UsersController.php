<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use HasResourceActions;

    protected $title = '员工';

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
        // return $content->body(Admin::show(User::findOrFail($id)));
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
        $show = new Show(User::findOrFail($id));

        $show->id('ID');
        $show->name('员工名称');
        // 如果要在字段之间添加一条分隔线：
        // $show->divider();
        $show->department('部门', function ($d_id) {
            // 为了能够正常使用这个面板右上角的工具，必须用setResource()方法设置用户资源的url访问路径
            // $d_id->setResource('/admin/departments');
            // 面板右上角默认有三个按钮编辑、删除、列表，可以分别用下面的方式关掉它们：
            $d_id->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });
            $d_id->name('部门名称');
        });
        $show->sex('性别')->using(['0' => '未知', '1' => '男', '2' => '女']);
        $show->mobile('手机号');
        return $show;
    }

    protected function grid()
    {
        $grid = new Grid(new User);
        // 导出
        $excel = new ExcelExpoter();
        $date = date('Y-m-d H:i:s', time());
        $excel->setAttr('员工管理'.$date, '员工管理',
            ['id','姓名','部门','性别','手机号','入职时间'],
            ['id','name','department.name','sex','mobile','created_at']
        );
        $grid->exporter($excel);

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->name('员工姓名');
        $grid->column('department.name', '部门');
        $grid->sex('性别')->display(function ($sex) {
            if ($sex == 1) return '男';
            if ($sex == 2) return '女';
            return '未知';
        });
        $grid->mobile('手机号');
        $grid->created_at('创建时间');

        $grid->filter(function($filter){
            $filter->column(1/2, function ($filter) {
                $filter->equal('name', '员工姓名');
                $filter->equal('mobile', '手机号');
            });
            $filter->column(1/2, function ($filter) {
                $filter->equal('d_id', '所属部门')->select(Department::where('pid', 0)->pluck('name', 'id'));
                $filter->equal('sex', '性别')->select(['1' => '男', '2' => '女']);

                $filter->between('created_at', '创建时间')->datetime();
            });
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
        $form = new Form(new User());
        $form->text('name', '员工姓名');
        $form->select('d_id', '部门')
            ->options(Department::where('pid', 0)->pluck('name', 'id'))
            ->rules('required');
        $form->select('sex', '性别')->options([1 => '男', 2 => '女'])->default(1);
        $form->mobile('mobile', '手机号')->rules('required');
        return $form;
    }
}
