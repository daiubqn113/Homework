<!-- BEGIN: main -->


				<div class="table-responsive">
				
				

    
</div>
    <table class="table table-striped table-bordered table-hover">
    <div class="col-xs-12 col-md-3">
    	<caption>Danh sách thành viên</caption>
    </div>
    
    <div class="col-xs-12 col-md-24">
    	<form action="{NV_BASE_SITEURL}index.php" method="get">
        <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
        <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />

        <div class="row">
            <div class="col-xs-12 col-md-18">
                <div class="form-group">
                    <input class="form-control" type="text" value="{KEYWORD}" maxlength="64" name="keyword" placeholder="{LANG.search_key}" />
                </div>
            </div>
            
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search}" />
                </div>
            </div>
        </div>
    </form>
    </div>
    
    
    
        <colgroup>
            <col class="w100">
            <col span="1">
            <col class="w150" span="2">
        </colgroup>
        <thead>
            <tr class="text-center">
                <th class="text-center">STT</th>
                <th class="text-center">Họ tên</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
             <tr>
                <td class="text-center">
					{ROW.stt}
				</td>
				<td class="text-center"><a href = "{ROW.url_view}" title="title">{ROW.title}</a></td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
    {GENERATE_PAGE}
</div>

			</div>
<!-- END: main -->