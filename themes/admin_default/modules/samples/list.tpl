<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div id="contentmod">
				<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <colgroup>
            <col class="w100">
            <col span="1">
            <col class="w150" span="2">
        </colgroup>
        <thead>
            <tr class="text-center">
                <th class="text-nowrap">STT</th>

                <th class="text-nowrap">Họ tên</th>
                <th class="text-nowrap">Email</th>
                 <th class="text-nowrap">Ảnh</th>
                <th class="text-nowrap">SĐT</th>
                <th class="text-nowrap">Giới tính</th>
                <th class="text-nowrap">Địa chỉ</th>
                <th class="text-nowrap">Địa chỉ</th>
                <th class="text-center text-nowrap">Kích hoạt</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
             <tr>
                <td class="text-center">
					<select name="weight" class="form-control weight_{ROW.id}" onchange="nv_change_weight({ROW.id})">
						<!-- BEGIN: weight -->
						<option value="{J}" {J_SELECT}>{J}</option>
						<!-- END: weight -->
					 </select>
				</td>
				<td>{ROW.title}</td>
				<td><img src="{ROW.avt}" width="100px"></td>
                <td>{ROW.email}</td>
                <td>{ROW.phone}</td>
                <td>{ROW.gender}</td>
                <td>{ROW.address}</td>
                <td>
					<input type="checkbox" name ="active" {ROW.active} onchange = "nv_change_active({ROW.id})">
				</td>
               
                <td class="text-center text-nowrap">
                    <a href="{ROW.url_edit}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="{ROW.url_delete}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i> Xóa</a>
                </td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
    {GENERATE_PAGE}
</div>

			</div>


<script>

	function nv_change_weight(id){
	var new_weight = $('.weight_'+ id).val()
	
	
	$.ajax({
	url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list&change_weight=1&id=' + id + '&new_weight='+new_weight,
	success: function(result){
    
  }});
	}

	function nv_change_active(id){
	$.ajax({
	url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list&change_active=1&id=' + id,
	success: function(result){
    
  }});
	}	

	$(document).ready(function(){
		$('.delete').click(function (){
			if(confirm("Bạn có muốn xóa không!!")){
					return true;
				}else{
					return false;
				}
			});
	});
	
	
</script>
<!-- END: main -->