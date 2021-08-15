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
								      <select class="form-control">
									  <option selected value="1">Web</option>
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
                            
                            <h5 class="pull-left d-inline mb-0">Option: 1</h5>
                            <div class="mr-4 float-right">
                             <span class="flip" onclick="chevronArrow('. $q['option_id'] .')"><i class="fas fa-chevron-down"></i></span>
                            </div> 	 
                        
                            <div class="panel" id="panel_'. $q['option_id'] .'">
                                    <hr class="mt-4">
                                <div class="row">
    
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg. Small" value="'. $q['name'] .'">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Add Image <strong style="color:#FF0000; font-weight:300;"> (SVG only)</strong></label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                       </div>	 
                                    </div>
                                    <div class="col-10">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg.  Your app probably has around 10-15 key feature pages">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Cost</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Cost</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Min. Hours</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Max. Hours</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                </div>
    
                            </div>
                           </div>                           
                            ';
                        }
                    ?>

        		   	<div id="component-style" class="col-md-12 col-sm-12 mt-3 mb-3">
        		   		<button class="mr-5 float-right btn">Add More Options</button>
        		   	</div>

        	    </div>
			</div>
        </div>
	</div>

<?php require_once '../partials/footer.php';?>   
