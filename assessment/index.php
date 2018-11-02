<?php
include_once 'includes/connect.php';
?>

<html>
	<head>
		<title>Form page</title>
		<style>
			.red {
				color: red;
			}

			.textClass {
				text-decoration: underline; 
				font-style: italic;
			}

			.borderClass {
				border-color: black; 
				border-style: solid;
			}

		</style>
	</head>
	<body>
		<form action="includes/list.php" method="post">
			
			First Name<span class="red">*</span>:<br>
        	<input type="text" name="firstname" required><br><br>
        	
        	Last Name<span class="red">*</span>:<br>
        	<input type="text" name="lastname" required><br><br>
        	
        	Email<span class="red">*</span>:<br>
        	<input type="email" name="email" required><br><br>
        	
        	Address line 1<span class="red">*</span>:<br>
        	<input type="text" name="add1" id="add1"><br>
        	
        	Address line 2:<br>
        	<input type="text" name="add2" id="add2"><br>
        	
        	City<span class="red">*</span>:<br>
        	<input type="text" name="city" id="city"><br>
        	
        	State<span class="red">*</span>:<br>
        	<input type="text" name="state" id="state"><br>
        	
        	Zipcode5<span class="red">*</span>:<br>
        	<input type="text" name="zip5" id="zip5"><br>
        	
        	Zipcode4:<br>
        	<input type="text" name="zip4" id="zip4"><br><br>

        	<input type="radio" name="add" id="originaladd"> Select to submit the entered address<br>
        	<input type="radio" name="add" id="validadd"> Select to submit the validated address <span class="textClass">(FIRST validate the entered address by clicking on the validate button below!)</span><br><br>

        	Address that is going to be stored:
        	<!-- this is going to be a readonly field that displays the address the user selects -->
    		<input id="find" type="text" name="find" size="50" readonly><br><br>
        	
        	<input type="submit" name="submit" value="SUBMIT">

        </form>
		

        <button id="validB">VALIDATE</button><br>
    	Validated/Standardized address: 
    	<div id="stdAdd" class="borderClass"></div><br><br>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>

		$(document).ready(function(){

			$("input[type=radio]").attr('disabled', true);
			$("input[type=submit]").attr('disabled', true);

			$('#validB').on('click', function(){

				var address1 = $('#add1').val();
				var address2 = $('#add2').val();
				var city = $('#city').val();
				var state = $('#state').val();
				var zip5 = $('#zip5').val();
				var zip4 = $('#zip4').val(); 				
				
				var request = new XMLHttpRequest();

	        	var xmlval = '<AddressValidateRequest USERID="624STUDE2250"><Address ID="0"><Address1>'+address1+'</Address1><Address2>'+address2+'</Address2><City>'+city+'</City><State>'+state+'</State><Zip5>'+zip5+'</Zip5><Zip4>'+zip4+'</Zip4></Address></AddressValidateRequest>';

				request.open('GET', 'http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML='+xmlval, true);

				request.onload = function(){

					//appending div to catch all errors
					var container = $('<div/>').append(this.response);
					//if the response contains an error document, alert the user
		            if($(container).find('Error').length){

		            	$("input[type=radio][id=originaladd]").attr('disabled', true);
		            	$("input[type=radio][id=validadd]").attr('disabled', true);
		            	alert($(this.response).find('Description').text());

		            } else {

		            	$("input[type=radio][id=originaladd]").attr('disabled', false);
		            	$("input[type=radio][id=validadd]").attr('disabled', false);

		            	var vAddress1 = $(this.response).find('address1').text();
		            	var vAddress2 = $(this.response).find('address2').text();
		            	var vCity = $(this.response).find('city').text();
		            	var vState = $(this.response).find('state').text();
		            	var vZip5 = $(this.response).find('zip5').text();
		            	var vZip4 = $(this.response).find('zip4').text();

		            	var entireAddress = vAddress1 +' '+ vAddress2 +' '+ vCity +' '+ vState +' '+ vZip5 +' '+ vZip4;

		            	$('#stdAdd').text(entireAddress);

		            	//display the text returned by the response
		            	if($(this.response).find('returntext').length){
		            		alert($(this.response).find('returntext').text());
			            }

			        }
					
				}
				request.send();

			});

			$('input[type=radio][name=add]').change(function(){
				
				//enable submit button after user selects an option
				$("input[type=submit]").attr('disabled', false);
				
				if(this.id == 'originaladd'){

					//if the user selects original address, concatenate the address fields and use it to populate the div, whose value gets sent to the database
					var sendadd = $('#add1').val() +' '+ $('#add2').val() +' '+ $('#city').val() +' '+ $('#state').val() +' '+ $('#zip5').val() +' '+ $('#zip4').val(); 
					$('#find').val(sendadd);

				}else if(this.id == 'validadd'){

					//if the user selects validated address, use it to populate the div  and this value gets sent to the database
					var vAdd = $('#stdAdd').text();
					$('#find').val(vAdd);

				}

			});

		});

        </script>
        
	</body>
</html>
