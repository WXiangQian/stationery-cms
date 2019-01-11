<?php
namespace App\Models;



use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Department extends BaseModel
{
    use ModelTree, AdminBuilder;
    protected $table = 'departments';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }
}