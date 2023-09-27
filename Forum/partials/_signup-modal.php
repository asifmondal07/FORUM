

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">signup for an aDiscuss account </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action='/Forum/partials/_handelsignup.php' method='POST'>  
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" name="signupPassword">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confrim Password</label>
                        <input type="password" class="form-control" id="signupcPassword" name="signupcPassword">
                    </div> 
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
            </div>
        </form>
    </div>
  </div>
</div>