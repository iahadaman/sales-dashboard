  window.addEventListener("load", function () {

    activelink = document.querySelector("a.active");
    activelink.style.color = "#1EA74D";
    activelink.style.backgroundColor = "rgba(30, 167, 77, 0.1)";
    activelink.style.borderRight = "4px solid #1EA74D";

});


$(document).ready(function(){	 

	//select more option functionality on modal

	$('.addMoreOptions').click(function() {
	   remove = document.querySelector(".removeOptions");
	   remove.style.display = "block";
	  var clicks = $(this).data('clicks');
	  if (clicks) {
	  	//even
	       sPlatform = document.querySelector(".second-platform");
	       sPlatform.style.display = "block";


	  } else {
	  	//odd
	       tPlatform = document.querySelector(".third-platform");
	       tPlatform.style.display = "block";
	  }
	  $(this).data("clicks", !clicks);
	});

	//to remove dropdown

	$('.removeOptions').click(function() {

	  var clicks = $(this).data('clicks');
	  if (clicks) {

	    $('#projectSecondPlatform').val('Select Project Platform').trigger("change");
	    tPlatform = document.querySelector(".third-platform");
	    tPlatform.style.display = "none";

	    remove = document.querySelector(".removeOptions");
	    remove.style.display = "none";	    

	  } else {
	  	//odd

	    $('#projectThirdPlatform').val('Select Project Platform').trigger("change");

	    sPlatform = document.querySelector(".second-platform");
	    sPlatform.style.display = "none";

	  }
	  $(this).data("clicks", !clicks);
	});

	//project edit modal dropdown options

	$('.u_addMoreOptions').click(function() {
	   remove = document.querySelector(".u_removeOptions");
	   remove.style.display = "block";
	  var clicks = $(this).data('clicks');
	  if (clicks) {
	  	//even
	       sPlatform = document.querySelector(".u_second-platform");
	       sPlatform.style.display = "block";


	  } else {
	  	//odd
	       tPlatform = document.querySelector(".u_third-platform");
	       tPlatform.style.display = "block";
	  }
	  $(this).data("clicks", !clicks);
	});

	//to remove dropdown

	$('.u_removeOptions').click(function() {

	   var clicks = $(this).data('clicks');
	  if (clicks) {
	  	//even
	  	$('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
	    u_sPlatform = document.querySelector(".u_second-platform");
	    u_sPlatform.style.display = "none";


	  } else {
	  	//odd
	  	$('#u_projectSecondPlatform').val('Select Project Platform').trigger("change");

	    tPlatform = document.querySelector(".u_third-platform");
	    tPlatform.style.display = "none";

	    remove = document.querySelector(".u_removeOptions");
	    remove.style.display = "none";
	  }
	  $(this).data("clicks", !clicks);
	});


	//modal label functionality

 	jQuery('.modal-body button.btnLabel').click(function() {
      jQuery('.modal-body button.ip-btn').removeClass('ip-btn');   
      jQuery('.modal-body button').addClass('c-btn');   
      jQuery(this).removeClass("c-btn");
      jQuery(this).addClass("ip-btn");
    });

    //btn label functionality

 	jQuery('.mainBtn button.btnLabel').click(function() {
      jQuery('.mainBtn button.ip-btn').removeClass('ip-btn');   
      jQuery('.mainBtn button').addClass('c-btn');   
      jQuery(this).removeClass("c-btn");
      jQuery(this).addClass("ip-btn");
    });

	//adding-components page functionality

	$(".flip").click(function() {
		$(".panel").slideToggle('slow');  
		if($(this).children().hasClass('fa-chevron-down'))
		{
			$(this).html('<i class="fas fa-chevron-up"></i>');
		}
		else{
			$(this).html('<i class="fas fa-chevron-down"></i>');
		}
	});
	$(".flip2").click(function() {
		$(".panel2").slideToggle('slow');  
		if($(this).children().hasClass('fa-chevron-down'))
		{
			$(this).html('<i class="fas fa-chevron-up"></i>');
		}
		else{
			$(this).html('<i class="fas fa-chevron-down"></i>');
		}
	});
	$(".flip3").click(function() {
		$(".panel3").slideToggle('slow');  
		if($(this).children().hasClass('fa-chevron-down'))
		{
			$(this).html('<i class="fas fa-chevron-up"></i>');
		}
		else{
			$(this).html('<i class="fas fa-chevron-down"></i>');
		}
	});

});

$(document).ready(function(){
	check_session();
	getClientsData();
	getProjectsData();
});

// ADMIN LOGIN

$("#adminLoginButton").on("click", function() {
	event.preventDefault();
	let login_email = $("#exampleInputEmail").val();
	let login_password = $("#exampleInputPassword").val();
	let n = 5;
		function countDown() {
			n = n - 1;
			if(n > 0) {
				setTimeout(countDown, 1000);
			}else{
				window.location.href = "dashboard.php";
			}
		}

	if(login_email !="" && login_password !="")
	{
		$.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: { type: 1,
			login_email: login_email, 
			login_password: login_password },
			success: function(e){
				if(e==1)
				{~
					$("#loginButton").attr('disabled', '');
					document.getElementById('login_error').setAttribute("class", "alert alert-success");
					document.getElementById('login_error').style.display = 'block';
					$("#login_error").text("You have been logged in! Redirecting you in " + n + " seconds");
					setTimeout(countDown, 1000);
					$("#exampleInputEmail").val("");
					$("#exampleInputPassword").val("");
				}
				else{
					document.getElementById('login_error').style.display = 'block';
					$("#login_error").text("Invalid credentials are provided.");
				}
			}
		})
	}
	else
	{
		document.getElementById('login_error').style.display = 'block';
	}
});

