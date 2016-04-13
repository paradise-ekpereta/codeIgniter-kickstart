<h1 class="page-header">Categories</h1>

<div class="row">
  <?= form_open('',['class'=>'form-validate form-horizontal']); ?>
             <div class="form-group">
                <label for="name" class="control-label col-sm-2">Name:</label>
                <div class="col-md-4">
                    <input type="text" value="<?= set_value('name') ?>" class="input form-control validate[required]" name="name" placeholder="Category Name">
                </div>
                <label for="order" class="control-label col-sm-2">Order:</label>
                <div class="col-md-4">
                    <input type="number" class="input form-control validate[required]" min="1" name="category_order" value="<?= set_value('category_order'); ?>" placeholder="Category Order" maxlenght="255">
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="control-label col-sm-2"></label>
                <div class="col-md-10">
                    <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> Add</button>
                </div>
            </div>
            <?= form_close(); ?>

  <div class="table-responsive">
            <table class="table table-striped data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Order</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 0; foreach ($this->category_model->getCategories() as $category) { ?>
              <?php $i++; ?>
                <tr id="row-<?= $category->id; ?>">
                  <td><?= $i; ?></td>
                  <td><?= $category->name; ?></td>
                  <td><?= $category->cat_order; ?></td>

                  <td>
                  <button type="button" class="btn btn-primary btn-xs" onclick="window.location='/admin/edit_category/<?= $category->id; ?>'"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                  <button type="button" class="btn btn-danger btn-xs" onclick="window.location='/admin/delete_category/<?= $category->id; ?>'"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
</div>