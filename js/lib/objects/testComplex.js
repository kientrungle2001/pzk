PzkTestComplex = PzkComplexObj.pzkExt({	
	layout: 
		`<bg.(*= co.context*) id="(*= co.id*)">
			<container>
				(* for(var i = 1; i < 5; i++){ *)
				<h(*= i*) class="text-center">Hello, World (*= i*)!</h(*= i*)>
				(* } *)
				(* for(var i = 0; i < data.items.length; i++){ *)
				<hello name="(*= data.items[i].title*)" />
				(* } *)
			</container>
		</bg.(*= co.context*)>`,
	loadData: function() {
		this.data = {
			items: [
				{
					id: 1,
					title: 'Kiên Lê Trung'
				},
				{
					id: 2,
					title: 'Lê Trung Kiên'
				}
			]
		};
	}
});