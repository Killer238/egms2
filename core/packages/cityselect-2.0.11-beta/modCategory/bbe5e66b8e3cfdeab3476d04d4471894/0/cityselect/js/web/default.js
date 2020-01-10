(function ($, citySelectConfig) {
    "use strict";

    var indexOf = [].indexOf || function (item) {
            for (var i = 0, l = this.length; i < l; i++) {
                if (i in this && this[i] === item) return i;
            }
            return -1;
        };
    var hasProp = {}.hasOwnProperty;
    var slice = [].slice;

    var bind = function (fn, me) {
        return function () {
            return fn.apply(me, arguments);
        };
    };
    var extend = function (child, parent) {
        for (var key in parent) {
            if (hasProp.call(parent, key)) child[key] = parent[key];
        }
        function ctor() {
            this.constructor = child;
        }

        ctor.prototype = parent.prototype;
        child.prototype = new ctor();
        child.__super__ = parent.prototype;
        return child;
    };

    var mergeObj = function (json1, json2) {
        var out = {};
        for (var k1 in json1) {
            if (json1.hasOwnProperty(k1)) out[k1] = json1[k1];
        }
        for (var k2 in json2) {
            if (json2.hasOwnProperty(k2)) {
                if (!out.hasOwnProperty(k2)) out[k2] = json2[k2];
                else if (
                    (typeof out[k2] === 'object') && (out[k2].constructor === Object) &&
                    (typeof json2[k2] === 'object') && (json2[k2].constructor === Object)
                ) out[k2] = mergeObj(out[k2], json2[k2]);
            }
        }
        return out;
    };

    var runAction = function (action, bind) {
        if (typeof action == 'function') {
            return action.apply(bind, Array.prototype.slice.call(arguments, 2));
        }
        else if (typeof action == 'object') {
            for (var i in action) {
                if (action.hasOwnProperty(i)) {
                    var response = action[i].apply(bind, Array.prototype.slice.call(arguments, 2));
                    if (response === false) {
                        return false;
                    }
                }
            }
        }
        return true;
    };

    var camelize = function (str) {
        return str.replace(/(-|\.)(\w)/g, function (match, symbol) {
            return symbol.toUpperCase();
        });
    };
    var uncamelize = function (str) {
        return str.replace(/[A-Z]/g, function (symbol, index) {
            return (index == 0 ? '' : '-') + symbol.toLowerCase();
        });
    };

    var getOptions = function ($node, ns) {
        var prefix, options;

        if (typeof ns == 'undefined') {
            ns = $.fn.cityselect.defaults.ns;
        }

        prefix = camelize(ns);
        options = $node.data(prefix) || {};

        $.each($node.data(), function (index, value) {
            if (index.indexOf(prefix) === 0) {
                var key = uncamelize(index.replace(prefix, ''));
                if (key.length > 0) {
                    options[key] = value;
                }
            }
        });

        return options;
    };

    var newGuid = function () {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    };


    var inArray = function (needle, haystack) {
        for (var key in haystack) {
            if (haystack[key] == needle) return true;
        }

        return false;
    };

    var arrayIntersect = function (array1, array2) {
        var result;

        if (array1 instanceof Array && array2 instanceof Array) {
            result = array1.filter(function (n) {
                return array2.indexOf(n) !== -1;
            });
            return result.length > 0 ? result.length : false;
        }

        console.log('Error: arrayIntersect', array1, array2);

        return false;
    };

    var citySelect = citySelect || {};
    var Module, moduleKeywords, View, SettlementModal, SettlementPopover, Order, CourierModal;
    moduleKeywords = ['extended', 'included'];

    Module = (function () {
        function Module() {
        }

        Module.extend = function (obj) {
            var key, ref, value;
            for (key in obj) {
                value = obj[key];
                if (indexOf.call(moduleKeywords, key) < 0) {
                    this[key] = value;
                }
            }
            if ((ref = obj.extended) != null) {
                ref.apply(this);
            }
            return this;
        };

        Module.include = function (obj) {
            var key, ref, value;
            for (key in obj) {
                value = obj[key];
                if (indexOf.call(moduleKeywords, key) < 0) {
                    this.prototype[key] = value;
                }
            }
            if ((ref = obj.included) != null) {
                ref.apply(this);
            }
            return this;
        };

        return Module;

    })();


    View = function (element, options) {

        this.defaults = $.fn.cityselect.defaults;
        this.selectors = $.fn.cityselect.selectors;
        this.template = $.fn.cityselect.template;

        this.$body = $('body');
        this.$element = $(element);
        this.$parent = this.$element.closest(this.selectors.parent);
        if (this.$parent.length < 1) {
            this.$parent = $('body');
        }

        this.element = '';

        this.options = $.extend(true, {},
            getOptions(this.$parent),
            options
        );

        this.data = $.extend(true, {ctx: citySelectConfig.ctx, action: ''},
            getOptions(this.$parent, 'data'),
            getOptions(this.$element, 'data')
        );

    };

    View.prototype = {
        constructor: View,

        init: function () {
            this.processSuccess = bind(this.processSuccess, this);
            this.processFailure = bind(this.processFailure, this);
            this.showOutput = bind(this.showOutput, this);
            this.hideOutput = bind(this.hideOutput, this);
            this.setAction = bind(this.setAction, this);
        },

        getNamespace: function () {
            var args, option;
            option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
            return this.defaults.ns + ' ' + this.defaults.ns + (option || '') + ' ' + args.join(' ');
        },

        getSelector: function () {
            var args, option;
            option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
            return '.' + this.defaults.ns + '.' + this.defaults.ns + (option || '') + args.join('.');
        },

        getContent: function () {
            this.showSpinner();

            $.ajax({
                url: citySelectConfig.actionUrl,
                type: 'post',
                dataType: 'json',
                cache: false,
                data: this.data,
            }).done((function (_this) {
                return function (r) {
                    _this.hideSpinner();
                    _this.processSuccess(r);
                };
            })(this)).fail((function (_this) {
                return function (r) {
                    _this.hideSpinner();
                    _this.processFailure(r);
                };
            })(this));
        },

        createSpinner: function () {
            return $('<div class="' + this.getNamespace('-spinner') + '"></div>');
        },

        showSpinner: function () {
            if (!this.defaults.spinner) {
                return;
            }
            this.$spinner = this.$spinner || this.createSpinner();
            this.$body.append(this.$spinner);

            return this.$spinner.show();
        },

        hideSpinner: function () {
            if (this.$spinner) {
                return this.$spinner.remove();
            }
        },

        processSuccess: function (r) {
            var e, message;

            e = $.Event($.fn.cityselect.CONTENT_SUCCESS);
            this.$element.trigger(e, r);
            if (e.isDefaultPrevented()) {
                return;
            }

            if (!r.success) {
                message = r.message;
                if (!message) {
                    message = 'error unknown';
                }

                if (!r.data.output) {
                    r.data.output = message;
                }
            }

            return this.showOutput(r);
        },

        processFailure: function (r) {
            var e, message;

            e = $.Event($.fn.cityselect.CONTENT_FAILURE);
            this.$element.trigger(e, r);
            if (e.isDefaultPrevented()) {
                return;
            }

            message = r.responseJSON;
            if (!message) {
                message = 'error unknown';
            }

            return this.hideOutput(r);
        },

        showOutput: function (r) {
            return setTimeout((function () {

                runAction(this.methodActions['show'], this);

                return this.$output;
            }.bind(this)), $.fn.cityselect.defaults.timeout);
        },

        hideOutput: function (r) {
            return setTimeout((function () {

                runAction(this.methodActions['hide'], this);

                return this.$output;
            }.bind(this)), $.fn.cityselect.defaults.timeout);
        },

        setAction: function (action) {
            this.showSpinner();
            $.ajax({
                url: citySelectConfig.actionUrl,
                type: 'post',
                dataType: 'json',
                cache: false,
                data: $.extend(true, this.data, {
                    action: this.element + '/' + action,
                })
            }).done((function (_this) {
                return function (r) {
                    _this.hideSpinner();
                    _this.hideOutput(r);
                };
            })(this)).fail((function (_this) {
                return function (r) {
                    _this.hideSpinner();
                    _this.hideOutput(r);
                };
            })(this));
        },

    };


    SettlementPopover = (function (superClass) {
        extend(SettlementPopover, View, superClass);

        function SettlementPopover(element, options) {
            View.prototype.constructor.call(this, element, options);

            this.element = 'settlement';
            this.data = $.extend(true, this.data, {
                action: this.element + '/get'
            });

            this.methodActions = $.fn.cityselect.methodActions['SettlementPopover'];
        };

        SettlementPopover.prototype.createTarget = function () {

            var $target = $('<div class="' + this.getNamespace('-target') + '"></div>');
            $target.prop('id', newGuid());
            $target.addClass('popover popover-default');
            $target.append('<div class="arrow"></div>');

            var $title = $('<div class="popover-title"></div>');
            var $button = $('<span class="close pull-right" data-dismiss="popover-x">&times;</span><span class="tm-title">Title</span>');

            $title.append($button);
            $button.click(this.hideOutput);

            $(document).click(function (e) {
                if ($target.is(':hidden')) {
                    return;
                }

                if ($(e.target).closest('#' + $target.prop('id')).length) {
                    return;
                }

                $button.click();
                event.stopPropagation();
            });

            $target.append($title);
            $target.append('<div class="popover-content"></div>');
            $target.append('<div class="popover-footer"></div>');

            return $target.appendTo('body');
        };

        SettlementPopover.prototype.createButton = function (button) {
            var $button = $('<button class="btn"></button>');
            $button.prop('id', button.id);
            $button.data('button', button);

            // Icon
            if (typeof button.icon !== 'undefined' && $.trim(button.icon) !== '') {
                $button.append(this.createButtonIcon(button.icon));
            }

            // Label
            if (typeof button.label !== 'undefined') {
                $button.append(button.label);
            }

            // title
            if (typeof button.title !== 'undefined') {
                $button.attr('title', button.title);
            }

            // Css class
            if (typeof button.cssClass !== 'undefined' && $.trim(button.cssClass) !== '') {
                $button.addClass(button.cssClass);
            } else {
                $button.addClass('btn-default');
            }

            // Data attributes
            if (typeof button.data === 'object' && button.data.constructor === {}.constructor) {
                $.each(button.data, function (key, value) {
                    $button.attr('data-' + key, value);
                });
            }

            // Button on click
            $button.on('click', {QuickView: this, $button: $button, button: button}, function (event) {
                var QuickView = event.data.QuickView;
                var $button = event.data.$button;
                var button = $button.data('button');
                if (button.autospin) {
                    $button.toggleSpin(true);
                }
                if (typeof button.action === 'function') {
                    return button.action.call($button, QuickView, event);
                }
            });

            //Initialize enabled or not
            if (typeof button.enabled !== 'undefined') {
                $button.toggleEnable(button.enabled);
            }

            return $button;
        };

        SettlementPopover.prototype.getButtons = function () {
            var buttons, button;
            buttons = [];

            if (!this.defaults.buttons) {
                return buttons;
            }

            if (this.BPopoverOptions.buttons) {
                jQuery.each(this.BPopoverOptions.buttons, (function (_this) {
                    return function (index, action) {
                        if (typeof action === 'string') {
                            button = _this.BPopoverOptions[action] || {};
                        }
                        else {
                            button = action || {};
                            action = button['action'] || '';
                        }

                        button = $.extend({}, {
                            label: _this.defaults.msg[action] || action,
                            cssClass: _this.getNamespace('-' + _this.defaults.cls[action], _this.defaults.ns + '-action'),
                            action: action,
                            citySelect: _this
                        }, button);

                        buttons.push(button);
                    };
                })(this));
            }

            return buttons;
        };

        SettlementPopover.prototype.createButtons = function () {
            var buttons, $buttons;

            buttons = this.getButtons();
            if (buttons.length > 0) {
                $buttons = $('<div></div>');
                $buttons.addClass(this.getNamespace('-buttons'));

                jQuery.each(buttons, (function (_this) {
                    return function (index, button) {
                        if (!button.id) {
                            button.id = newGuid();
                        }
                        var $button = _this.createButton(button);
                        $buttons.append($button);
                    };
                })(this));
            }
            return $buttons;
        };

        SettlementPopover.prototype.init = function () {
            View.prototype.init.call(this);

            this.BPopoverOptions = $.extend(true, {},
                $.fn.cityselect.defaultBPopoverOptions,
                getOptions(this.$parent, 'popover'),
                getOptions(this.$element, 'popover')
            );

            if (typeof jQuery().popoverButton != 'function') {
                throw new Error("popoverButton required");
            }

            if (!this.$output) {
                this.$output = this.createTarget();
                this.BPopoverOptions.target = this.$output;
                this.$element.popoverButton(this.BPopoverOptions);
            }

            this.$output.isView = true;
        };

        SettlementPopover.prototype.updateTitle = function () {
            this.$output.find('.tm-title').text(this.BPopoverOptions.title);

            return this;
        };

        SettlementPopover.prototype.updateContent = function (content) {
            this.$output.find('.popover-content').html('').append(content);

            return this;
        };

        SettlementPopover.prototype.updateButtons = function (buttons) {
            this.$output.find('.popover-footer').html('').append(buttons);

            return this;
        };

        SettlementPopover.prototype.showOutput = function (r) {
            this.updateTitle();
            this.updateContent(this.createSettlementPopover(r.data));
            this.updateButtons(this.createButtons());

            this.$output.show();
            this.$output.popoverX('refreshPosition');

            return View.prototype.showOutput.call(this, r);
        };

        SettlementPopover.prototype.hideOutput = function (r) {
            this.$output.hide();

            return View.prototype.hideOutput.call(this, r);
        };

        SettlementPopover.prototype.createSettlementPopover = function (data) {
            this.data = $.extend(true, this.data, {
                data: JSON.stringify(data || {})
            });

            this.$settlementWrapper = $('<div></div>').append(this.template.get('SettlementPopover', 'row', data));
            this.$settlementWrapper.addClass(this.getNamespace('-settlement'));
            this.$settlement = this.$settlementWrapper.find('select');
            return this.$settlement;
        };

        SettlementPopover.prototype.setAction = function (action) {
            View.prototype.setAction.call(this, action);

            return setTimeout((function () {
                location.reload();
            }.bind(this)), $.fn.cityselect.defaults.timeout);
        };

        return SettlementPopover;

    })(Module);


    $.fn.cityselect = function () {
        var args, option;
        option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
        return this.each(function () {
            var $this, $parent, cityselect, options;

            $this = $(this);
            cityselect = $this.data('citySelect');

            if (!cityselect) {

                $parent = $this.closest($.fn.cityselect.selectors.parent);
                if ($parent.length < 1) {
                    $parent = $('body');
                }

                options = $.extend(true, {},
                    getOptions($parent),
                    getOptions($this)
                );

                switch (options['mode']) {
                    case 'settlement.popover':
                    default:
                        cityselect = new SettlementPopover(this, options);
                        break;
                }

                if (cityselect) {
                    $this.data('citySelect', cityselect);
                    cityselect.init();
                }
            }

            if (typeof option == 'undefined') {
                option = 'getContent';
            }

            if (typeof option === 'string') {
                return cityselect[option].apply(cityselect, args);
            }
        })
    };


    /* event constants */
    $.fn.cityselect.CONTENT_SUCCESS = 'cityselect:content-success.cityselect';
    $.fn.cityselect.CONTENT_FAILURE = 'cityselect:content-failure.cityselect';


    $.fn.cityselect.defaults = {
        ns: 'cityselect',
        spinner: true,
        buttons: true,
        timeout: 300,
        msg: {
            save: 'сохранить',
            close: 'закрыть',
        },
        cls: {
            save: 'save btn-default',
            close: 'remove btn-default',
        },
        settlement: {
            exclude: [
                'автодорога',
                'аллея',
                'дачный поселок',
                'заезд',
                'километр',
                'набережная',
                'область',
                'проспект',
                'проезд',
                'переулок',
                'поселение',
                'республика',
                'район',
                'сад',
                'микрорайон',
                'территория',
                'тупик',
                'улица',
            ]
        }
    };


    $.fn.cityselect.selectors = {
        main: '.' + $.fn.cityselect.defaults.ns,
        parent: '.' + $.fn.cityselect.defaults.ns + '-parent',
        output: '.' + $.fn.cityselect.defaults.ns + '-output',
        data: '.' + $.fn.cityselect.defaults.ns + '-data',
        actionBtn: '.' + $.fn.cityselect.defaults.ns + '-action',
        actionClick: '[data-click]',
        actionMouseOver: '[data-mouseover]',
        actionWindowLoad: '[data-windowload]',
    };


    $.fn.cityselect.defaultBPopoverOptions = {
        title: 'title',
        content: 'content',
        width: '200px',
    };


    $.fn.cityselect.defaultButtons = {
        save: {
            action: 'save'
        },
        close: {
            action: 'close'
        },
    };


    $.fn.cityselect.template = {
        'SettlementPopover': {
            row: [
                '<div class="form-group">',
                '<div class="">',
                '<select name="settlement" class="input-sm form-control">',
                '<option value="{kladr_id}" data-settlement=\'{data}\'>{name}</option>',
                '</select>',
                '</div>',
                '</div>',
            ],
        },

        get: function (type, name, data) {
            if (this[type] && this[type][name]) {
                var $template = this[type][name].join('');

                data = $.extend(true, data || {}, {
                    _type: type,
                    _name: name,
                });

                $template = $template.replace(new RegExp('{data}', "g"), JSON.stringify(data));

                for (var key in data) {
                    $template = $template.replace(new RegExp('{' + key + '}', "g"), data[key]);
                }
                return $template;
            }

            return '';
        }
    };


    $.fn.cityselect.methodActions = {
        'SettlementPopover': {
            show: {
                'settlement.selectize': function () {
                    var $this = this;

                    this.$settlement.selectize({
                        valueField: 'kladr_id',
                        labelField: 'name',
                        searchField: 'name',
                        create: false,
                        maxItems: 1,
                        loadThrottle: 600,
                        createOnBlur: true,
                        onFocus: function () {
                            var $input = this.$input;
                            var inputValue = $input.val();
                            this.clear();
                            this.cityselect = this.options[inputValue];
                        },
                        onChange: function (value) {
                            this.cityselect = this.options[value];
                            $this.data = $.extend(true, $this.data, {
                                id: value,
                                data: JSON.stringify(this.options[value] || {})
                            });
                        },
                        onBlur: function (self) {
                            if (this.getValue().length < 1 && this.cityselect) {
                                this.setValue(this.cityselect.kladr_id);
                            }
                        },
                        load: function (query, callback) {
                            if (query.length < 2) {
                                return callback();
                            }

                            this.clearOptions();

                            $.ajax({
                                url: citySelectConfig.actionUrl,
                                type: 'post',
                                dataType: 'json',
                                cache: false,
                                data: $.extend(true, $this.options.params || {}, {
                                    action: 'settlement/getlist',
                                    query: query,
                                })
                            }).done((function (_this) {
                                return function (r) {
                                    var data = [];
                                    if (r.data && !r.data.error) {
                                        $.each(r.data, function (i, value) {
                                            if (value['type']) {
                                                if (!inArray(value['type'],
                                                        $.fn.cityselect.defaults.settlement.exclude)) {
                                                    data.push(value);
                                                }
                                            }
                                        });
                                    }
                                    callback(data);
                                };
                            })(this)).fail((function (_this) {
                                return function (r) {
                                    console.log(r);
                                    callback();
                                };
                            })(this));
                        },
                        render: {
                            item: function (row, escape) {
                                var _this = this;
                                this.revertSettings.$children.each(function () {
                                    $.extend(_this.options[this.value], getOptions($(this), 'settlement'));
                                });

                                return [
                                    '<div class="settlement-suggestion">',
                                    '<div class="city">' + escape(row.city),
                                    '<span class="text-muted" style="font-size: 0.7em; line-height: 1;"> ',
                                    escape(row.city_type_full),
                                    (row.region_with_type ? ', ' + escape(row.region_with_type) : ''),
                                    (row.country ? ', ' + escape(row.country) : ''),
                                    '</span>',
                                    '</div>',
                                    '</div>'
                                ].join('');
                            },
                            option: function (row, escape) {
                                return [
                                    '<div class="settlement-suggestion" style="padding: 5px 10px;">',
                                    '<div class="city">' + escape(row.city),
                                    '<span class="text-muted" style="font-size: 0.7em; line-height: 1;"> ',
                                    escape(row.city_type_full),
                                    (row.region_with_type ? ', ' + escape(row.region_with_type) : ''),
                                    (row.country ? ', ' + escape(row.country) : ''),
                                    '</span>',
                                    '</div>',
                                    '</div>'
                                ].join('');
                            }
                        },


                    });


                },
            },
            hide: {},
        },

    };


    /* click */
    $(document).on('click', $.fn.cityselect.selectors.main + $.fn.cityselect.selectors.actionClick, function (e) {
        var $this = $(this);
        if ($this.is('a')) {
            e.preventDefault();
        }
        $this.cityselect();
    });


    /* action */
    $(document).on('click', $.fn.cityselect.selectors.main + ' ' + $.fn.cityselect.selectors.actionBtn, function (e, m) {
        var $this, button, action, cityselect;

        $this = $(this);
        if ($this.is('a')) {
            e.preventDefault();
        }

        button = $this.data('button') || {};
        cityselect = button.citySelect;

        action = button.action || $this.data('action');
        switch (action) {
            case 'save':
                cityselect.setAction(button.action);
                break;
            case 'close':
                cityselect.hideOutput();
                break;
            default:
                if (typeof action == 'function') {
                    return action.call($this);
                }
                break;
        }
    });


    /***************************************************/
    citySelect.setup = function () {
        citySelect.$doc = $(document);
        citySelect.$win = $(window);
    };

    citySelect.initialize = function () {
        citySelect.setup();
    };

    citySelect.initialize();
    window.citySelect = citySelect;
    /***************************************************/

    var originalAddClassMethod = jQuery.fn.addClass;
    $.fn.addClass = function () {
        var result = originalAddClassMethod.apply(this, arguments);
        $(this).trigger('cssClassChanged', arguments);
        return result;
    };


}(window.jQuery, citySelectConfig));