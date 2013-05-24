<div id="main-index-content">
	<div class="section round">
		<h3 class="section-title round"><img src="images/ico-rss-16.png" /> ULTIMAS NOTICIAS</h3>
		<ul>

<?php for($i=1; $i<=4; $i++){?>
			<li class="prev-article">
				<?php echo anchor('login','<img class="thumb round" src="images/no-image.jpg" />','target="_blank"');?>
				<ul class="prev-article-data">
					<li class="prev-article-date date-min">2 de Mayo, 2012</li>
					<li class="prev-article-title">Título de Noticia Reciente #<?php echo $i;?></li>
					<li class="prev-article-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quam est, rutrum vel interdum in, iaculis vitae purus.</li>
				</ul>
				<div class="btn">Leer Más</div>
			</li>
<?php } ?>
		</ul>
	</div>
</div>