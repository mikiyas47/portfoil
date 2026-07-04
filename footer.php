	<footer id="contact" class="site-footer">
		<div class="contact-container">
			<h2>Get in Touch</h2>
			<div class="contact-links">
				<a href="mailto:<?php echo esc_attr( get_theme_mod( 'miki_email', 'mikishemels@gmail.com' ) ); ?>" class="contact-item">
					<i class="fas fa-envelope" aria-hidden="true"></i>
					<span><?php echo esc_html( get_theme_mod( 'miki_email', 'mikishemels@gmail.com' ) ); ?></span>
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'miki_telegram', 'https://t.me/Mikesh7' ) ); ?>" class="contact-item" target="_blank" rel="noopener noreferrer">
					<i class="fab fa-telegram" aria-hidden="true"></i>
					<span>Telegram</span>
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'miki_github', 'https://github.com/mikiyas47' ) ); ?>" class="contact-item" target="_blank" rel="noopener noreferrer">
					<i class="fab fa-github" aria-hidden="true"></i>
					<span>GitHub</span>
				</a>
			</div>

			<p class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
