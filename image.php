<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<input type="button" id="btn" value="Create" />
	<br>
	<br>
	<div id="my-node1">
	  <textarea>Change this if you want and take the picture</textarea>
	</div>
	<div id="here-appear-theimages">
		<p>
		Here the images will be appended when you click the button
		</p>
		
	</div>
	
	
	
	
	<table id="my-node">
	  <tr>
		<td>cell 1</td>
		<td>cell 2</td>
	  </tr>
	  <tr>
		<td>cell 3</td>
		<td>cell 4</td>
	  </tr>
	</table>

	<h2 style='color:green;' id="msg"><h2>

	<script type="text/javascript" src="dom-to-image.js"></script>
	
	<script type="text/javascript">
				
			document.getElementById('btn').addEventListener('click', function() {

			  	var node = document.getElementById('my-node');

				domtoimage.toPng(node)
				    .then(function(dataUrl) {
				    console.log(dataUrl);
				     
				    img = new Image();
				    img.src = dataUrl;
				    	
				    document.getElementById("here-appear-theimages").appendChild(img);

                    var req = new XMLHttpRequest();
                    req.open("POST","mainImage.php",true);
                    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    req.onreadystatechange = function()
                    {
                        if(req.readyState == 4 && req.status == 200)
                        {
                            var response = req.responseText;
                            console.log(response);
                            document.getElementById("msg").innerHTML = "Success!";
                            
                        }
                       
                    }
                    req.send("name="+ dataUrl);
				      
				    })
				    .catch(function(error) {
				      console.error('oops, something went wrong!', error);
				    });

				    domtoimage.toBlob(node).then(function (blob) {
        			 	//window.saveAs(blob, 'my-node.png'); // same as png. blob saves it as a png file
   					 
   					});

			});
	
	</script>
</body>
</html>