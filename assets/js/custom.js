const IS_MOBILE_DEVICE = window.matchMedia(
	"only screen and (max-width: 767px)",
).matches;
const IS_TAB_DEVICE = window.matchMedia(
	"only screen and (min-width: 768px) and (max-width: 1024px)",
).matches;
const IS_DESKTOP_DEVICE = !IS_MOBILE_DEVICE && !IS_TAB_DEVICE;
const IS_HANDHELD_DEVICE = IS_MOBILE_DEVICE || IS_TAB_DEVICE;

document.addEventListener("DOMContentLoaded", function () {
	if (IS_HANDHELD_DEVICE) {
		new Mmenu(
			"#navbarCollapse",
			{
				offCanvas: {
					position: "right-front",
				},
				navbars: [
					{
						position: "top",
						content: ["<img src='" + SITE_LOGO + "' />"],
					},
					{
						position: "bottom",
						content: THEME_PARAMS.SOCIAL_MEDIA,
					},
				],
			},
			{
				offCanvas: {
					page: {
						selector: "#page",
					},
				},
			},
		);
	}

	// Sticky Menu
	if (IS_DESKTOP_DEVICE && THEME_PARAMS.STICKY_HEADER) {
		window.addEventListener("scroll", function () {
			stickyMenu();
		});
		stickyMenu();
	}
	function stickyMenu() {
		let scroll = window.scrollY;
		const header = document.querySelector("header.main-header");
		if (scroll > 0) {
			if (!header.classList.contains("sticky")) {
				header.classList.add("sticky");
			}
		} else {
			header.classList.remove("sticky");
		}
	}

	// Init Fancybox
	if (document.querySelector("[data-fancybox]")) {
		Fancybox.bind("[data-fancybox]");
	}

	if (document.getElementById("homeServices")) {
		const homeServicesSwiper = new ThemeSwiper("#homeServices", {
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: true,
				pauseOnMouseEnter: true,
			},
			slidesPerView: {
				0: { slidesPerView: 1 },
				768: { slidesPerView: 1 },
				1025: { slidesPerView: 1 },
			},
			pagination: {
				el: "#homeServicesPagination",
				clickable: true,
			},
			spaceBetween: 25,
			speed: 400,
		});

		const homeServicesImageSwiper = new ThemeSwiper(
			"#homeServicesImageSwiper",
			{
				loop: true,
				autoplay: false,
				slidesPerView: {
					0: { slidesPerView: 1 },
					768: { slidesPerView: 1 },
					1025: { slidesPerView: 1 },
				},
				allowTouchMove: false,
				speed: 400,
			},
		);

		homeServicesSwiper.controller.control = homeServicesImageSwiper;
		homeServicesImageSwiper.controller.control = homeServicesSwiper;
	}

	if (document.getElementById("homeInsurances")) {
		new ThemeSwiper("#homeInsurances", {
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: true,
			},
			slidesPerView: {
				0: { slidesPerView: 1 },
				768: { slidesPerView: 3 },
				1025: { slidesPerView: 5 },
			},
			spaceBetween: 50,
			speed: 400,
		});
	}

	if (document.getElementById("homeReviews")) {
		new ThemeSwiper("#homeReviews", {
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: true,
			},
			slidesPerView: {
				0: { slidesPerView: 1 },
				768: { slidesPerView: 1 },
				1025: { slidesPerView: 1 },
			},
			pagination: {
				el: "#homeReviews + .swiper-pagination",
				clickable: true,
			},
			spaceBetween: 25,
			speed: 400,
		});
	}

	if (document.querySelectorAll(".doctor-content").length) {
		// mCustomScrollBar
		initMenusScrollbar();

		function initMenusScrollbar() {
			jQuery(".doctor-content").mCustomScrollbar({
				callbacks: {
					onInit: () => bugFix(jQuery(".doctor-content")),
				},
			});
		}

		function bugFix(scrollbar) {
			const draggerRail = jQuery(scrollbar).find(".mCSB_draggerRail");
			const draggerContainer = jQuery(scrollbar).find(
				".mCSB_draggerContainer",
			);
			if (
				draggerRail.length > 0 &&
				draggerRail.parent().hasClass("mCSB_dragger")
			) {
				draggerContainer.append(draggerRail);
			}
		}
	}

	/**
	 * Appointment Button
	 * Show the appointment modal when the button is clicked
	 */
	if (document.querySelectorAll(".appointment-btn").length > 0) {
		document.querySelectorAll(".appointment-btn").forEach((btn) => {
			btn.addEventListener("click", function (e) {
				if (document.getElementById("appointmentModal")) {
					const modal = new bootstrap.Modal(
						document.getElementById("appointmentModal"),
					);
					modal.show();
				}
			});
		});
	}
});

document.addEventListener("gform/post_init", (event) => {
	const gForms = document.querySelectorAll(".gform_wrapper");
	gForms.forEach((form) => {
		form.style.transition = "opacity 0.5s, transform 0.5s";
		form.style.opacity = "1";
	});
});

class ThemeSwiper {
	constructor(selector, options = {}, navigationSelector) {
		this.selector = selector;
		this.options = options;
		this.navigationSelector =
			navigationSelector || `${this.selector} + .swiper-nav`; // Default navigation selector
		this.swiper = null;

		return this.init();
	}

	init() {
		const slideCount = document.querySelectorAll(
			`${this.selector} .swiper-slide`,
		).length;
		const enableSwiper = this.shouldEnableSwiper(slideCount);

		if (!enableSwiper) {
			this.hideNavigation();
		}

		const { slidesPerView } = this.options;

		// Set default options
		const defaultOptions = {
			loop: enableSwiper,
			allowTouchMove: enableSwiper,
			autoplay: enableSwiper
				? {
						delay: 5000,
						disableOnInteraction: false,
					}
				: false,
			speed: 500,
			preventClicksPropagation: false,
			spaceBetween: 30,
			navigation: {
				nextEl: `${this.selector}Next`,
				prevEl: `${this.selector}Prev`,
			},
			breakpoints: Object.keys(slidesPerView).reduce(
				(acc, breakpoint) => {
					acc[breakpoint] = slidesPerView[breakpoint];
					return acc;
				},
				{},
			),
		};

		// Merge default options with custom options
		const swiperOptions = { ...defaultOptions, ...this.options };

		this.swiper = new Swiper(this.selector, swiperOptions);

		return this.swiper; // Return the Swiper instance
	}

	shouldEnableSwiper(slideCount) {
		const { slidesPerView } = this.options;

		if (
			IS_MOBILE_DEVICE &&
			slideCount > (slidesPerView[0]?.slidesPerView || 1)
		)
			return true;
		if (
			IS_TAB_DEVICE &&
			slideCount > (slidesPerView[768]?.slidesPerView || 2)
		)
			return true;
		if (
			IS_DESKTOP_DEVICE &&
			slideCount > (slidesPerView[1025]?.slidesPerView || 3)
		)
			return true;
		return false;
	}

	hideNavigation() {
		const navElement = document.querySelector(this.navigationSelector);

		if (navElement) {
			navElement.style.display = "none";

			const parent = document.querySelector(this.selector).parentNode;
			if (parent.classList.contains("swiper-with-nav")) {
				parent.style.paddingLeft = "0px";
				parent.style.paddingRight = "0px";
			}
		}
	}
}
