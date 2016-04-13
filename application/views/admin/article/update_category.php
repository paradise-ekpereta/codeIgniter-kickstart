<h1 class="page-header">Categories</h1>

<div class="row">
  <?= form_open('',['class'=>'form-validate form-horizontal']); ?>
             <div class="form-group">
                <label for="name" class="control-label col-sm-2">Name:</label>
                <div class="col-md-4">
                    <input type="text" value="<?= $category->name; ?>" class="input form-control validate[required]" name="name" placeholder="Category Name" maxlenght="255">
                </div>
                <label for="order" class="control-label col-sm-2">Order:</label>
                <div class="col-md-4">
                    <input type="number" class="input form-control validate[required]" min="1" name="category_order" value="<?= $category->cat_order; ?>" placeholder="Category Order">
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="control-label col-sm-2"></label>
                <div class="col-md-10">
                    <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-pencil"></span> Update</button>
                </div>
            </div>
  <?= form_close(); ?>
</div>