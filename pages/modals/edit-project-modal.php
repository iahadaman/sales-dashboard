 <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title">Update Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form onsubmit="return false;" method="POST">
        	<div id="update_project_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
			  <div class="form-group">
			    <label for="projectName">Project Name</label>
			    <input type="text" class="form-control" id="u_projectName" placeholder="Enter your project name">
			     <input type="hidden" class="form-control" id="u_projectId">
			  </div>
			   <div class="form-group">
			    <label for="projectClientName">Client Name</label>
			      <select id="u_projectClientName" class="form-control">
				  <option disabled selected>Select Client</option>			 
				  <?php
				  include 'backend/connection.php';
				  $getAllClients = mysqli_query($con, "SELECT * FROM webtrixpro_users WHERE user_isAdmin !=1 ORDER BY user_id desc");
   		 			while($allclients = mysqli_fetch_array($getAllClients)){
				  ?>
				  <option value="<?php echo $allclients['user_name'] ?>"><?php echo $allclients['user_name'] ?></option>
				  <?php } ?>
				</select>
			  </div>
			 <input type="hidden" class="form-control" id="pplatform_Id">
			 
			    <div class="form-group">
			    <label for="projectPlatform">Project Platform</label>
			     <select id = "u_projectPlatform" class="form-control">
				  <option disabled selected>Select Project Platform</option>
				  <option value="Web Development">Web Development</option>
				  <option value="Andriod Development">Andriod Development</option>
				  <option value="IOS Development">IOS Development</option>
				</select>

				<div class="u_third-platform mt-4">
					<select id = "u_projectSecondPlatform" class="form-control">
						<option disabled selected>Select Project Platform</option>
						<option value="Web Development">Web Development</option>
						<option value="Andriod Development">Andriod Development</option>
						<option value="IOS Development">IOS Development</option>
					</select>
				</div>

				<div class="u_second-platform mt-4">
					<select id = "u_projectThirdPlatform" class="form-control">
						<option disabled selected>Select Project Platform</option>
						<option value="Web Development">Web Development</option>
						<option value="Andriod Development">Andriod Development</option>
						<option value="IOS Development">IOS Development</option>
					</select>
				</div>

				<a class="u_addMoreOptions float-right" href="#">Add more</a>
				<a class="mr-3 u_removeOptions float-right" href="#">Remove Dropdown</a>

			  </div>
			 
			   <div class="form-group">
			    <label for="projectDate">Project Start Date</label>
			    <input type="text" class="form-control" id="u_projectDate" placeholder="mm/dd/yyyy">
			   </div>
			 	<div class="form-group">
			    <label for="projectDescription">Description (Optional)</label>
			    <textarea class="form-control" id="u_projectDescription" rows="3"></textarea>
			  	</div>
			  	<div class="form-group">
			    <label class="d-block" for="projectLabel">Label</label>
			     <div class="btn-group">
		          <button id="inProgreeLabel" value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
		          <button id="completedLabel" value="Completed" class="btn c-btn btnLabel">Completed</button>
			  	</div>
			   <button id="updateProjectBtnn" type="submit" class="btn-submit d-block mt-5 float-right btn">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>
