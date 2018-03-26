<script type="text/javascript">
pzk.load(['/3rdparty/jquery/jstree/dist/jstree.min.js', '/3rdparty/jquery/jstree/dist/themes/default/style.min.css']);
</script>
<div class="container" style="margin-top: 50px;">

	

	<div class="row">
		<div class="col-xs-12 col-sm-3">
		<!--tree-->
		<div id="html-demo">
		<ul>
			
		</ul>
		</div>
		</div>
		<!--content-->
		<div class="col-xs-12 col-sm-9">
			<!---tab-->
			<ul class="nav nav-tabs">
				<li  class="active"><a data-toggle="tab" href="#homeds">Danh sách học sinh</a></li>
				<li><a data-toggle="tab" href="#menuds">Đánh giá học tập</a></li>
				
			</ul>
			<!--content-->
			<div class="tab-content">
				<div id="homeds" class="tab-pane fade in active">
					<!---danh sach hoc sinh-->
					<div id="jstree-result"></div>
				</div>
				<div id="menuds" class="tab-pane fade">
					<!---danh gia-->
					<div id="rsRV"></div>
				</div>
				
			</div>
	
		</div>
	</div>

</div>



<script type="text/javascript">
	$('#html-demo').jstree({
		'core' : {
			'data' : {
				"url" : function(node) {return "/monitor/areacode/"+node.id },
				"dataType" : "json" // needed only if you do not supply JSON headers
			}
		}
	});
	var selectedId = null;
	$('#html-demo').on('select_node.jstree', function(event, node) {
		var id = node.selected[0];
		selectedId = id;
		$('#jstree-result').template('/Default/skin/students.html', '/monitor/students/' + id);
		$('#rsRV').template('/Default/skin/reviews.html', '/monitor/reviews/' + id);
	});
	
	function show_students(page) {
		$('#jstree-result').template('/Default/skin/students.html', '/monitor/students/' + selectedId + '/' + page);
	}
	
	function accessReview(that, parent){
		var weekYear = $(that).val();
		$('#result-review').template('/Default/skin/accessreview.html', '/monitor/accessReview/' + parent + '/' + weekYear);
	}
	
	function accessReviewYear(that, parent){
		var year = $(that).val();
		$('#result-review').template('/Default/skin/accessreview.html', '/monitor/accessReviewYear/' + parent + '/' + year);
	}
	
	function accessSummer(that, parent){
		var year = $(that).val();
		$('#result-review').template('/Default/skin/accessreview.html', '/monitor/accessReviewSummer/' + parent + '/' + year);
	}
	
</script>