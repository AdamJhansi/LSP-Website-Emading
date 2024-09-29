<?php
include('template/header.php');
include('admin/config_query.php');

$db = new database();
$articles = $db->show_publish_data(); ?>
<section class="section">
	<div class="container">
		<div class="row mb-4">
			<div class="col-sm-6">
				<h2 class="posts-entry-title">E-Mading</h2>
			</div>
		</div>
		<?php if (empty($articles)) : ?>
			<div class="row">
				<div class="col">
					<p>Data kosong. Tidak ada yang ditampilkan.</p>
				</div>
			</div>
		<?php else : ?>
			<div class="row">
				<?php foreach ($articles as $article) : ?>
					<div class="col-lg-4 mb-4">
						<div class="post-entry-alt">
							<a href="detail.php?id_artikel=<?= $article['id_artikel']; ?>" class="img-link">
								<img src="files/<?php echo $article['sampul']; ?>" alt="Image" class="img-fluid" style="max-width: 100px;">
							</a>
							<div class="excerpt">
								<h2><a href="detail.php?id_artikel=<?= $article['id_artikel']; ?>"><?php echo $article['judul']; ?></a></h2>
								<div class="post-meta align-items-center text-left clearfix">
									<span class="d-inline-block mt-1">By <a href="#"><?php echo $article['name']; ?></a></span>
									<span>&nbsp;-&nbsp; <?php echo $article['created_at']; ?></span>
									<br>
									<span>Kategori : <?php echo $article['kategori']; ?></span>
								</div>
								<p><?php echo $article['isi']; ?></p>
								<p><a href="detail.php?id_artikel=<?= $article['id_artikel']; ?>" class="read more">Continue Reading</a></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
include('template/footer.php');
?>