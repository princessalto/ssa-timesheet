/**
 * jquery-sidebarToggler.js
 *
 * @param  {[type]} $        [description]
 * @param  {[type]} document [description]
 * @return {[type]}          [description]
 */
(function ($, document) {
    var Toggler = {
        init: function (options, elem) {
            var self = this;
            self.elem = elem;
            self.$elem = $(elem);
            self.sidebar = (typeof options === 'string') ? options : $.fn.sidebarToggler.options.sidebar;
            self.options = $.extend( {}, $.fn.sidebarToggler.options, options );
            // console.log(self);

            self.loadState();
            self.toggle();
        },

        toggle: function () {
            var self = this;
            self.$elem.on('click', function (e) {
                $(self.sidebar).toggleClass(self.options.sidebarToggledClass);
                self.saveState();
                e.preventDefault();
            });
        },

        saveState: function () {
            var self = this;
            localStorage.setItem(self.options.localStorageName, $(self.sidebar).hasClass(self.options.sidebarToggledClass) ? 1 : 0);
        },

        loadState: function () {
            var self = this;
            if( localStorage.getItem(self.options.localStorageName) == 1 ) {
                $(self.options.sidebar).addClass(self.options.sidebarToggledClass);
            } else {
                $(self.options.sidebar).removeClass(self.options.sidebarToggledClass);
            }
        },
    }

    $.fn.sidebarToggler = function (options) {
        var toggler = Object.create( Toggler );
        return this.each(function () {
            toggler.init(options, this);
        });
    }

    $.fn.sidebarToggler.options = {
        sidebar: "[data-toggle=sidebar]",
        sidebarToggledClass: "toggled",
        localStorageName: 'sidebarTogglerState',
    }

    jQuery('[data-toggle=sidebar-toggler]').sidebarToggler();

})(jQuery, document);


(function ($) {
    var Dropdown = {
        init: function (options, elem) {
            var self = this;
            self.elem = elem;
            self.$elem = $(elem);
            self.options = $.extend( {}, $.fn.sidebarDropdown.options, options );
            self.$parent = self.$elem.parents( self.options.parent );
            self.$dropdownMenu = self.$parent.find(self.options.dropdownMenu);

            console.log(self.$dropdownMenu.attr('id'));
            self.toggle();
        },

        open: function () {
            var self = this;
            self.$parent.addClass( self.options.openClass );

            self.$dropdownMenu.hide().slideDown({
                duration: self.options.animation.durationIn,
                easing: self.options.animation.easeIn,
            });
            self.$elem.attr("aria-expanded", "true");
        },

        close: function () {
            var self = this;

            self.$dropdownMenu.slideUp({
                duration: self.options.animation.durationOut,
                easing: self.options.animation.easeOut,
            }).removeAttr("style");
            self.$elem.attr("aria-expanded", "false");

            setTimeout(function () {
                self.$parent.removeClass( self.options.openClass );
            }, self.options.animation.duration);
        },

        toggle: function () {
            var self = this;

            if( !$(this).parents(self.options.sidebar).hasClass('toggled') ) {

                if( self.$parent.hasClass( self.options.openClass ) ) {
                    self.close();
                } else {
                    self.open();
                }

            } else {
                // Means the Sidebar is in a toggled state
                // In this case let CSS handle dropdown
            }

        },

    }

    $.fn.sidebarDropdown = function (options, elem) {
        var dropdown = Object.create(Dropdown);
        return this.each(function (e) {
            $(this).on('click', function (e) {
                dropdown.init(options, this);
                e.preventDefault();
                e.stopPropagation();
            }).on('hover', function (e) {
                e.preventDefault();
            });
        });
    };

    $.fn.sidebarDropdown.options = {
        sidebar: '[data-toggle=sidebar]',
        parent: '.dropdown',
        openClass: 'open',
        animation: 'slideDown',
        dropdownMenu: '.dropdown-menu',
        animation: {
            durationIn: 400,
            durationOut: 100,
            duration: 100,
            easeIn: 'easeInOutCirc',
            easeOut: 'easeOutBounce',
        }
    };
    jQuery('[data-toggle=sidebar-dropdown]').sidebarDropdown();
})(jQuery);
/**
 * HTML Repeater
 *
 * @param  {Object} $
 * @param  {Object} document
 * @return
 */
