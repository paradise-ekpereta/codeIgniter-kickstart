<h1 class="page-header">Create Page</h1>

<div class="row">
  <?= form_open_multipart('',['class'=>'form-validate form-horizontal']); ?>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">title:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('title') ?>" class="input form-control validate[required]" name="title" placeholder="Page title" maxlength="255">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Name:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('name') ?>" class="input form-control validate[required]" name="name" placeholder="Menu name" maxlength="255">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Order:</label>
                <div class="col-md-10">
                    <input type="number" min="1" value="<?= set_value('page_order') ?>" class="input form-control validate[required]" name="page_order" placeholder="Menu Order" maxlength="3">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Status:</label>
                <div class="col-md-10">
                    <select name="status" class="form-control validate[required]">
                        <option value="">Choose Status</option>
                        <option value="published">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Content:</label>
                <div class="col-md-10">
                    <textarea name="content" class="form-control validate[required]" placeholder="Page Body" style="min-height: 300px;"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="control-label col-sm-2"></label>
                <div class="col-md-10">
                    <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> Create</button>
                </div>
            </div>
  <?= form_close(); ?>

</div>