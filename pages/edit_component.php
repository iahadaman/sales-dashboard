<?php 
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
} 
if(!isset($_SESSION["admin_name"])) 
{
  header('location: login.php');
}
require_once '../partials/header.php';
include('backend/connection.php');
if($_GET['id'] == '') {
    header('Location: dashboard.php');
}
$question_id = htmlspecialchars(mysqli_real_escape_string($con, $_GET['id']));


function getQuestion() {
	global $con, $question_id;
    $getData = mysqli_query($con, "SELECT * FROM questions WHERE question_id = '$question_id'");
    $getData__assoc = mysqli_fetch_assoc($getData);
    echo $getData__assoc['question'];
}

function getDescription() {
	global $con, $question_id;
    $getData = mysqli_query($con, "SELECT * FROM questions WHERE question_id = '$question_id'");
    $getData__assoc = mysqli_fetch_assoc($getData);
    echo $getData__assoc['description'];
}
?>
    <div class="wrapper">      
       <?php require_once '../partials/sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/navigation.php';?> 

      		<div id="content-section">
 				<div class="row">  
	                <div id="component-style" class="web-bg col-md-12 col-sm-12 mt-3">
	                	<h5 class="pull-left d-inline mb-0">Components</h5>
	                	<div class="float-right">
	                		<button style="width:100px;" class="btn btn-bg"> Save </button>
	                	</div> 	 
	                	<hr class="mt-4">
	                	<div class="row">
	                		<div class="col-5">
	                		  <div class="form-group">
							    <label for="exampleInputEmail1">Question</label>
							    <input type="email" class="form-control" id="question_input" aria-describedby="emailHelp" placeholder="eg. 1. How big your app is?" value="<?php echo getQuestion(); ?>">
							  </div>
							</div>
	                		<div class="col-5">
	                			 <div class="form-group">
								    <label for="exampleInputEmail1">Select Platform</label>
								      <select class="form-control" disabled>
									  <option selected value="1">Default</option>
									  <option value="2">Two</option>
									  <option value="3">Three</option>
									</select>
								  </div>			 
	                		</div>
	                		<div class="col-5">
	                		  <div class="form-group">
							    <label for="exampleInputEmail1">Description</label>
							    <input type="email" class="form-control" id="question_description" aria-describedby="emailHelp" placeholder="eg. Select only one option" value="<?php echo getDescription(); ?>">
							  </div>
							</div>
	                	</div>
        		    </div>
                    <div id="ahad">

                    </div>

                    <?php 
                        $getOptions = mysqli_query($con, "SELECT * FROM options WHERE parent_qid = '$question_id'");
                        while($q = mysqli_fetch_array($getOptions)) {
                            echo '
                            
                            <div id="component-style" id="lol_'. $q['option_id'] .'"  class="web-bg col-md-12 col-sm-12 mt-3">
                            
                            <h5 class="pull-left d-inline mb-0">'. $q['name'] .' <small id="m"></small></h5>
                            <div class="mr-4 float-right">
                             <span class="flip" onclick="chevronArrow('. $q['option_id'] .')"><i class="fas fa-chevron-down"></i></span>
                            </div> 	 
                        
                            <div class="panel" id="panel_'. $q['option_id'] .'">
                                    <hr class="mt-4">
                                <div class="row">
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="email" class="form-control" id="title_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['name'] .'" onkeyup="document.getElementById(\'m\').innerHTML = \'Be Sure to save! click on the save button below\';">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Add Image <strong style="color:#FF0000; font-weight:300;"> (SVG only)</strong></label>
                                            <input type="file" class="form-control-file file_'. $q['option_id'] .'" id="component_icon" name="lol">
                                       </div>	 
                                    </div>
                                    <div class="col-10">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="email" class="form-control" id="description_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg.  Your app probably has around 10-15 key feature pages" value="'. $q['description'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Cost</label>
                                        <input type="email" class="form-control" id="mincost_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['c1'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Cost</label>
                                        <input type="email" class="form-control" id="maxcost_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['c2'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Hours</label>
                                        <input type="email" class="form-control" id="minhours_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['h1'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Hours</label>
                                        <input type="email" class="form-control" id="maxhours_'. $q['option_id'] .'" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['h2'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5" style="display: flex; justify-content: flex-start;">
                                    <div class="form-group">
                                    <button class="mr-5 float-right btn" onclick="saveChanges('.$q['option_id'].')">Save</button>
                                    
                                    </div>
                                    <a href="#" style="color: red;margin-top: 7px;" onclick="deleteOption('.$q['option_id'].')">Delete</a>
                                  </div>
                                </div>
                                
                            </div>
                            
                           </div>                           
                            ';
                        }
                    ?>

        		   	<div id="component-style" class="col-md-12 col-sm-12 mt-3 mb-3">
        		   		<button class="mr-5 float-right btn"  data-toggle="modal" data-target="#exampleModal">Add More Options</button>
        		   	</div>

        	    </div>
			</div>
        </div>
	</div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="email" class="form-control" id="title" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Add Image <strong style="color:#FF0000; font-weight:300;"> (SVG only)</strong></label>
                                            <input type="file" class="form-control-file file" id="component_icon" name="lol">
                                       </div>	 
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="email" class="form-control" id="description" aria-describedby="emailHelp" placeholder="eg.  Your app probably has around 10-15 key feature pages" >
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Cost</label>
                                        <input type="email" class="form-control" id="mincost" aria-describedby="emailHelp" placeholder="eg. Small" >
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Cost</label>
                                        <input type="email" class="form-control" id="maxcost" aria-describedby="emailHelp" placeholder="eg. Small" >
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Hours</label>
                                        <input type="email" class="form-control" id="minhours" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Hours</label>
                                        <input type="email" class="form-control" id="maxhours" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-5" style="display: flex; justify-content: flex-start;">
                                    <div class="form-group">
                                   
                                    </div>
                                  </div>
                                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addNewComponent(<?php echo $question_id; ?>);">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php require_once '../partials/footer.php';?>   
<script>
    function saveChanges(id) {
        let optionId = id;
        let title = $("#title_"+id).val();
        let description = $("#description_" + id).val();
        let minCost = $("#mincost_" + id).val();
        let maxCost = $("#maxcost_" + id).val();
        let minHours = $("#minhours_" + id).val();
        let maxHours = $("#maxhours_" + id).val();
        let file = $('.file_'+id).prop('files')[0];
        console.log(file);
        var form_data = new FormData();
        form_data.append('option_id', id);
        form_data.append('file', file);
        form_data.append('title', title);
        form_data.append('description', description);
        form_data.append('minCost', minCost);
        form_data.append('maxCost', maxCost);
        form_data.append('minHours', minHours);
        form_data.append('maxHours', maxHours);
        form_data.append('type', 20);


        if(title == "" || description == "" || minCost == "" || maxCost == "" || minHours == "" || maxHours == "") {
            alert("All fields are required!");
        } else {
            Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                url: "admin-backend.php",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, 
                success: function(e) {
                    if(e == 1) {
                        Swal.fire('Saved!', '', 'success').then(() => {
                            location.reload();
                        })
                        
                    }
                }
            })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
})

        }
    }

    function addNewComponent(q_id) {
//  let optionId = id;
        let question_id = q_id;
        let title = $("#title").val();
        let description = $("#description").val();
        let minCost = $("#mincost").val();
        let maxCost = $("#maxcost").val();
        let minHours = $("#minhours").val();
        let maxHours = $("#maxhours").val();
        let file = $('.file').prop('files')[0];
        console.log(file);
        var form_data = new FormData();
       // form_data.append('option_id', id);
        form_data.append('file', file);
        form_data.append('title', title);
        form_data.append('description', description);
        form_data.append('minCost', minCost);
        form_data.append('maxCost', maxCost);
        form_data.append('minHours', minHours);
        form_data.append('maxHours', maxHours);
        form_data.append('type', 21);
        form_data.append('q_id', q_id);
        if(title == "" || description == "" || minCost == "" || maxCost == "" || minHours == "" || maxHours == "") {
            alert("All fields are required!");
        } else {
            Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                url: "admin-backend.php",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, 
                success: function(e) {
                    if(e == 1) {
                        Swal.fire('Saved!', '', 'success').then(() => {
                            location.reload();
                        })
                        
                    }
                }
            })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
})

        }
    }

    function deleteOption(o_id) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                url: "admin-backend.php",
                type: "POST",
                data: {type: 22, option_id: o_id}, 
                success: function(e) {
                    if(e == 1) {
                        Swal.fire('Saved!', '', 'success').then(() => {
                            location.reload();
                        })
                        
                    }
                }
            })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
})      
    }
</script>