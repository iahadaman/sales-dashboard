 	 <!-- ADD CLIENT MODAL -->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form method="POST" enctype="multipart/form-data" name="client">
        	  <div id="client_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
			  <div class="form-group">
			    <label for="clientName">Account Executive Name</label>
			    <input type="text" class="form-control" id="clientName" placeholder="Enter your account executive name">
			  </div>
			   <div class="form-group">
			    <label for="companyName">Company Name</label>
			    <input type="text" class="form-control" id="companyName" placeholder="Enter your client’s company name">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlFile">Add File/Image</label>
			    <input type="file" class="form-control-file" name="img_file" id="exampleFormControlFile">
			   </div>
			   <div class="form-group">
			    <label for="clientEmail"> Email</label>
			    <input type="email" class="form-control" id="clientEmail" aria-describedby="emailHelp" placeholder="Enter client’s email Address">
			  </div>
			  <div class="form-group">
			    <label for="clientPassword"> Password</label>
			    <input type="password" class="form-control" id="clientPassword" placeholder="Enter client’s password">
			  </div>

			    <div class="form-group">
			    <label for="clientDes">Description (Optional)</label>
			    <textarea class="form-control" id="clientDes" rows="3"></textarea>
			  	</div>

			   <button id="addClientBtn" type="submit" class="float-right btn btn-submit">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>