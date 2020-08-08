<div class="container-fluid">
	<div class="well">
		<h2 class="text-center">TRANG QUẢN LÍ HỌC SINH</h2>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 text-center">
				<a class="btn btn-primary" href="/Admin_Home_Headmaster/student">
				<span class="glyphicon glyphicon-eye-open"></span> Quản lí học sinh</a>
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
						  
						  <a href="/Admin_Home_Headmaster/study" class="list-group-item <?php if(pzk_request()->getAction() == 'study'){ echo 'active';} ?>">Kết quả học tập</a>
						  <a href="/Admin_Home_Headmaster/complete" class="list-group-item <?php if(pzk_request()->getAction() == 'complete'){ echo 'active';} ?>">Mức độ hoàn thành</a>
						  <a href="/Admin_Home_Headmaster/listStudent" class="list-group-item <?php if(pzk_request()->getAction() == 'listStudent'){ echo 'active';} ?>">Danh sách học sinh</a>
					
						</div>
				  </div>
			</div>
		</div>
		<div class="col-xs-12 col-md-10">
			{children all}
			
		</div>
	</div>	
</div>

