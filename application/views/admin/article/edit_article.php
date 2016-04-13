<h1 class="page-header">Update Article</h1>

<div class="row">
  <?= form_open_multipart('',['class'=>'form-validate form-horizontal']); ?>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Thumb:</label>
                <div class="col-md-4">
                    <input type="file" name="thumb">
                </div>
                <label for="thumb" class="control-label col-sm-2">Current Thumb:</label>
                <div class="col-md-4">
                    <img class="edit-article-preview" src="/uploads/articles/<?= $article->thumb; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="name" class="control-label col-sm-2">title:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= $article->title; ?>" class="input form-control validate[required]" name="title" placeholder="Article title">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Category:</label>
                <div class="col-md-10">
                    <select name="category" class="form-control validate[required]">
                      <option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
                      <?php foreach ($categories as $category) { ?>
                        <?php if($cat->id != $category->id){ ?>
                         <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Content:</label>
                <div class="col-md-10">
                    <textarea name="content" class="form-control validate[required]" placeholder="Article Body" style="min-height: 300px;"><?= $article->content; ?></textarea>
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