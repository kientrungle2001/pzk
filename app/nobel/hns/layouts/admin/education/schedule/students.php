<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
//var_dump($classroom);die;
$students = $data->getStudents();
?>


<h1 class="text-center">Lớp {classroom[gradeNum]}{classroom[className]} Niên khóa {classroom[schoolYear]}</h1>
<div class="row">
<div class="col-md-4">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudents">
  Thêm học sinh
</button>

<h2>Tìm kiếm học sinh</h2>
<form id="searchForm" class="form form-inline" onsubmit="searchStudents(); return false;">
<table class="table table-condense table-hovered">
<tr>
<td class="text-left">
<input type="text" name="username" class="form-control" /> 
</td>
<td class="text-right">
<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
</td>
</tr>
</table>
</form>
<div id="searchResult">

</div>
</div>
<div class="col-md-8">
<h2 class="text-center">Danh sách lớp</h2>
<table class="table table-condense table-bordered" id="addNewStudents">
	<tr class="bg-success">
		<th>#</th>
		<th>ID</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Ngày sinh</th>
		<th>Chi tiết</th>
		<th>Hành động</th>
	</tr>
{each $students as $index => $student}
	<tr>
		<td><input class="student_checkbox" type="checkbox" name="students[]" value="{student[id]}" /></td>
		<td>{? echo ($index+1)?}. {student[studentId]}</td>
		<td><a href="/Admin_Schedule_Teacher/student/{classroom[id]}/{student[id]}/{student[studentId]}">{student[username]}</a></td>
		<td><a href="/Admin_Schedule_Teacher/student/{classroom[id]}/{student[id]}/{student[studentId]}">{student[name]}</a></td>
		<td>{? echo date('d/m/Y', strtotime($student['birthday']))?}</td>
		<td><a class="btn btn-primary btn-xs" href="/Admin_Schedule_Teacher/student/{classroom[id]}/{student[id]}/{student[studentId]}">Chi tiết</a></td>
		<td><a class="btn btn-primary btn-xs" href="/Admin_User/edit/{student[studentId]}?backHref=<?php echo urlencode(BASE_REQUEST . '/Admin_Schedule_Teacher/students/' . $classroom['id'])?>">Sửa</a>
		
		<button class="btn btn-danger btn-xs" onclick="removeStudentFromClassroom({student[id]}); return false;">Xóa</button></td>
	</tr>
{/each}
	
</table>
<form class="form form-inline">
	<select	id="classrooms" class="form-control">
		<option value="">Chọn lớp</option>
		{each $classrooms as $cr}
		<option value="{cr[id]}">Niên khóa {cr[schoolYear]} - Lớp {cr[gradeNum]}{cr[className]}</option>
		{/each}
	</select>
	<button class="btn btn-warning" onclick="addStudentsToOtherClassroom(); return false;">Chuyển lớp</button>
</form>
</div>

<!-- Modal -->
<div class="modal fade" id="addStudents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm mới học sinh</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- tạo form nhập liệu -->
        <form id="addForm" class="form " onsubmit="register(); return false;">
		  <div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Họ và tên: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<input type="text" class="form-control" id="txtName">
		    </div>		   
		  </div>
		<div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Tên đăng nhập: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<input type="text" class="form-control" id="txtUsername">
		    </div>		   
		</div>
		<div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Mật khẩu: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<input type="text" class="form-control" id="txtPassword">
		    </div>		   
		</div>
		<div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Email: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<input type="text" class="form-control" id="txtEmail">
		    </div>		   
		</div>
		<div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Ngày sinh: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<input id="txtBirthday" name="birthday" type="date"  autocomplete="OFF" src=""/> 
		    </div>		   
		</div>
		<div class="form-group">
		  	<div class="col-md-4">
		  		<label for="nam">Giới tính: </label>		    	
		  	</div>
		    <div class="col-md-8">
		    	<select style="width:150px; height:40px;" id="txtSex" name="sex">
	                <option value="1">Nam</option>
	                <option value="0">Nữ</option>
                </select>
		    </div>		   
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
		</form>
        <!-- kết thúc form -->
     </div>
      <div class="modal-footer">
        
        <!-- <button type="button" class="btn btn-primary">Thêm mới</button> -->
      </div>
    </div>
  </div>
