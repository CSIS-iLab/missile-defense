/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 * Toggles search bar in header navigation. - Added by JS
 */
(function() {
    var container, button, menu, links, subMenus, i, len;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }

    button = container.getElementsByTagName('button')[0];
    if ('undefined' === typeof button) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function() {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');
    subMenus = menu.getElementsByTagName('ul');

    // Set menu items with submenus to aria-haspopup="true".
    for (i = 0, len = subMenus.length; i < len; i++) {
        subMenus[i].parentNode.setAttribute('aria-haspopup', 'true');
    }

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    (function(container) {
        var touchStartFn, i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function(e) {
                var menuItem = this.parentNode,
                    i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }
                        menuItem.parentNode.children[i].classList.remove('focus');
                    }
                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    }(container));

})();

jQuery(document).ready(function($) {
    /**
     * Toggles `active` class on search form.
     */
    $('#navSearchLabel').click(function() {
        $('#navSearchInput').toggle('slow');
    });
});




jQuery(document).ready(function($) {

    //sticky map placement
    if( $('.resources-menu').length ) {

        var absolute = $('.resources-menu');
        var fixed = $('.resources-menu.sticky');

        calculate(absolute);


        var msie6 = $.browser == 'msie' && $.browser.version < 7;
        if (!msie6) {
            var top2 = $('.resources-menu').offset().top;
            var top = top2 - 100;
            $(window).scroll(function(event) {
                var y = $(this).scrollTop();
                if (y >= top) {
                    $('.resources-menu').addClass('sticky');
     
                
                } else {
                    $('.resources-menu').removeClass('sticky');
                }
            });

        }


        $(window).resize(function() {
        	var y = $(this).scrollTop();
        	var h = window.innerHeight;
            if (y >= h) {
                calculate(fixed);
            } else {
                calculate(absolute);
            }
            
        });

        function calculate(object) {
            var winW = $(window).width();
            var container = $('.container').width();
            var margin = (winW - container) / 2;
            var size = container / 4;

            if (winW < 992) {
                var size = container / 2;
            } else if (winW < 768) {
            	var size = container;
                $('.resources-menu').removeClass('sticky');

            } else {
                var size = container / 4;
            }

            object.css('width', size);
            object.css('right', margin);
        }

        $(function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    }

});
