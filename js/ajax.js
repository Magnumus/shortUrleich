$(document).ready(function() {

	$('form').submit(function(event) {

		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
                $('.shortUrl').html(result);
			},
		});
	
	});

});
function myFunction() {
  var copyText = document.querySelector(".shortUrl");  
  var range = document.createRange();  
  range.selectNode(copyText);  
  window.getSelection().addRange(range);  
  document.execCommand("copy");
  window.getSelection().removeAllRanges(); 
  alert("Copied the text: ");
   
}