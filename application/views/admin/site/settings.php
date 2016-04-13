<h1 class="page-header">Site Settings</h1>

<div class="row">
  <?= form_open_multipart('',['class'=>'form-validate form-horizontal']); ?>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Logo:</label>
                <div class="col-md-5">
                    <input type="file" name="logo">
                    <input type="hidden" name="test" value="hello">
                </div>
                <div class="col-md-6">
                   <?php if(!empty($this->option_model->get('logo'))){ ?>
                     <img class="logo-preview" src="/uploads/site/<?= $this->option_model->get('logo');  ?>" alt="">
                   <?php } ?>
                </div>
            </div>
             <div class="form-group">
                <label for="keywords" class="control-label col-sm-2">Keywords:</label>
                <div class="col-md-10">
                    <textarea name="option[keywords]" class="form-control validate[required]" placeholder="Site Meta Keywords"><?= $this->option_model->get('keywords'); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-sm-2">Descriptions:</label>
                <div class="col-md-10">
                    <textarea name="option[description]" class="form-control validate[required]" placeholder="Site Meta Descriptions"><?= $this->option_model->get('description'); ?></textarea>
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