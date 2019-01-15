<?php

namespace App\Admin\Controllers;

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
        $show->department('部门', function ($d_id) {
            // 为了能够正常使用这个面板右上角的工具，必须用setResource()方法设置用户资源的url访问路径
            // $d_id->setResource('/admin/departments');

            $d_id->name('部门名称');
        });
        $show->sex('性别')->using(['0' => '未知', '1' => '男', '2' => '女']);
        $show->mobile('手机号');
        return $show;
    }

    protected function grid()
    {
        $grid = new Grid(new User);

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