</div>

</div>
<script type="text/javascript">
// dang ky tk hs moi
function register(){

	var txtName = $('#txtName').val();
	var txtUsername = $('#txtUsername').val();
	var txtPassword = $('#txtPassword').val();
	var txtEmail = $('#txtEmail').val();
	var txtBirthday = $('#txtBirthday').val();
	var txtSex = $('#txtSex').val();
	var classroomId = {classroom[id]};
	var gradeNum = {classroom[gradeNum]};
	//var className = {classroom[className]};
	var schoolYear = {classroom[schoolYear]};
	//alert(schoolYear);
	//return false;
	/*
	*/
	
	if((txtName == '') || (txtUsername == '') || (txtPassword == '') || (txtBirthday == '')){
		alert("Bạn hãy nhập đầy đủ thông tin"); return false;
	}
	$.ajax({
		url: '/Admin_Schedule_Teacher/addNewStudent',
		data: {
			txtName: txtName,
			txtUsername: txtUsername,
			txtEmail: txtEmail,
			txtBirthday: txtBirthday,
			txtPassword: txtPassword,
			txtSex: txtSex,
			classroomId: classroomId,
			gradeNum: gradeNum,
			
			schoolYear: schoolYear
		},
		
		success: function(result) {
			if(result == -1){
				alert('Tên đăng nhập đã tồn tại');
				return false;
			}else if(result == 2){
				alert('Học sinh này đã có trong lớp');
				return false;
			}else{
				$('#addStudents').modal('hide')
				$('#addNewStudents').append(result);
			}
		}
	});
}
function searchStudents() {
	var formData = $('#searchForm').serializeForm();
	$.ajax({
		url: '/Admin_Schedule_Teacher/searchStudent',
		data: formData,
		success: function(students) {
			$('#searchResult').html(students);
		}
	});
}

function addStudentToClassroom(studentId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/addStudent',
		data: {
			classroomId: {classroom[id]},
			studentId: studentId
		},
		type: 'POST',
		success: function(resp) {
			if(resp == '1') {
				// ok
				window.location.reload();
			} else {
				// not ok
				alert('Đã có trong danh sách lớp');
			}
		}
	});
}

function removeStudentFromClassroom(id) {
	if(confirm('Bạn có chắc muốn xóa không?')) {
		$.ajax({
			url: '/Admin_Schedule_Teacher/removeStudent',
			data: {
				id: id
			},
			type: 'POST',
			success: function(resp) {
				if(resp == '1') {
					// ok
					window.location.reload();
				} else {
					// not ok
					alert('Không có trong danh sách lớp');
				}
			}
		});
	}
}

function addStudentToOtherClassroom(id, classroomId) {

	$.ajax({
		url: '/Admin_Schedule_Teacher/changeStudentClassroom',
		data: {
			classroomId: classroomId,
			id: id
		},
		type: 'POST',
		success: function(resp) {
			
		}
	});
	
}

function addStudentsToOtherClassroom() {
	var classroomId = $('#classrooms').val();
	
	var studentIds = getSelectedStudentIds();
	//console.log(studentIds);
	
	if(!classroomId) {
		alert('Bạn cần chọn lớp cần chuyển đến');
		return false;
	}
	
	if(!studentIds.length) {
		alert('Bạn cần chọn học sinh cần chuyển lớp');
		return false;
	}
	if(confirm('Bạn có chắc muốn chuyển lớp cho những học sinh này?')) {
		studentIds.forEach(function(studentId) {

			addStudentToOtherClassroom(studentId, classroomId);

		});
		setTimeout(function() {
			window.location.reload();
		}, studentIds.length * 500);
	}
}

function getSelectedStudentIds() {
	
	var ids = [];
	$(".student_checkbox:checked").each(function(){

		ids.push($(this).val());

	});
	return ids;
}
</script>
</div>