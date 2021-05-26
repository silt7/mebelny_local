/* ========================================================================
 * Bootstrap: transition.js v3.3.7
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


 +function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

      $.event.special.bsTransitionEnd = {
        bindType: $.support.transition.end,
        delegateType: $.support.transition.end,
        handle: function (e) {
          if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
        }
    }
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: transition.js v3.3.7
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


 +function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

      $.event.special.bsTransitionEnd = {
        bindType: $.support.transition.end,
        delegateType: $.support.transition.end,
        handle: function (e) {
          if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
        }
    }
  })

}(jQuery);




/* =============================================================
 * bootstrap-collapse.js v2.0.4
 * http://twitter.github.com/bootstrap/javascript.html#collapse
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


 !function ($) {

  "use strict"; // jshint ;_;


 /* COLLAPSE PUBLIC CLASS DEFINITION
 * ================================ */

 var Collapse = function (element, options) {
  this.$element = $(element)
  this.options = $.extend({}, $.fn.collapse.defaults, options)

  if (this.options.parent) {
    this.$parent = $(this.options.parent)
  }

  this.options.toggle && this.toggle()
}

Collapse.prototype = {

  constructor: Collapse

  , dimension: function () {
    var hasWidth = this.$element.hasClass('width')
    return hasWidth ? 'width' : 'height'
  }

  , show: function () {
    var dimension
    , scroll
    , actives
    , hasData

    if (this.transitioning) return

      dimension = this.dimension()
    scroll = $.camelCase(['scroll', dimension].join('-'))
    actives = this.$parent && this.$parent.find('> .accordion-group > .in')

    if (actives && actives.length) {
      hasData = actives.data('collapse')
      if (hasData && hasData.transitioning) return
        actives.collapse('hide')
      hasData || actives.data('collapse', null)
    }

    this.$element[dimension](0)
    this.transition('addClass', $.Event('show'), 'shown')
    this.$element[dimension](this.$element[0][scroll])
  }

  , hide: function () {
    var dimension
    if (this.transitioning) return
      dimension = this.dimension()
    this.reset(this.$element[dimension]())
    this.transition('removeClass', $.Event('hide'), 'hidden')
    this.$element[dimension](0)
  }

  , reset: function (size) {
    var dimension = this.dimension()

    this.$element
    .removeClass('collapse')
    [dimension](size || 'auto')
    [0].offsetWidth

    this.$element[size !== null ? 'addClass' : 'removeClass']('collapse')

    return this
  }

  , transition: function (method, startEvent, completeEvent) {
    var that = this
    , complete = function () {
      if (startEvent.type == 'show') that.reset()
        that.transitioning = 0
      that.$element.trigger(completeEvent)
    }

    this.$element.trigger(startEvent)

    if (startEvent.isDefaultPrevented()) return

      this.transitioning = 1

    this.$element[method]('in')

    $.support.transition && this.$element.hasClass('collapse') ?
    this.$element.one($.support.transition.end, complete) :
    complete()
  }

  , toggle: function () {
    this[this.$element.hasClass('in') ? 'hide' : 'show']()
  }

}


 /* COLLAPSIBLE PLUGIN DEFINITION
 * ============================== */

 $.fn.collapse = function (option) {
  return this.each(function () {
    var $this = $(this)
    , data = $this.data('collapse')
    , options = typeof option == 'object' && option
    if (!data) $this.data('collapse', (data = new Collapse(this, options)))
      if (typeof option == 'string') data[option]()
    })
}

$.fn.collapse.defaults = {
  toggle: true
}

$.fn.collapse.Constructor = Collapse


 /* COLLAPSIBLE DATA-API
 * ==================== */

 $(function () {
  $('body').on('click.collapse.data-api', '[data-toggle=collapse]', function ( e ) {
    var $this = $(this), href
    , target = $this.attr('data-target')
    || e.preventDefault()
          || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
          , option = $(target).data('collapse') ? 'toggle' : $this.data()
          $(target).collapse(option)
        })
})

}(window.jQuery);

/*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2017 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (https://getbootstrap.com/docs/3.3/customize/?id=c32d8c2655ef71dd7c1a2b487179523b)
 * Config saved to config.json and https://gist.github.com/c32d8c2655ef71dd7c1a2b487179523b
 */
 if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
