<style>
  .status {
    background: url(/img/spider_search_v4.png) 70px -725px no-repeat;
  }
</style>
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">快递查询</h3>
  </div>
  <div class="box-body">
    <div class="fields-group">

      <div class="form-group ">
        <label for="name" class="col-sm-2  control-label">快递100</label>
        <div class="col-sm-8">
          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

            <input type="text" id="express_100" name="express_100" value="" class="form-control name"
                   placeholder="请输入要查询的快递单号">

          </div>

        </div>

        <div class="btn-group ">
          <button type="submit" class="btn btn-primary express_100">点击查询</button>
        </div>
        {{ csrf_field() }}
      </div>

    </div>


  </div>


    <div class="relative query-box table-responsive" style="padding-bottom: 30px;">
      <table style="font-size: 18px;" class="table table-bordered text-center">

            <tr >
              <th colspan="2">时间&nbsp;&nbsp;</th>
              <th>状态</th>
              <th colspan="3">&nbsp;&nbsp;地点和跟踪进度</th>
            </tr>
            <tr>
              <td  colspan="2">暂无数据</td>
              <td class="status">&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td colspan="3">暂无数据</td>
            </tr>
            <tr>
              <td colspan="2">2019-01-09 12:11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td class="status">&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td colspan="3">货物已交付京东物流</td>
            </tr>
            <tr>
              <td colspan="2">2019-01-08 12:11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td class="status">&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td colspan="3">货物已到达【成都青白江分拣中心】</td>
            </tr>


      </table>
    </div>

</div>

<script>
  $('.express_100').on('click', function (e) {

    if (!$('#express_100').val().trim()) {
      alert('查询单号必须填写')
      return
    }

    $.ajax({
      url: '/admin/users/show',
      type: 'get',
      data: {
        express: $('#express_100').val(),
        channel: '100',
      },
      success: function (res) {
        console.log(res)
        // alert(res.result)
      }
    })
  })
</script>
