
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


    <div class="relative query-box" style="margin-left: 500px;padding-bottom: 30px;">
      <table border="0" style="font-size: 18px;">
        <tbody>
        <tr>
          <th>时间</th>
          <th>地点和跟踪进度</th>
          <th>快递信息</th>
        </tr>
        <tr>
          <td valign="middle">暂无数据</td>
          <td valign="middle">暂无数据</td>
          <td valign="middle">暂无数据</td>
        </tr>
        <tr>
          <td>2019-01-09 12:11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>货物已交付京东物流</td>
          <td>京东快递</td>
        </tr>
        <tr>
          <td>2019-01-08 12:11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>货物已到达【成都青白江分拣中心】</td>
          <td>京东快递</td>
        </tr>
        </tbody>
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
