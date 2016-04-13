<h1 class="page-header">Write</h1>

<div class="row">
  <?= form_open_multipart('',['class'=>'form-validate form-horizontal']); ?>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Thumb:</label>
                <div class="col-md-10">
                    <input type="file" name="thumb" class="validate[required]">
                </div>
            </div>
             <div class="form-group">
                <label for="name" class="control-label col-sm-2">title:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('title') ?>" class="input form-control validate[required]" name="title" placeholder="Article title" maxlength="255">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Category:</label>
                <div class="col-md-10">
                    <select name="category" class="form-control validate[required]">
                      <option value="">Choose category</option>
                      <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                      <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Content:</label>
                <div class="col-md-10">
                    <textarea name="content" class="form-control validate[required]" placeholder="Article Body" style="min-height: 300px;"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="control-label col-sm-2"></label>
                <div class="col-md-10">
                    <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-plus"></span> Add</button>
                </div>
            </div>
  <?= form_close(); ?>

</div>