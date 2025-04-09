<script>
    const lazyloadRunObserver = () => {
        const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
        const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    let lazyloadBackground = entry.target;
                    if (lazyloadBackground) {
                        lazyloadBackground.classList.add('e-lazyloaded');
                    }
                    lazyloadBackgroundObserver.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '200px 0px 200px 0px'
        });
        lazyloadBackgrounds.forEach((lazyloadBackground) => {
            lazyloadBackgroundObserver.observe(lazyloadBackground);
        });
    };
    const events = [
        'DOMContentLoaded',
        'elementor/lazyload/observe',
    ];
    events.forEach((event) => {
        document.addEventListener(event, lazyloadRunObserver);
    });
</script>
<link rel='stylesheet' id='jeg-dynamic-style-css'
    href='{{ asset('assets/wp-content/plugins/jeg-elementor-kit/lib/jeg-framework/assets/css/jeg-dynamic-styles6f3e.css?ver=1.3.0') }}'
    media='all' />
<link rel='stylesheet' id='elementor-post-463-css'
    href='{{ asset("assets/wp-content/uploads/sites/65/elementor/css/post-463fd00.css?ver=1741989973") }}' media='all' />
<link rel='stylesheet' id='font-awesome-5-all-css'
    href='{{ asset("assets/wp-content/plugins/elementor/assets/lib/font-awesome/css/all.min7871.css?ver=3.27.7") }}' media='all' />
<link rel='stylesheet' id='font-awesome-4-shim-css'
    href='{{ asset('assets/wp-content/plugins/elementor/assets/lib/font-awesome/css/v4-shims.min7871.css?ver=3.27.7')}}'
    media='all' />
<link rel='stylesheet' id='elementor-post-465-css'
    href='{{ asset("assets/wp-content/uploads/sites/65/elementor/css/post-465fd00.css?ver=1741989973") }}' media='all' />
<script src="{{ asset("assets/wp-content/plugins/elementor/assets/lib/swiper/v8/swiper.min94a4.js?ver=8.4.5") }}" id="swiper-js"></script>
<script src="{{ asset("assets/wp-content/plugins/metform/public/assets/lib/cute-alert/cute-alert5219.js?ver=3.9.6") }}" id="cute-alert-js">
</script>
<script src="{{ asset('assets/wp-content/themes/hello-elementor/assets/js/hello-frontend.min9b70.js?ver=3.3.0') }}"
    id="hello-theme-frontend-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/sweetalert2/sweetalert2.min430c.js?ver=11.6.16') }}"
    id="sweetalert2-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/tiny-slider/tiny-sliderf342.js?ver=2.9.3') }}"
    id="tiny-slider-js"></script>
<script src="{{ asset('assets/wp-content/plugins/elementor/assets/js/webpack.runtime.min7871.js?ver=3.27.7') }}"
    id="elementor-webpack-runtime-js"></script>
<script src="{{ asset('assets/wp-content/plugins/elementor/assets/js/frontend-modules.min7871.js?ver=3.27.7') }}"
    id="elementor-frontend-modules-js"></script>
