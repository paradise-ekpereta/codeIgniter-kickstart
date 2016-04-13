<h1 class="page-header">Articles</h1>

<div class="row">

  <div class="table-responsive">
            <table class="table table-striped data-table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Thumb</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Content</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 0; foreach ($articles as $article) { ?>
              <?php $i++; $cat = $this->category_model->getCategory($article->category_id); ?>
              <?php $content = substr($article->content, 0,200).'...'; ?>
                <tr id="row-<?= $article->id; ?>">
                  <td><?= $i; ?></td>
                  <td><img src="/uploads/articles/<?= $article->thumb; ?>" class="thumb"></td>
                  <td><?= $article->title; ?></td>
                  <td><?= $cat->name; ?></td>
                  <td><?= $content; ?></td>
                  <td><?= $article->created_at; ?></td>
                  <td>
                  <button type="button" class="btn btn-primary btn-xs" onclick="window.location='/admin/edit_article/<?= $article->id; ?>'"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                  <button type="button" class="btn btn-danger btn-xs" onclick="window.location='/admin/delete_article/<?= $article->id; ?>'"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
</div>