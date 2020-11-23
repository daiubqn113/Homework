<!-- BEGIN: main --> 
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" enctype="multipart/form-data" method="post">

		<input type="hidden" name="id" value="{POST.id}" />

 	
 	<div class="form-group">
		<label>{LANG.title}:</label>
		<input type="text" name="title" value="{POST.title}" />
	</div>
	
	<div class="form-group">
		<label>{LANG.avt}:</label>
		<input type="file" name="avt" value="{POST.avt}" />
	</div>
	
	<div class="form-group">
		<label>{LANG.email}:</label>
		<input type="email" name="email" value="{POST.email}" />
	</div>
	
	<div class="form-group">
		<label>{LANG.phone}:</label>
		<input type="text" name="phone" value="{POST.phone}" />
	</div>
	
	
	<div class="form-group">
		{LANG.gender}: 
	
		<div class="radio">
			<!-- BEGIN: gender -->
		  <label><input type="radio" name="gender" value="{GENDER.key}" {GENDER.checked}/>{GENDER.title}</label>
		  <!-- END: gender -->
		</div>
		
		
	</div>
	<div class="form-group">
		<label>{LANG.address}:</label>	
		<select name="provider" onchange="change_provide()" id="provider">
		  <option value="0">Chọn tỉnh</option>
		  <!-- BEGIN: provider -->
		  <option value="{PROVINCE.key}" {PROVINCE.selected}>{PROVINCE.title}</option>
		  <!-- END: provider -->
		</select> 
		<select name="district" id="district">
			<option value="0">Chọn huyện</option>
		</select> 
	</div>

	    <div class="text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
	
	
</form>

<script type="text/javascript">
	function change_provide(){
		var id_provide = $('#provider').val();
		$.ajax({url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&change_provide=1&id_provide=' + id_provide, success: function(result){
		if(result != "err"){
		$('#district').html(result);
		}
			}});
	}
</script>
<!-- END: main -->