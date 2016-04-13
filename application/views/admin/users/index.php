<h1 class="page-header">Manage Users</h1>

<div class="row">
          <div class="table-responsive">
            <table class="table table-striped data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 0; foreach ($this->user_model->findAll() as $user) { ?>
              <?php $i++; ?>
                <tr id="row-<?= $user->id; ?>">
                  <td><?= $i; ?></td>
                  <td><?= $user->firstname; ?></td>
                  <td><?= $user->lastname; ?></td>
                  <td><?= $user->email; ?></td>
                  <td><span class="label label-info"><?= ucfirst($user->account_type); ?></span></td>
                  <td>
                      <?php if($user->status == 'active') { ?>
                      <span class="label label-success"><?= ucfirst($user->status); ?></span>
                      <?php }else{ ?>
                      <span class="label label-danger"><?= ucfirst($user->status); ?></span>
                      <?php } ?>
                  </td>
                  <td>
                  <?php if($user->account_type!='admin') { ?>
                  <?php if($user->status == 'active') { ?>
                  <button type="button" class="btn btn-warning btn-xs" onclick="window.location='/admin/deactivate_user/<?= $user->id; ?>'"><span class="glyphicon glyphicon-cog"></span> Deactivate</button>
                  <?php }else{ ?>
                  <button type="button" class="btn btn-primary btn-xs" onclick="window.location='/admin/activate_user/<?= $user->id; ?>'"><span class="glyphicon glyphicon-cog"></span> Active</button>
                  <?php } ?>
                      <button type="button" class="btn btn-danger btn-xs" onclick="window.location='/admin/delete_user/<?= $user->id; ?>'"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                  <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
</div>