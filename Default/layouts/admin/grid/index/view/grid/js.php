<div id="{data.id}">
</div>
<script>
pzk.onload('list', function() {
	
	this.layout = '/Default/layouts/' + this.layout + '.html';
	this.$().html(this.html());
});
</script>