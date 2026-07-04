<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
	<div class="header-inner">
		<a class="site-brand" href="#home" aria-label="<?php bloginfo( 'name' ); ?> home">Miki</a>

		<button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
			<span></span>
			<span></span>
			<span></span>
		</button>

		<nav class="site-nav" id="site-nav" aria-label="Primary navigation">
			<a href="#home" class="nav-link">Home</a>
			<a href="#about" class="nav-link">About</a>
			<a href="#skills" class="nav-link">Skills</a>
			<a href="#projects" class="nav-link">Projects</a>
			<a href="#contact" class="nav-link">Contact</a>
		</nav>
	</div>
</header>
