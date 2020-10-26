function toast(res, autoclose = false){
	$('#toast').html(`
		<div class="alert-toast">
			<div class="box-toast bg-${((res.status) ? 'green' : 'red' )}-500 ">
				<span class="message-toast">${res.msg}
					<div class="close-toast"><i class="fa fa-times"></i></div>
				</span>
			</div>
		</div>
	`);
 	if(autoclose) {
  		setTimeout(() => {
			$('#toast').empty();
		}, 3000);
	}
};

$( document ).on( 'click', '.close-toast', function(){
	$( '#toast' ).empty();
});