<?php get_header(); ?>

<main id="main">
	<section id="home" class="hero">
		<div class="hero-container">
			<div class="hero-content">
				<p class="eyebrow">Personal Portfolio</p>
				<h1>Hello, I'm <span class="highlight"><?php miki_opt('miki_name'); ?></span></h1>
				<p class="hero-subtitle"><?php miki_opt('miki_role'); ?></p>
				<p class="hero-description"><?php miki_opt('miki_tagline'); ?></p>
				<div class="hero-actions">
					<a href="#projects" class="btn btn-primary">View Projects</a>
					<a href="#contact" class="btn btn-outline">Contact Me</a>
				</div>
			</div>

			<div class="hero-image" aria-label="Mikiyas Shemels profile photo">
				<img src="<?php echo esc_url(get_theme_mod('miki_profile_image', get_template_directory_uri() . '/assets/images/profile.jpg')); ?>"
					alt="<?php echo esc_attr(get_theme_mod('miki_name', 'Mikiyas Shemels')); ?>">
				<div class="hero-shape" aria-hidden="true"></div>
			</div>
		</div>
	</section>

	<section id="about" class="about section">
		<div class="about-container">
			<div class="section-heading">
				<span class="section-kicker">About</span>
				<h2>About Me</h2>
				<p><?php miki_opt('miki_about_intro'); ?></p>
			</div>

			<div class="about-details">
				<article class="about-item">
					<h3><i class="fas fa-graduation-cap" aria-hidden="true"></i> Education</h3>
					<p><?php miki_opt('miki_education'); ?></p>
				</article>
				<article class="about-item">
					<h3><i class="fas fa-laptop-code" aria-hidden="true"></i> Experience</h3>
					<p><?php miki_opt('miki_experience'); ?></p>
				</article>
				<article class="about-item">
					<h3><i class="fas fa-rocket" aria-hidden="true"></i> Goals</h3>
					<p><?php miki_opt('miki_goals'); ?></p>
				</article>
				<article class="about-item">
					<h3><i class="fas fa-heart" aria-hidden="true"></i> Interests</h3>
					<p><?php miki_opt('miki_interests'); ?></p>
				</article>
			</div>
		</div>
	</section>

	<section id="skills" class="skills section">
		<div class="section-heading">
			<span class="section-kicker">Skills</span>
			<h2>My Skills</h2>
		</div>

		<ul class="skills-grid">
			<?php
			$skill_icons = array(
				'HTML' => 'fab fa-html5',
				'CSS' => 'fab fa-css3-alt',
				'JavaScript' => 'fab fa-js',
				'React' => 'fab fa-react',
				'PHP' => 'fas fa-code',
				'Java' => 'fab fa-java',
				'Laravel' => 'fab fa-laravel',
				'NodeJS' => 'fab fa-node-js',
				'MySQL' => 'fas fa-database',
				'PostgreSQL' => 'fas fa-database',
			);
			$skills_raw = get_theme_mod('miki_skills', 'HTML, CSS, JavaScript, React, PHP, Java, Laravel, NodeJS, MySQL, PostgreSQL');
			$skills = array_filter(array_map('trim', explode(',', $skills_raw)));

			foreach ($skills as $skill):
				$icon_key = strtoupper($skill) === 'MYSQL' ? 'MySQL' : $skill;
				$icon = isset($skill_icons[$icon_key]) ? $skill_icons[$icon_key] : 'fas fa-code';
				?>
				<li>
					<div class="skill-icon"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></div>
					<h3><?php echo esc_html($skill); ?></h3>
				</li>
				<?php
			endforeach;
			?>
		</ul>
	</section>

	<section id="projects" class="projects section">
		<div class="section-heading">
			<span class="section-kicker">Projects</span>
			<h2>Projects</h2>
		</div>

		<div class="project-grid">
			<?php
			$image_base = get_template_directory_uri() . '/assets/images/';
			$projects = array(
				array(
					'title' => 'Class Management System',
					'description' => 'A comprehensive system for managing class schedules, student records, and academic resources efficiently.',
					'url' => 'https://github.com/mikiyas47/Class-Managment-System',
					'slider_class' => '',
					'images' => array(
						array('file' => 'Screenshot_3-12-2025_201941_localhost.jpeg', 'alt' => 'Class management login screen'),
						array('file' => 's.jpeg', 'alt' => 'Class management students dashboard'),
					),
				),
				array(
					'title' => 'Smart Parking System',
					'description' => 'An IoT-based solution for real-time parking spot detection and management to reduce traffic congestion.',
					'url' => 'https://github.com/mikiyas47/smart_parking_system',
					'slider_class' => 'slider-delay-1',
					'images' => array(
						array('file' => 'Screenshot_3-12-2025_212347_localhost.jpeg', 'alt' => 'Smart parking map search page'),
						array('file' => 'Screenshot_3-12-2025_212425_localhost.jpeg', 'alt' => 'Smart parking area cards'),
					),
				),
				array(
					'title' => 'Food Delivery System',
					'description' => 'A user-friendly platform for ordering food online, featuring restaurant listings and order tracking.',
					'url' => 'https://github.com/mikiyas47/Food_Delivery',
					'images' => array(
						array('file' => 'Screenshot_3-12-2025_21550_localhost.jpeg', 'alt' => 'Food delivery menu page'),
					),
				),
				array(
					'title' => 'Network Marketing Management System',
					'description' => 'A mobile-focused system for network marketing teams, with placement tree, contacts, product sharing, earnings, rank, and profile management.',
					'url' => 'https://github.com/mikiyas47/NMMS',
					'slider_class' => 'slider-delay-2 slider-4',
					'image_class' => 'mobile-screenshots',
					'images' => array(
						array('file' => 'Screenshot_20260519-194148_APP.jpg', 'alt' => 'Network marketing dashboard screen'),
						array('file' => 'Screenshot_20260519-194344_APP.jpg', 'alt' => 'Network marketing products screen'),
						array('file' => 'Screenshot_20260519-194507_APP.jpg', 'alt' => 'Network marketing profile screen'),
						array('file' => 'Screenshot_20260519-194544_APP.jpg', 'alt' => 'Network marketing earnings screen'),
					),
				),
			);

			foreach ($projects as $project):
				$is_slider = count($project['images']) > 1;
				$image_class = isset($project['image_class']) ? ' ' . $project['image_class'] : '';
				?>
				<article class="project-card">
					<a href="<?php echo esc_url($project['url']); ?>" target="_blank" rel="noopener noreferrer"
						class="project-link">
						<div
							class="project-image<?php echo $is_slider ? ' slider-container' : ''; ?><?php echo esc_attr($image_class); ?>">
							<?php if ($is_slider): ?>
								<div
									class="slider-wrapper<?php echo isset($project['slider_class']) && !empty($project['slider_class']) ? ' ' . esc_attr($project['slider_class']) : ''; ?>">
									<?php foreach ($project['images'] as $image): ?>
										<img src="<?php echo esc_url($image_base . $image['file']); ?>"
											alt="<?php echo esc_attr($image['alt']); ?>">
									<?php endforeach; ?>
								</div>
							<?php else: ?>
								<img src="<?php echo esc_url($image_base . $project['images'][0]['file']); ?>"
									alt="<?php echo esc_attr($project['images'][0]['alt']); ?>">
							<?php endif; ?>
						</div>
					</a>
					<div class="project-info">
						<h3><?php echo esc_html($project['title']); ?></h3>
						<p><?php echo esc_html($project['description']); ?></p>
					</div>
				</article>
				<?php
			endforeach;
			?>
		</div>

		<div class="project-container">
			<p>Check out more on GitHub:</p>
			<a href="<?php echo esc_url(get_theme_mod('miki_github', 'https://github.com/mikiyas47')); ?>"
				class="github-link" target="_blank" rel="noopener noreferrer">
				<i class="fab fa-github" aria-hidden="true"></i>
				Visit My GitHub Profile
			</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>