// ADD CLIENTS

$("#addClientBtn").on("click", function() {
	event.preventDefault();
	let name = $("#clientName").val();
	let company = $("#companyName").val();
	let email = $("#clientEmail").val();
	let password = $("#clientPassword").val();
	let description = $("#clientDes").val();
	
	var formData = new FormData(client);
	formData.append('type', 2);
	formData.append('clientName', name);
	formData.append('companyName', company);
	formData.append('clientEmail', email);
	formData.append('clientPassword', password);
	formData.append('clientDes', description);

	if(name != "" && company != "" && email != "" && password != "")
	{
		$.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: formData,
			mimeType:'multipart/form-data',
			contentType: false,
			cache: false,
			processData: false,
			success: function(e){
				if(e==1){
					$("#client_error").css("display", "block");
					$("#client_error").removeClass("alert-danger");
					$("#client_error").addClass("alert-success");
					$("#client_error").text("Client Added Successfully!");
					setTimeout(function() {
				    $('#client_error').fadeOut('fast');
					}, 3000); 
					$("#clientName").val("");
					$("#companyName").val("");
					$("#clientEmail").val("");
					$("#clientPassword").val("");
					$("#clientDes").val("");
					$("#exampleFormControlFile").val("");
					getClientsData();
				}
				else{
					$("#client_error").css("display", "block");
					$("#client_error").removeClass("alert-success");
					$("#client_error").addClass("alert-danger");
					$("#client_error").text("Something went wrong, Please try again later!!");
				}
			}
		});
	}
	else
	{
		$("#client_error").css("display", "block");
		$("#client_error").removeClass("alert-success");
		$("#client_error").addClass("alert-danger");
		$("#client_error").text("All Fields Are Required");
	}
});

// MANAGE CLIENTS

function getClientsData()
{
 	let readAllclients= "readAllclients";
	$.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: { type: 3, readAllclients: readAllclients },
			success: function(data, status){
				$('#manageClientsData').html(data);
			}
		});
}

// EDIT CLIENT 

