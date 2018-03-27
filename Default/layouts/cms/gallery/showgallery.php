
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/default/layouts/cms/gallery/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/default/layouts/cms/gallery/css/style.css"> <!-- Resource style -->
	<script src="/default/layouts/cms/gallery/js/modernizr.js"></script> <!-- Modernizr -->
</head>
<body>
	<header>
		<h1>Các hoạt động vui chơi</h1>
	</header>
<?php $gallerys=$data->getGallery(); ?>
{each $gallerys as $gallery}
	<section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="/default/layouts/cms/gallery/img/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>{gallery[title]}</h2>
				<p>{gallery[brief]}</p>
				<a href="/gallery/thumbnailgallery?id={gallery[id]}" class="cd-read-more">Xem thêm</a>
				<a href="/gallery/slidegallery?id={gallery[id]}" class="cd-read-more">Xem slide</a>
				<span class="cd-date">{gallery[date]}</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
				<img src="/default/layouts/cms/gallery/img/cd-icon-movie.svg" alt="Movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				
				<?php $subimage=$data->getSubgallery($gallery['id']); ?>
				{each $subimage as $gallery2}
				<img src="{gallery2[url]}"></img>
				{/each}
				
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section> <!-- cd-timeline -->
{/each}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/default/layouts/cms/gallery/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>