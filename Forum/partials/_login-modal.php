

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalLabel">login to aDiscuss</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action='/Forum/partials/_handellogin.php' method='POST'>
        <div class="modal-body"> 
                <div class="mb-3">
                    <label for="loginemail" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else 
                    </div> -->
                </div>
                <div class="mb-3">
                    <label for="loginpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                </div>
                <button type="login" class="btn btn-success">login</button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>