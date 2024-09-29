<?php
include('template/header.php');
include('admin/config_query.php');

if (isset($_GET['id_artikel'])) {
  $articleId = intval($_GET['id_artikel']);
  $db = new database();
  $article = $db->get_artikel_by_id($articleId);

  if ($article) { ?>
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('files/<?php echo $article['sampul']; ?>');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-6">
            <div class="post-entry text-center">
              <h1 class="mb-4"><?php echo $article['judul']; ?></h1>
              <div class="post-meta align-items-center text-center">
                <span class="d-inline-block mt-1">Dibuat Oleh <a><?php echo $article['name']; ?></a></span>
                <br>
                <span>&nbsp;Pada :&nbsp; <?php echo $article['created_at']; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="container">
        <div class="row blog-entries element-animate">
          <div class="col-md-12 col-lg-12 main-content">
            <div class="post-content-body">
              <?php echo $article['isi']; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
  } else {
    echo "<p>Article not found.</p>";
  }
} else {
  echo "<p>No article ID provided.</p>";
}

include('template/footer.php');
?>