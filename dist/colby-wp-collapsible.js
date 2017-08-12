/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _renderCollapsibles = __webpack_require__(3);

var _renderCollapsibles2 = _interopRequireDefault(_renderCollapsibles);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

window.addEventListener('load', _renderCollapsibles2.default);

/***/ }),
/* 1 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin
module.exports = {"trigger":"trigger","open":"open","collapsibleContentContainer":"collapsibleContentContainer","collapsibleContent":"collapsibleContent","contentInner":"contentInner"};

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Collapsible = function () {
  function Collapsible(props) {
    _classCallCheck(this, Collapsible);

    this.props = props;
    this.open = !props.open;
  }

  _createClass(Collapsible, [{
    key: 'shouldRun',
    value: function shouldRun() {
      if ([this.props.trigger, this.props.content, this.props.contentContainer].includes(null)) {
        return false;
      }

      return true;
    }
  }, {
    key: 'handleClick',
    value: function handleClick() {
      if (this.open) {
        this.props.container.classList.remove('open');
        this.props.contentContainer.style.height = '0';
      } else {
        this.props.container.classList.add('open');
        this.contentHeight = this.props.content.clientHeight;
        this.props.contentContainer.style.height = this.contentHeight + 'px';
      }

      this.open = !this.open;
    }
  }, {
    key: 'run',
    value: function run() {
      var _this = this;

      this.handleClick();
      this.props.trigger.addEventListener('click', this.handleClick.bind(this));

      window.addEventListener('resize', function () {
        if (_this.open) {
          _this.contentHeight = _this.props.content.clientHeight;
          _this.props.contentContainer.style.height = _this.contentHeight + 'px';
        }
      });
    }
  }]);

  return Collapsible;
}();

exports.default = Collapsible;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Collapsible = __webpack_require__(2);

var _Collapsible2 = _interopRequireDefault(_Collapsible);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var maybeRun = function maybeRun(container) {
  var collapsible = new _Collapsible2.default({
    container: container,
    trigger: container.querySelector('[data-trigger]') || null,
    content: container.querySelector('.collapsibleContent') || null,
    contentContainer: container.querySelector('.collapsibleContentContainer') || null,
    open: !!['1', 'true'].includes(container.getAttribute('data-open'))
  });

  if (collapsible.shouldRun()) {
    collapsible.run();
  }
};

var renderCollapsibles = function renderCollapsibles() {
  Array.prototype.forEach.call(document.querySelectorAll('[data-collapsible]'), maybeRun);
};

exports.default = renderCollapsibles;

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(0);
module.exports = __webpack_require__(1);


/***/ })
/******/ ]);