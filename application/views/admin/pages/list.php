<h1 class="page-header">Pages</h1>

<div class="row">
          <div class="table-responsive">
            <table class="table table-striped data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>title</th>
                  <th>Menu Order</th>
                  <th>Menu name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 0; foreach ($pages as $page) { ?>
              <?php $i++; ?>
                <tr id="row-<?= $page->id; ?>">
                  <td><?= $i; ?></td>
                  <td><?= $page->title; ?></td>
                  <td><span class="label label-primary"><?= $page->page_order; ?></span></td>
                  <td><?= $page->name; ?></td>
                  <td>
                    <?php if($page->status == 'published') { ?>
                      <span class="label label-success"><?= $page->status; ?></span>
                    <?php }else{ ?>
                      <span class="label label-danger"><?= $page->status; ?></span>
                    <?php } ?>
                  </td>

                  <td>
                   <button type="button" class="btn btn-primary btn-xs" onclick="window.location='/admin/edit_page/<?= $page->id; ?>'"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                   <button type="button" class="btn btn-danger btn-xs" onclick="window.location='/admin/delete_page/<?= $page->id; ?>'"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
</div>