$(document).on('click', '.edit_client_data', function(){  
	   event.preventDefault();
	   jQuery.noConflict();

	   $("#updateClientBtn").on("click", function(){
			event.preventDefault();
			jQuery.noConflict();
			let name = $("#u_clientName").val();
			let company = $("#u_companyName").val();
			let email = $("#u_clientEmail").val();
			let password = $("#u_clientPassword").val();
			let description = $("#u_clientDes").val();
			let id = $("#u_clientId").val();
			
			if(name != "" && company != "" && email != "" && password != "")
			{
				$.ajax({
					type: 'POST',
					url: 'admin-backend.php',
					data: {type: 5, id: id , name: name, company: company, email: email, password: password, description: description},
					success: function(e){
						if(e==1){
							document.getElementById('update_client_error').setAttribute("class", "alert alert-success");
							document.getElementById('update_client_error').style.display = 'block';
							$("#update_client_error").text("Client Data Updated Successfully!!");
							setTimeout(function() {
						    $('#update_client_error').fadeOut('fast');
						    	$('#editClient').modal('hide');  
							}, 2000); 
							getClientsData();
						}
						else 
						{
							document.getElementById('update_client_error').style.display = 'block';
							$("#update_client_error").text("Error: Try Again Later!!");
						}
					}
				});
			}
			else
			{
				document.getElementById('update_client_error').style.display = 'block';
				$("#update_client_error").text("All Fields Are Required!!");
			}
	   });

       var employee_id = $(this).attr("id");  
      	$.ajax({
            url:"admin-backend.php",  
            method:"POST",  
            data:{type: 4,
            	employee_id:employee_id},  
            dataType:"json",  
            success:function(data){  
                $('#u_clientName').val(data.user_name);  
                $('#u_companyName').val(data.user_company);  
                $('#u_clientEmail').val(data.user_email);  
                $('#u_clientPassword').val(data.user_password);  
                $('#u_clientDes').val(data.user_description);  
                $('#u_clientId').val(data.user_id);  
                $('#editClient').modal('show');  
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
       		console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
    }
    });  
});

// DELETE CLIENT

$(document).on('click', '.delete_client_data', function(){  
	   event.preventDefault();
	   jQuery.noConflict();

    	let employee_id = $(this).attr("id");  
    	$('#deleteModal').modal('show');  

    	$("#deleteBtn").on("click", function(){
			event.preventDefault();
			jQuery.noConflict();
			
			$.ajax({
				type: 'POST',
				url: 'admin-backend.php',
				data:{type: 6,
            	employee_id:employee_id},  
            	success:function(e){  
            		window.location.href = "client.php";
				}
			});
			
	   });
});

// CREATE PROJECTS

setTimeout(function() {
	$fired_button = $(".modal-body button.btnLabel").val(); 
	  $(".modal-body button.btnLabel").click(function() {
     $fired_button = $(this).val();   
});
}, 200);

$("#CreateProjectForm").submit(function(event){
	let p_platform = $("#projectPlatform").val();
    let ps_platform = $("#projectSecondPlatform").val();
    let pt_platform = $("#projectThirdPlatform").val();
    if(p_platform != null || ps_platform != null || pt_platform!= null)
    {
		$.ajax({
		type: 'POST',
		url: 'admin-backend.php',
		data: {type: 12, p_platform: p_platform, ps_platform: ps_platform, pt_platform: pt_platform},
		success: function(e){			
			if(e==0)
			{
				$("#project_error").css("display", "block");
				$("#project_error").removeClass("alert-success");
				$("#project_error").addClass("alert-danger");
				$("#project_error").text("Something went wrong, Please try again later!!");
			}		
		}
		});
    }

    let p_name = $("#projectName").val();
	let p_client = $("#projectClientName").val();
	let p_date = $("#projectDate").val();
	let p_description = $("#projectDescription").val();
	let p_label = $fired_button;
	
	var formData = new FormData(project);
	formData.append('type', 7);
	formData.append('p_name', p_name);
	formData.append('p_client', p_client);
	formData.append('p_date', p_date);
	formData.append('p_description', p_description);
	formData.append('p_label', p_label);

	if(p_name != "" && p_client != "" && p_date != "")
	{
		$.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: formData,
			mimeType:'multipart/form-data',
			contentType: false,
			cache: false,
			processData: false,
			success: function(e){
				if(e==1){
					$("#project_error").css("display", "block");
					$("#project_error").removeClass("alert-danger");
					$("#project_error").addClass("alert-success");
					$("#project_error").text("Project Added Successfully!");
					setTimeout(function() {
					    $('#project_error').fadeOut('fast');
					}, 3000); 

					$("#projectName").val("");
					$("#projectDate").val("");
					$("#projectDescription").val("");
					$("#projectClientProfile").val("");
					 getProjectsData();	

					$('#projectClientName').val('Select Client').trigger("change");	

					$('#projectPlatform').val('Select Project Platform').trigger("change");
					$('#projectSecondPlatform').val('Select Project Platform').trigger("change");
					tPlatform = document.querySelector(".third-platform");
	                tPlatform.style.display = "none";

					$('#projectThirdPlatform').val('Select Project Platform').trigger("change");
					sPlatform = document.querySelector(".second-platform");
					sPlatform.style.display = "none";  

					remove = document.querySelector(".removeOptions");
    				remove.style.display = "none";	   			
				}
				else{
					$("#project_error").css("display", "block");
					$("#project_error").removeClass("alert-success");
					$("#project_error").addClass("alert-danger");
					$("#project_error").text("Something went wrong, Please try again later!!");
				}
			}
		});
	}
	else
	{
		$("#project_error").css("display", "block");
		$("#project_error").removeClass("alert-success");
		$("#project_error").addClass("alert-danger");
		$("#project_error").text("All Fields Are Required");
	}	
});

