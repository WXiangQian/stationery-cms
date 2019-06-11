<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Wythe\Logistics\Logistics;

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


    public function getExpressInfo(Request $request)
    {
        $code = $request->input('code', '');
        if (!$code) {
            return response()->json([
                'code' => 1,
                'message' => '请输入要查询的快递单号',
            ], 400);
        }
        $logistics = new Logistics();

        $data = $logistics->query($code, 'kuaidi100');

        $res = $data['kuaidi100'];
        if (isset($res['result'])) {
            $res = $data['kuaidi100']['result'];
            return response()->json([
                'code' => $res[0]['status'],
                'message' => $res[0]['message'],
                'data' => $res
            ], $res[0]['status'], []);
        } else {
            return response()->json([
                'code' => 1,
                'message' => '请输入正确的快递单号',
            ], 400);
        }

    }

}