<script src="{{ asset('assets/wp-includes/js/jquery/ui/core.minb37e.js?ver=1.13.3" id="jquery-ui-core-js') }}"></script>
<script id="elementor-frontend-js-before">
    var elementorFrontendConfig = {
        "environmentMode": {
            "edit": false,
            "wpPreview": false,
            "isScriptDebug": false
        },
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close",
            "a11yCarouselPrevSlideMessage": "Previous slide",
            "a11yCarouselNextSlideMessage": "Next slide",
            "a11yCarouselFirstSlideMessage": "This is the first slide",
            "a11yCarouselLastSlideMessage": "This is the last slide",
            "a11yCarouselPaginationBulletMessage": "Go to slide"
        },
        "is_rtl": false,
        "breakpoints": {
            "xs": 0,
            "sm": 480,
            "md": 768,
            "lg": 1025,
            "xl": 1440,
            "xxl": 1600
        },
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Mobile Portrait",
                    "value": 767,
                    "default_value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {
                    "label": "Mobile Landscape",
                    "value": 880,
                    "default_value": 880,
                    "direction": "max",
                    "is_enabled": false
                },
                "tablet": {
                    "label": "Tablet Portrait",
                    "value": 1024,
                    "default_value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {
                    "label": "Tablet Landscape",
                    "value": 1200,
                    "default_value": 1200,
                    "direction": "max",
                    "is_enabled": false
                },
                "laptop": {
                    "label": "Laptop",
                    "value": 1366,
                    "default_value": 1366,
                    "direction": "max",
                    "is_enabled": false
                },
                "widescreen": {
                    "label": "Widescreen",
                    "value": 2400,
                    "default_value": 2400,
                    "direction": "min",
                    "is_enabled": false
                }
            },
            "hasCustomBreakpoints": false
        },
        "version": "3.27.7",
        "is_static": false,
        "experimentalFeatures": {
            "e_font_icon_svg": true,
            "additional_custom_breakpoints": true,
            "container": true,
            "e_swiper_latest": true,
            "e_onboarding": true,
            "hello-theme-header-footer": true,
            "home_screen": true,
            "nested-elements": true,
            "editor_v2": true,
            "e_element_cache": true,
            "link-in-bio": true,
            "floating-buttons": true,
            "launchpad-checklist": true
        },
        "urls": {
            "assets": "https:\/\/www.wordpress-dev.codeinsolution.com\/brickon\/wp-content\/plugins\/elementor\/assets\/",
            "ajaxurl": "https:\/\/www.wordpress-dev.codeinsolution.com\/brickon\/wp-admin\/admin-ajax.php",
            "uploadUrl": "https:\/\/www.wordpress-dev.codeinsolution.com\/brickon\/wp-content\/uploads\/sites\/65"
        },
        "nonces": {
            "floatingButtonsClickTracking": "261cb2abf7"
        },
        "swiperClass": "swiper",
        "settings": {
            "page": [],
            "editorPreferences": []
        },
        "kit": {
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "global_image_lightbox": "yes",
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description",
            "hello_header_logo_type": "title",
            "hello_header_menu_layout": "horizontal",
            "hello_footer_logo_type": "logo"
        },
        "post": {
            "id": 8,
            "title": "Brickon%20%E2%80%93%20Construction%20Elementor%20Template%20Kit",
            "excerpt": "",
            "featuredImage": false
        }
    };
</script>
<script src="{{ asset('assets/wp-content/plugins/elementor/assets/js/frontend.min7871.js?ver=3.27.7') }}" id="elementor-frontend-js"></script>
<script id="elementor-frontend-js-after">
    var jkit_ajax_url = "indexe2f2.html?jkit-ajax-request=jkit_elements",
        jkit_nonce = "8db6c50bdc";
</script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/fun-factf4f2.js?ver=2.6.12') }}"
    id="jkit-element-funfact-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/client-logof4f2.js?ver=2.6.12') }}"
    id="jkit-element-clientlogo-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/testimonialsf4f2.js?ver=2.6.12') }}"
    id="jkit-element-testimonials-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/accordionf4f2.js?ver=2.6.12') }}"
    id="jkit-element-accordion-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/video-buttonf4f2.js?ver=2.6.12') }}"
    id="jkit-element-videobutton-js"></script>
<script id="jkit-element-pagination-js-extra">
    var jkit_element_pagination_option = {
        "element_prefix": "jkit_element_ajax_"
    };
</script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/post-paginationf4f2.js?ver=2.6.12') }}"
    id="jkit-element-pagination-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/sticky-elementf4f2.js?ver=2.6.12') }}"
    id="jkit-sticky-element-js"></script>
<script src="{{ asset('assets/wp-content/plugins/elementor/assets/lib/font-awesome/js/v4-shims.min7871.js?ver=3.27.7') }}"
    id="font-awesome-4-shim-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/nav-menuf4f2.js?ver=2.6.12') }}"
    id="jkit-element-navmenu-js"></script>
<script src="{{ asset('assets/wp-content/plugins/jeg-elementor-kit/assets/js/elements/mailchimpf4f2.js?ver=2.6.12') }}"
    id="jkit-element-mailchimp-js"></script>

@stack('js')