<div class="container-fluid">
	<div class="well">
		<h2 class="text-center">TRANG QUẢN LÍ GIÁO VIÊN</h2>
		<div class="row">
			<div class="col-xs-12 col-md-6 text-center">
				<a class="btn btn-primary" href="/Admin_Home_Headmaster/student">
				<span class="glyphicon glyphicon-eye-open"></span> Quản lí học sinh
				</a>
			</div>
			<div class="col-xs-12 col-md-6 text-center">
				<a class="btn btn-primary" href="/Admin_Home_Headmaster/teacher">
				<span class="glyphicon glyphicon-eye-open"></span> Quản lí giáo viên</a>
			</div>
		</div>
	</div>	
	
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			<div class="panel panel-default">
				  <div class="panel-heading">Chọn nội dung</div>
				  <div class="panel-body">
						<div class="list-group">
						  
						  <a href="/Admin_Home_Headmaster/workComplete" class="list-group-item <?php if(pzk_request()->get('action') == 'workComplete'){ echo 'active';} ?>">Mức độ hoàn thành công việc</a>
						  <a href="/Admin_Home_Headmaster/listTeacher" class="list-group-item <?php if(pzk_request()->get('action') == 'listTeacher'){ echo 'active';} ?>">Danh sách giáo viên</a>
					
						</div>
				  </div>
			</div>
		</div>
		<div class="col-xs-12 col-md-10">
			{children all}
			
		</div>
	</div>	
</div>