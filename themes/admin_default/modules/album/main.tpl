<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}"  enctype="multipart/form-data" method="post">
    
    <!-- BEGIN: error -->
		<div class="alert alert-warning">{ERROR}</div>
	<!-- END: error -->
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="form-group">
                <label>{LANG.name}</label>
                <input type="text" name="name" value="{POST.name}">
            </div>
            <div class="form-group">
                <label>{LANG.file}</label>
                <input type="file" name="avt">
            </div>
            <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
        </div>
    </div>
</form>
<!-- END: main -->