+function ($) {
  'use strict';
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1) || (version[0] > 3)) {
    throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4')
  }
}(jQuery);

/* ========================================================================
 * Bootstrap: modal.js v3.3.7
 * http://getbootstrap.com/javascript/#modals
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


 +function ($) {
  'use strict';

  // MODAL CLASS DEFINITION
  // ======================

  var Modal = function (element, options) {
    this.options             = options
    this.$body               = $(document.body)
    this.$element            = $(element)
    this.$dialog             = this.$element.find('.modal-dialog')
    this.$backdrop           = null
    this.isShown             = null
    this.originalBodyPad     = null
    this.scrollbarWidth      = 0
    this.ignoreBackdropClick = false

    if (this.options.remote) {
      this.$element
      .find('.modal-content')
      .load(this.options.remote, $.proxy(function () {
        this.$element.trigger('loaded.bs.modal')
      }, this))
    }
  }

  Modal.VERSION  = '3.3.7'

  Modal.TRANSITION_DURATION = 300
  Modal.BACKDROP_TRANSITION_DURATION = 150

  Modal.DEFAULTS = {
    backdrop: true,
    keyboard: true,
    show: true
  }

  Modal.prototype.toggle = function (_relatedTarget) {
    return this.isShown ? this.hide() : this.show(_relatedTarget)
  }

  Modal.prototype.show = function (_relatedTarget) {
    var that = this
    var e    = $.Event('show.bs.modal', { relatedTarget: _relatedTarget })

    this.$element.trigger(e)

    if (this.isShown || e.isDefaultPrevented()) return

      this.isShown = true

    this.checkScrollbar()
    this.setScrollbar()
    this.$body.addClass('modal-open')

    this.escape()
    this.resize()

    this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))

    this.$dialog.on('mousedown.dismiss.bs.modal', function () {
      that.$element.one('mouseup.dismiss.bs.modal', function (e) {
        if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
      })
    })

    this.backdrop(function () {
      var transition = $.support.transition && that.$element.hasClass('fade')

      if (!that.$element.parent().length) {
        that.$element.appendTo(that.$body) // don't move modals dom position
      }

      that.$element
      .show()
      .scrollTop(0)

      that.adjustDialog()

      if (transition) {
        that.$element[0].offsetWidth // force reflow
      }

      that.$element.addClass('in')

      that.enforceFocus()

      var e = $.Event('shown.bs.modal', { relatedTarget: _relatedTarget })

      transition ?
        that.$dialog // wait for modal to slide in
        .one('bsTransitionEnd', function () {
          that.$element.trigger('focus').trigger(e)
        })
        .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
        that.$element.trigger('focus').trigger(e)
      })
  }

  Modal.prototype.hide = function (e) {
    if (e) e.preventDefault()

      e = $.Event('hide.bs.modal')

    this.$element.trigger(e)

    if (!this.isShown || e.isDefaultPrevented()) return

      this.isShown = false

    this.escape()
    this.resize()

    $(document).off('focusin.bs.modal')

    this.$element
    .removeClass('in')
    .off('click.dismiss.bs.modal')
    .off('mouseup.dismiss.bs.modal')

    this.$dialog.off('mousedown.dismiss.bs.modal')

    $.support.transition && this.$element.hasClass('fade') ?
    this.$element
    .one('bsTransitionEnd', $.proxy(this.hideModal, this))
    .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
    this.hideModal()
  }

  Modal.prototype.enforceFocus = function () {
    $(document)
      .off('focusin.bs.modal') // guard against infinite focus loop
      .on('focusin.bs.modal', $.proxy(function (e) {
        if (document !== e.target &&
          this.$element[0] !== e.target &&
          !this.$element.has(e.target).length) {
          this.$element.trigger('focus')
      }
    }, this))
    }

    Modal.prototype.escape = function () {
      if (this.isShown && this.options.keyboard) {
        this.$element.on('keydown.dismiss.bs.modal', $.proxy(function (e) {
          e.which == 27 && this.hide()
        }, this))
      } else if (!this.isShown) {
        this.$element.off('keydown.dismiss.bs.modal')
      }
    }

    Modal.prototype.resize = function () {
      if (this.isShown) {
        $(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
      } else {
        $(window).off('resize.bs.modal')
      }
    }

    Modal.prototype.hideModal = function () {
      var that = this
      this.$element.hide()
      this.backdrop(function () {
        that.$body.removeClass('modal-open')
        that.resetAdjustments()
        that.resetScrollbar()
        that.$element.trigger('hidden.bs.modal')
      })
    }

    Modal.prototype.removeBackdrop = function () {
      this.$backdrop && this.$backdrop.remove()
      this.$backdrop = null
    }

    Modal.prototype.backdrop = function (callback) {
      var that = this
      var animate = this.$element.hasClass('fade') ? 'fade' : ''

      if (this.isShown && this.options.backdrop) {
        var doAnimate = $.support.transition && animate

        this.$backdrop = $(document.createElement('div'))
        .addClass('modal-backdrop ' + animate)
        .appendTo(this.$body)

        this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
          if (this.ignoreBackdropClick) {
            this.ignoreBackdropClick = false
            return
          }
          if (e.target !== e.currentTarget) return
            this.options.backdrop == 'static'
          ? this.$element[0].focus()
          : this.hide()
        }, this))

      if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

        this.$backdrop.addClass('in')

      if (!callback) return

        doAnimate ?
      this.$backdrop
      .one('bsTransitionEnd', callback)
      .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
      callback()

    } else if (!this.isShown && this.$backdrop) {
      this.$backdrop.removeClass('in')

      var callbackRemove = function () {
        that.removeBackdrop()
        callback && callback()
      }
      $.support.transition && this.$element.hasClass('fade') ?
      this.$backdrop
      .one('bsTransitionEnd', callbackRemove)
      .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
      callbackRemove()

    } else if (callback) {
      callback()
    }
  }

  // these following methods are used to handle overflowing modals

  Modal.prototype.handleUpdate = function () {
    this.adjustDialog()
  }

  Modal.prototype.adjustDialog = function () {
    var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

    this.$element.css({
      paddingLeft:  !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
      paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
    })
  }

  Modal.prototype.resetAdjustments = function () {
    this.$element.css({
      paddingLeft: '',
      paddingRight: ''
    })
  }

  Modal.prototype.checkScrollbar = function () {
    var fullWindowWidth = window.innerWidth
    if (!fullWindowWidth) { // workaround for missing window.innerWidth in IE8
      var documentElementRect = document.documentElement.getBoundingClientRect()
      fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
    }
    this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
    this.scrollbarWidth = this.measureScrollbar()
  }

  Modal.prototype.setScrollbar = function () {
    var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
    this.originalBodyPad = document.body.style.paddingRight || ''
    if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
  }

Modal.prototype.resetScrollbar = function () {
  this.$body.css('padding-right', this.originalBodyPad)
}

  Modal.prototype.measureScrollbar = function () { // thx walsh
    var scrollDiv = document.createElement('div')
    scrollDiv.className = 'modal-scrollbar-measure'
    this.$body.append(scrollDiv)
    var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
    this.$body[0].removeChild(scrollDiv)
    return scrollbarWidth
  }


  // MODAL PLUGIN DEFINITION
  // =======================

  function Plugin(option, _relatedTarget) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.modal')
      var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)

      if (!data) $this.data('bs.modal', (data = new Modal(this, options)))
        if (typeof option == 'string') data[option](_relatedTarget)
          else if (options.show) data.show(_relatedTarget)
        })
  }

  var old = $.fn.modal

  $.fn.modal             = Plugin
  $.fn.modal.Constructor = Modal


  // MODAL NO CONFLICT
  // =================

  $.fn.modal.noConflict = function () {
    $.fn.modal = old
    return this
  }


  // MODAL DATA-API
  // ==============

  $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
    var option  = $target.data('bs.modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

    if ($this.is('a')) e.preventDefault()

      $target.one('show.bs.modal', function (showEvent) {
      if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
        $target.one('hidden.bs.modal', function () {
          $this.is(':visible') && $this.trigger('focus')
        })
    })
    Plugin.call($target, option, this)
  })

}(jQuery);
