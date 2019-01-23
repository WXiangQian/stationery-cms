<style>
  .status {
    background: url(/img/spider_search_v4.png) 100px -725px no-repeat;
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

            <input type="text" id="express" name="express" value="" class="form-control name"
                   placeholder="请输入要查询的快递单号">

          </div>

        </div>

        <div class="btn-group ">
          <button type="submit" class="btn btn-primary express">点击查询</button>
        </div>
        {{ csrf_field() }}
      </div>

    </div>


  </div>


    <div class="relative query-box table-responsive" style="padding-bottom: 30px;">
      <table style="font-size: 18px;" class="table table-bordered text-center">

            <tr >
              <th colspan="2">时间</th>
              <th>快递信息</th>
              <th colspan="3">地点和跟踪进度</th>
            </tr>

      </table>
    </div>

</div>

<script>
  $('.express').on('click', function (e) {

    if (!$('#express').val().trim()) {
      alert('查询单号必须填写')
      return
    }

    $.ajax({
      url: '/admin/express/info',
      type: 'get',
      data: {
        code: $('#express').val(),
      },
      success: function (res) {
        var data = res.data[0]
        var name = '快递:'+data.logistics_company
        var item = "<tr><th colspan='2'>时间</th><th colspan='2'>"+name+"</th><th colspan='3'>地点和跟踪进度</th></tr>"
        $.each(data.data,function(i,result){
          item += "<tr><td colspan='2'>"+result['time']+"</td><td class='status'>&nbsp;</td><td colspan='3'>"+result['description']+"</td></tr>";
        });
        $('.table').html(item);
      },
      error : function (res) {
        alert(res.responseJSON['message']);
      }
    })
  })
</script>
