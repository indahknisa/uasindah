  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
      </div>

      
      <?php
      // arahkan form submit ke kontroller 'user/update' 
      echo form_open_multipart('user/update'); 
      ?>

          <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" value='<?php echo $username ?>'>
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="password" value='<?php echo $password ?>'>
              </div>
          </div>

          <div class="form-group row">
              <label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="fullname" value='<?php echo $fullname ?>'>
              </div>
          </div>
           <div class="form-group row">
              <label for="idrole" class="col-sm-2 col-form-label">Role</label>
              <div class="col-sm-10">
                  <select class="form-control" name="idrole">

                  <?php
                      // menampilkan combo box berisi role user
                      foreach ($roles as $role_item):
                  ?>
                      <option value="<?php echo $role_item['idrole']?>"><?php echo $role_item['role']?></option>
                  <?php
                      endforeach;
                  ?>
                  </select>
              </div>
          </div>


          <div class="form-group row">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary mb-2">Update User</button>      
              </div>
          </div>    
      </form>