(function ($, document) {

	var Repeater = {
        init: function (options, elem) {
        	var self = this;
            self.elem = elem;
            self.$elem = $(elem);
            self.options = $.extend( {}, $.fn.repeater.options, options );
            self.$container = $(elem).parents(self.options.repeatableContainer);
            self.$repeatable = self.$container.find(self.options.repeatable);

            self.$closeButtonContainer = self.$container.find(self.options.closeButtonContainer);

            this.debug("[Repeater]: initialized on click");

            return false;
        },

        toggle: function (options) {
            var self = this,
                index = self.$repeatable.length;
                $clone = self.$repeatable.last().clone();

            self.options.beforeToggle($clone, index, self);

            $clone.find('input, select').val('');
            $clone.find('textarea').text('');
            // $clone.find('input[name="attr['+(index - 1)+'][key]"], select[name="attr['+(index - 1)+'][key]"]').attr('name', 'attr['+index+'][key]');
            $clone.find(self.options.closeButtonContainer).removeClass('hidden-xs-up').show();

            self.$repeatable.last().after($clone);
            $clone.find(self.options.focusableElement).focus();

            self.options.afterToggle($clone, index, self);

            return false;
        },

        destroy: function () {
        	this.destroy();
        	this.element.unbind( this.eventNamespace )
		    this.bindings.unbind( this.eventNamespace );
        },

        remove: function (callback) {
            var self = this;
            callback(self);
            return true;
        },

        debug: function ($d) {
            var self = this;
        	if (self.options.debug) console.log($d);
        },
    };

    $.fn.repeater = function (options) {
        var repeater = Object.create(Repeater);

        return this.each(function () {
            $(this).click(function (e) {
                repeater.init(options, this);
                repeater.toggle(options);
                repeater.remove(function (self) {
                    $(document).on("click", self.options.closeButton, function (e) {
                        $(this).parents(self.options.repeatable).remove();
                    });
                    return true;
                });
            });
        });
    };

    $.fn.repeater.options = {
        repeatableContainer: '.repeatable-block',
        repeatable: '.repeatable',
        closeButtonContainer: '.repeatable-close-button',
        closeButton: '.btn-close',
        focusableElement: 'input:first',
        buttons: {
            add: {
                class: 'btn btn-link btn-secondary pull-xs-right',
                icon: 'fa fa-plus',
                text: '',
            },
            remove: {
                class: 'btn btn-link btn-secondary pull-xs-right',
                icon: 'fa fa-minus',
                text: '',
            },
        },
        debug: true,

        beforeToggle: function (clone, index, self) {},
        afterToggle: function (clone, index, self) {},
    };
    $('[data-toggle=repeater]').repeater();

})(jQuery, document);
/**
 * Slugify
 *
 * @param  {Object} $
 * @param  {Object} document
 * @return
 */
(function ($, document) {

	var Slugify = {
        init: function (options, elem) {
        	var self = this;
            self.elem = elem;
            self.$elem = $(elem);
            self.options = $.extend( {}, $.fn.slugify.options, options );
            if (self.$elem.data('slugify')) self.options.target = self.$elem.data('slugify');
            if (self.$elem.data('slugify-separator')) self.options.separator = self.$elem.data('slugify-separator');


            self.$elem.on('keyup', function (e) {
	            var $string = $(this).val();
	            $string = self.convert($string);
	            $(self.options.target).val($string);

	            if (self.options.debug) self.debug($string);
            });

        	return true;
        },

        convert: function ($string) {
        	return $string.toLowerCase()
        			.replace(/ /g, this.options.separator)
        			.replace(/[^\w-]+/g, '');
        },

        destroy: function () {
        	this.destroy();
        	this.element.unbind( this.eventNamespace )
		    this.bindings.unbind( this.eventNamespace );
        },

        debug: function ($string) {
        	console.log($string);
        },
    };

    $.fn.slugify = function (options, elem) {
        var slugify = Object.create(Slugify);
        return this.each(function () {
            slugify.init(options, this);
        });
    };

    $.fn.slugify.options = {
        target: '[name=slug]',
        separator: '-',
        debug: false,
    };
    jQuery('[data-slugify]').slugify();

})(jQuery, document);
/**
 * Lockable
 *
 * @param  {Object} $
 * @param  {Object} document
 * @return
 */
(function ($, document) {

	var Lockable = {
        init: function (options, elem) {
        	var self = this;
            self.elem = elem;
            self.$elem = $(elem);
            self.options = $.extend( {}, $.fn.lockable.options, options );
            self.options.target = '' == self.options.target ? self.$elem.data('target') : '.lockable-target';

            self.toggle(self.options, self);

        	return true;
        },

        toggle: function (options, elem) {
            var self = this;

            console.log(options.target);
            if (true == $(options.target).prop('disabled')) {
                $(options.target).prop('disabled', false);
                console.log('false');
            } else {
                $(options.target).prop('disabled', true);
                console.log('true');
            }

            if (options.debug) self.debug(options.target);
        },

        destroy: function () {
        	this.destroy();
        	this.element.unbind( this.eventNamespace )
		    this.bindings.unbind( this.eventNamespace );
        },

        debug: function ($d) {
        	console.log($d);
        },
    };

    $.fn.lockable = function (options, elem) {
        var lockable = Object.create(Lockable);
        return this.each(function () {
            $(this).on('click', function (e) {
                lockable.init(options, this);
                // lockable.toggle(options, this);
            });
        });
    };

    $.fn.lockable.options = {
        target: '',
        debug: false,
    };
    $('[data-toggle=lockable]').lockable();

})(jQuery, document);
jQuery(document).ready(function ($) {
	if ($.fn.validation) $('form[data-jquery-validate], .jquery-validate').validate();
});
//# sourceMappingURL=app.js.map
