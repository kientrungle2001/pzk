{? 
$request 	= pzk_request();
$controller = $request->get('controller');
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 	= pzk_or($data->get('mdsize'), 12);
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->set('selectLabel', $data->get('label'));
}
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		{ifvar nocompact}<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>{/if}<div class="col-xs-12"><select
			class="select2-container form-control select2" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}" {ifprop relative}onchange="loadRelativeData_{data.id}_{rand}('{data.relative}', '{data.referenceField}', this.value);"{/if}>
            <?php
												$parents = _db ()->select ( pzk_or($data->get ('fields'), '*') )->from ( $data->get ('table') )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->orderBy(pzk_or(@$data->get('orderBy'), 'id asc'))->result ();
												if (isset ( $parents [0] ['parent'] )) {
													$parents = treefy ( $parents );
													if($nocompact) {
														echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
													} else {
														echo "<option value='0'>" . pzk_or ( @$data->get ('selectLabel'), '&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc' ) . " </option>";
													}
												} else {
													echo "<option value='0'>" . pzk_or ( @$data->get ('selectLabel'), '--Chọn một mục--' ) . " </option>";
												}
												?>
											
			{each $parents as $parent}
			<option value="<?php echo $parent[$data->get('show_value')]; ?>">
				<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
				#{parent[id]} - <?php echo $parent[$data->get('show_name')]; ?>
			</option> {/each}

		</select>
		</div>
		<script type="text/javascript">
			$('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
			$( "#{? echo $data->get('index')?}{rand}" ).select2( { placeholder: "{? echo $data->get('label')?}", maximumSelectionSize: 6 } );
			{ifprop relative}
				function loadRelativeData_{data.id}_{rand}(relative, referenceField, value) {
					var sl = $('#{data.index}{rand}').parents('form').find('select[name='+relative+']');
					$.ajax({
						url: '/{controller}/relative',
						data: {
							relative: relative,
							referenceField: referenceField,
							value: value
						},
						success: function(resp) {
							sl.html(resp);
						}
					});
					
				}
			{/if}
        </script>
	</div>
</div>