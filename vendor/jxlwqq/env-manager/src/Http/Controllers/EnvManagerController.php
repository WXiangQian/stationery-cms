<?php

namespace Jxlwqq\EnvManager\Http\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Show;
use Jxlwqq\EnvManager\Env;


class EnvManagerController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->header('Title')
            ->description('Description')
            ->body($this->grid());
    }


    /**
     * Show interface.
     *
     * @param mixed $key
     * @param Content $content
     * @return Content
     */
    public function show($key, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($key));
    }


    /**
     * Edit interface.
     *
     * @param $key
     * @return Content
     */
    public function edit($key, Content $content)
    {
        $content->header('Title');
        $content->description('Description');
        $content->body($this->form()->edit($key));
        return $content;
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Env());
        $grid->key();
        $grid->value();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $key
     * @return Show
     */
    protected function detail($key)
    {
        $env = new Env();
        $show = new Show($env->findOrFail($key));

        $show->key('Key');
        $show->value('Value');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Env());
        $form->text('key', 'Key');
        $form->text('value', 'Value');
        return $form;
    }


}