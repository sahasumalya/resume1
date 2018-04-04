<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<form method="POST" id="testform">
		

		<input type="text" name="name">
		<button type="submit">Submit</button>

	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){


			$("#testform").on('submit',function(event){
			event.preventDefault();
			var data = new FormData(this);

			console.log(data.get('name'));


			 $.ajax({url: "resume.php",
			 	data:data,
			 	method:"POST",
			  success: function(result){
		        alert(result);
		    }});

		});

			



		});

		


	</script>
	
</body>
</html>