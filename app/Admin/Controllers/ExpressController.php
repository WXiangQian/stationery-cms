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
        $data = [
            'kuaidi100' => [
                'channel' => 'kuaidi100',
                'status' => 'success',
                'result' => [
                    [
                        'status' => 200,
                        'message'  => 'OK',
                        'error_code' => 0,
                        'data' => [
                            ['time' => '2019-01-09 12:11', 'description' => '仓库-已签收'],
                            ['time' => '2019-01-07 12:11', 'description' => '广东XX服务点'],
                            ['time' => '2019-01-06 12:11', 'description' => '广东XX转运中心']
                        ],
                        'logistics_company' => '申通快递',
                        'logistics_bill_no' => '12312211'
                    ]
                ]
            ]
        ];
        $res = $data['kuaidi100']['result'];
        return response()->json([
            'code' => $res[0]['status'],
            'message' => $res[0]['message'],
            'data' => $res
        ], $res[0]['status'], []);
    }

}
