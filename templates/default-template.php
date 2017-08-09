<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"  type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
html { 
	width: 100%;
}
body:before, body:after {
	position: relative;
}
body {
	background-clip: border-box;
	background-color: rgba(0, 0, 0, 0);
	background-image: url('<?php echo $this->option('background_image'); ?>');
	background-origin: padding-box;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	margin: 0;
	width: 100%;
	height: 100%;
}
.splash-container {
  display: table;
  max-width: 767px;
  margin: 0 auto;
  position: relative;
  text-align: center;
  width: 100%;
}
.splash-content {
  display: table-cell;
  vertical-align: middle;
}
.splash-text {
	color: <?php echo $this->option('text_color'); ?>;
	font-size: <?php echo $this->option('text_size'); ?>px;
	font-weight: bold;
	line-height: 1;
}
.splash-button-area {
	margin: 30px 0 0;
}
.splash-button {
	color: <?php echo $this->option('button_text_color'); ?>;
	font-size: <?php echo $this->option('button_text_size'); ?>px;
	background: <?php echo $this->option('button_bg_color'); ?>;
	font-weight: bold;
	line-height: 1;
	display: inline-block;
	border-radius: 5px;
	padding: 20px;
}
@media screen and (max-width: 1200px) {

}

</style>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo VS_SPLASH_PAGE_ROOT_URL ?>assets/js/jquery.vide.js"></script>
</head>
<body <?php echo ($this->option('background_type') == 'video' ? 'data-vide-bg="'.$this->option('background_video').'"' : ''); ?>>
	<div class="splash-container">
		<div class="splash-content">
			<div class="splash-text">
				<?php echo nl2br($this->option('text')); ?>
			</div>
			<div class="splash-button-area">
				<a class="splash-button" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>"><?php echo $this->option('button_text'); ?></a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			var h = $(window).height();
			$('.splash-container').height(h);

			$(window).resize(function(){
				var h = $(window).height();
				$('.splash-container').height(h);
			})
			$('.splash-button').click(function(e){
				e.preventDefault();
				console.log('clicked');
				 window.location.reload(true);
			})
		});
	</script>
</body>
</html>