// MANAGE PROJECTS

setTimeout(function() {
		$fired_main_button = "In Progress"; 		
		$(".mainBtn button.btnLabel").click(function(){
	     $fired_main_button = $(this).val();	
	     readAllprojects = $fired_main_button; 
	     $.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: { type: 8, readAllprojects: readAllprojects },
			success: function(data, status){
				$('#progressCardsData').html(data);
			}
		});	  
		});
}, 500);

function getProjectsData()
{
	let readAllprojects = "In Progress";
	$.ajax({
			type: 'POST',
			url: 'admin-backend.php',
			data: { type: 8, readAllprojects: readAllprojects },
			success: function(data, status){
				$('#progressCardsData').html(data);
			}
	});	
}

// EDIT PROJECT 

$(document).on('click', '.edit_project_data', function(){  
	   event.preventDefault();
	   jQuery.noConflict();

	   $("#updateProjectBtnn").on("click", function(){
			event.preventDefault();
			jQuery.noConflict();
			let u_pName = $("#u_projectName").val();
			let u_pClient = $("#u_projectClientName").val();
			let u_pPlatformId = $("#pplatform_Id").val();			
			let u_pDate = $("#u_projectDate").val();
			let u_pDescription = $("#u_projectDescription").val();
			let u_pLabel = $fired_button;
			let id = $("#u_projectId").val();	

			let firstplatform = $("#u_projectPlatform").val();
			let secondplatform = $("#u_projectSecondPlatform").val();
			let thirdplatform = $("#u_projectThirdPlatform").val();

			if(u_pName != "" && u_pClient != "" && u_pPlatformId != "" && u_pDate != "")
			{
				$.ajax({
					type: 'POST',
					url: 'admin-backend.php',
					data: {type: 10, id: id , u_pName: u_pName, u_pClient: u_pClient, u_pDate: u_pDate, u_pPlatformId: u_pPlatformId, u_pDescription: u_pDescription, u_pLabel:u_pLabel, firstplatform: firstplatform, secondplatform: secondplatform, thirdplatform: thirdplatform},
					success: function(e){
						if(e==1){
							document.getElementById('update_project_error').setAttribute("class", "alert alert-success");
							document.getElementById('update_project_error').style.display = 'block';
							$("#update_project_error").text("Project Data Updated Successfully!!");
							setTimeout(function() {
						    $('#update_project_error').fadeOut('fast');
						    	window.location.href = "project.php";
							}, 2000); 
					
						}
						else 
						{
							document.getElementById('update_project_error').style.display = 'block';
							$("#update_project_error").text("Error: Try Again Later!!");
						}
					}
				});
			}
			else
			{
				document.getElementById('update_project_error').style.display = 'block';
				$("#update_project_error").text("All Fields Are Required!!");
			}
	   });

       var project_id = $(this).attr("id");  
       $.ajax({
		    url:"admin-backend.php",  
            method:"POST",  
            data:{type: 13,
            project_id:project_id},  
            dataType:"json",  
		    success: function(e){			
				if(e==0)
				{
					$("#project_error").css("display", "block");
					$("#project_error").removeClass("alert-success");
					$("#project_error").addClass("alert-danger");
					$("#project_error").text("Something went wrong, Please try again later!!");
				}	
				else{
					//when the platforms are 3
					if(e.web_platform == 1 && e.andriod_platform == 1 && e.ios_platform == 1)
					{
						 $('#u_projectPlatform').val("Web Development");  

						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "block";
						 $('#u_projectSecondPlatform').val("Andriod Development");
						 remove = document.querySelector(".u_removeOptions");
	   					 remove.style.display = "block"; 

	   					 sPlatform = document.querySelector(".u_second-platform");
		                 sPlatform.style.display = "block";
						 $('#u_projectThirdPlatform').val("IOS Development");
					}
					//when the platforms are 2
					if(e.web_platform == 0 && e.andriod_platform == 1 && e.ios_platform == 1)
					{
						 $('#u_projectPlatform').val("Andriod Development");  

						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "block";
						 $('#u_projectSecondPlatform').val("IOS Development");
						 remove = document.querySelector(".u_removeOptions");
	   					 remove.style.display = "block";

	   					 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";

					}
					else if(e.web_platform == 1 && e.andriod_platform == 1 && e.ios_platform == 0)
					{
						$('#u_projectPlatform').val("Web Development");  

						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "block";
						 $('#u_projectSecondPlatform').val("Andriod Development");
						 remove = document.querySelector(".u_removeOptions");
	   					 remove.style.display = "block";

	   					 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";
					}
					else if(e.web_platform == 1 && e.andriod_platform == 0 && e.ios_platform == 1)
					{
						$('#u_projectPlatform').val("Web Development");  

						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "block";
						 $('#u_projectSecondPlatform').val("IOS Development");
						 remove = document.querySelector(".u_removeOptions");
	   					 remove.style.display = "block";

	   					 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";
					}
					//when the platform is one
					if(e.web_platform == 1 && e.andriod_platform == 0 && e.ios_platform == 0)
					{
						 $('#u_projectPlatform').val("Web Development");  

						 $('#u_projectSecondPlatform').val('Select Project Platform').trigger("change");
						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "none";

						 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";

						 remove = document.querySelector(".u_removeOptions");
	    				 remove.style.display = "none";	   
					}
					else if(e.web_platform == 0 && e.andriod_platform == 1 && e.ios_platform == 0)
					{
						 $('#u_projectPlatform').val("Andriod Development");  

						  $('#u_projectSecondPlatform').val('Select Project Platform').trigger("change");
						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "none";

						 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";

						 remove = document.querySelector(".u_removeOptions");
	    				 remove.style.display = "none";	   
					}
					else if(e.web_platform == 0 && e.andriod_platform == 0 && e.ios_platform == 1)
					{
						 $('#u_projectPlatform').val("IOS Development");

						  $('#u_projectSecondPlatform').val('Select Project Platform').trigger("change");
						 tPlatform = document.querySelector(".u_third-platform");
		                 tPlatform.style.display = "none";

						 $('#u_projectThirdPlatform').val('Select Project Platform').trigger("change");
						 sPlatform = document.querySelector(".u_second-platform");
						 sPlatform.style.display = "none";  

						 remove = document.querySelector(".u_removeOptions");
	    				 remove.style.display = "none";	   
					}
				}	
			}
		});


      	$.ajax({
            url:"admin-backend.php",  
            method:"POST",  
            data:{type: 9,
            	project_id:project_id},  
            dataType:"json",  
            success:function(data){  
                $('#u_projectName').val(data.project_name);  
                $('#u_projectClientName').val(data.project_client);  
                $('#pplatform_Id').val(data.project_platformId); 
                $('#u_projectDate').val(data.project_date);  
                $('#u_projectDescription').val(data.project_description);  
                $('#u_projectId').val(data.project_id);  

                $('#editProject').modal('show');  
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
       		console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
    }
    });  
});

// DELETE PROJECT

$(document).on('click', '.delete_project_data', function(){  
	   event.preventDefault();
	   jQuery.noConflict();

    	let project_id = $(this).attr("id");  
    	$('#deleteModal').modal('show');  

    	$("#deleteBtn").on("click", function(){
			event.preventDefault();
			jQuery.noConflict();
			
			$.ajax({
				type: 'POST',
				url: 'admin-backend.php',
				data:{type: 11,
            	project_id:project_id},  
            	success:function(e){  
            		window.location.href = "project.php";
				}
			});
			
	   });
});



function check_session()
{          	
    $.ajax({
        url : 'session-out.php',
        method: 'POST',
        success : function(data){           
            if(data == '1')
            {
            	alert('Your Session has been Expired');
            	window.location.href = "login.php";
            }
        }
    });
       
}
setInterval(function()
{
	check_session();
},5000);