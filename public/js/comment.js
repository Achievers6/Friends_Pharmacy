$(document).ready(function()
{
    alert("enter");
		$('.reply').keyup(function(e)
		{
			if (e.keyCode == 13) 
			{
				var post_id = $(this).attr('post_id');
				var reply = $(this).val();

				$.post('reply.php', {post_id:post_id, reply:reply});
				$('.reply').val('');
			}
		});
});

//document.getElementById(".reply")
//    .addEventListener("keyup", function(event) {
//    event.preventDefault();
//    if (event.keyCode == 13) {
//        document.getElementById(".reply").click();
//         alert("enter");
//    }
//});