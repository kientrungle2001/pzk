PzkPaymentNganluong = PzkObj.pzkExt({

	init: function() {
	},
  Nganluong: function(nganluong){
    var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'pay_nganlluong',url:nganluong});
  }
});