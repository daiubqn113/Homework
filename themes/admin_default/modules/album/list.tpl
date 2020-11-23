<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}"  enctype="multipart/form-data" method="post">
    <table class="table table-striped table-bordered table-hover">
        <colgroup>
            <col class="w100">
            <col span="1">
            <col class="w150" span="2">
        </colgroup>
        <thead>
            <tr class="text-center">
                <th class="text-nowrap">STT</th>
				<th class="text-nowrap">Ảnh</th>
                <th class="text-nowrap">Tên album</th>
                <th class="text-center text-nowrap">Kích hoạt</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
             <tr>
                <td class="text-center">{ROW.stt}</td>
                <td><a href = "{ROW.url_album}" title="title"><img src="{ROW.avt}" width="100px"></a></td>
				<td><a href = "{ROW.url_album}" title="title">{ROW.name}</a></td>

                <td class="text-center text-nowrap">
                	<a href="{ROW.url_detail}" class="btn btn-primary btn-sm"> Chi tiết</a>
                    <a href="{ROW.url_edit}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="{ROW.url_delete}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i> Xóa</a>
                </td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
    {GENERATE_PAGE}

</form>
<script>
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

