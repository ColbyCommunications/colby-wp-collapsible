require=function(r,e,n){function t(n,o){function i(r){return t(i.resolve(r))}function f(e){return r[n][1][e]||e}if(!e[n]){if(!r[n]){var c="function"==typeof require&&require;if(!o&&c)return c(n,!0);if(u)return u(n,!0);var l=new Error("Cannot find module '"+n+"'");throw l.code="MODULE_NOT_FOUND",l}i.resolve=f;var a=e[n]=new t.Module;r[n][0].call(a.exports,i,a,a.exports)}return e[n].exports}function o(){this.bundle=t,this.exports={}}var u="function"==typeof require&&require;t.Module=o,t.modules=r,t.cache=e,t.parent=u;for(var i=0;i<n.length;i++)t(n[i]);return t}({7:[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0});function t(t){if(Array.isArray(t)){for(var e=0,r=Array(t.length);e<t.length;e++)r[e]=t[e];return r}return Array.from(t)}var e=function(e){[].concat(t(e.querySelectorAll("p"))).forEach(function(t){0===t.innerHTML.trim().length&&e.removeChild(t)})},r=function(t){t.hasAttribute("aria-pressed")||t.setAttribute("aria-pressed","false"),t.hasAttribute("type")||t.setAttribute("type","button")},i=function(t){t.hasAttribute("aria-hidden")||t.setAttribute("aria-hidden","true")},a=function(t){t.setAttribute("aria-pressed","true"===t.getAttribute("aria-pressed")?"false":"true")},n=function(t){t.setAttribute("aria-hidden","true"===t.getAttribute("aria-hidden")?"false":"true")},u=exports.collapsiblize=function(t){var u=t.heading,s=t.panel;e(s),r(u),i(s),u.addEventListener("click",function(){a(u),n(s)})};
},{}],6:[function(require,module,exports) {
"use strict";var e=require("./collapsiblize");function r(e){if(Array.isArray(e)){for(var r=0,l=Array(e.length);r<e.length;r++)l[r]=e[r];return l}return Array.from(e)}window.addEventListener("load",function(){[].concat(r(document.querySelectorAll("[data-collapsible]"))).forEach(function(r){var l=r.querySelector(".collapsible-heading"),a=r.querySelector(".collapsible-panel");l&&a&&(0,e.collapsiblize)({heading:l,panel:a})})});
},{"./collapsiblize":7}]},{},[6])