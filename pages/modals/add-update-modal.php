 <div class="modal fade" id="addUpdate" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="additem">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Title</label>
			    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="exampleInputEmail1">Link (Required for designing process)</label>
			    <input type="email" class="form-control" id="link" aria-describedby="emailHelp" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="add_item_btn">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>
 