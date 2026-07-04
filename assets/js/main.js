document.addEventListener('DOMContentLoaded', function () {
	var toggle = document.getElementById('nav-toggle');
	var nav = document.getElementById('site-nav');
	var links = document.querySelectorAll('a[href^="#"]');
	var sections = document.querySelectorAll('main section[id], footer[id]');
	var navLinks = document.querySelectorAll('.nav-link');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var isOpen = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}

	links.forEach(function (link) {
		link.addEventListener('click', function (event) {
			var target = document.querySelector(link.getAttribute('href'));

			if (!target) {
				return;
			}

			event.preventDefault();
			target.scrollIntoView({ behavior: 'smooth' });

			if (nav && toggle) {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	});

	if ('IntersectionObserver' in window && sections.length) {
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}

				var id = entry.target.getAttribute('id');

				navLinks.forEach(function (navLink) {
					navLink.classList.toggle('is-active', navLink.getAttribute('href') === '#' + id);
				});
			});
		}, { rootMargin: '-45% 0px -45% 0px' });

		sections.forEach(function (section) {
			observer.observe(section);
		});
	}
});
