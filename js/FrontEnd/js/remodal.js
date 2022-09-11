!function(t,n){"function"==typeof define&&define.amd?define(["jquery"],function(a){return n(t,a)}):"object"==typeof exports?n(t,require("jquery")):n(t,t.jQuery||t.Zepto)}(this,function(t,n){"use strict";function a(t){if(y&&"none"===t.css("animation-name")&&"none"===t.css("-webkit-animation-name")&&"none"===t.css("-moz-animation-name")&&"none"===t.css("-o-animation-name")&&"none"===t.css("-ms-animation-name"))return 0;var n,a,e,i,o=t.css("animation-duration")||t.css("-webkit-animation-duration")||t.css("-moz-animation-duration")||t.css("-o-animation-duration")||t.css("-ms-animation-duration")||"0s",s=t.css("animation-delay")||t.css("-webkit-animation-delay")||t.css("-moz-animation-delay")||t.css("-o-animation-delay")||t.css("-ms-animation-delay")||"0s",r=t.css("animation-iteration-count")||t.css("-webkit-animation-iteration-count")||t.css("-moz-animation-iteration-count")||t.css("-o-animation-iteration-count")||t.css("-ms-animation-iteration-count")||"1";for(o=o.split(", "),s=s.split(", "),r=r.split(", "),i=0,a=o.length,n=Number.NEGATIVE_INFINITY;a>i;i++)e=parseFloat(o[i])*parseInt(r[i],10)+parseFloat(s[i]),e>n&&(n=e);return e}function e(){if(n(document.body).height()<=n(window).height())return 0;var t,a,e=document.createElement("div"),i=document.createElement("div");return e.style.visibility="hidden",e.style.width="100px",document.body.appendChild(e),t=e.offsetWidth,e.style.overflow="scroll",i.style.width="100%",e.appendChild(i),a=i.offsetWidth,e.parentNode.removeChild(e),t-a}function i(){var t,a,i=n("html"),o=l("is-locked");i.hasClass(o)||(a=n(document.body),t=parseInt(a.css("padding-right"),10)+e(),a.css("padding-right",t+"px"),i.addClass(o))}function o(){var t,a,i=n("html"),o=l("is-locked");i.hasClass(o)&&(a=n(document.body),t=parseInt(a.css("padding-right"),10)-e(),a.css("padding-right",t+"px"),i.removeClass(o))}function s(t,n,a,e){var i=l("is",n),o=[l("is",$.CLOSING),l("is",$.OPENING),l("is",$.CLOSED),l("is",$.OPENED)].join(" ");t.$bg.removeClass(o).addClass(i),t.$overlay.removeClass(o).addClass(i),t.$wrapper.removeClass(o).addClass(i),t.$modal.removeClass(o).addClass(i),t.state=n,!a&&t.$modal.trigger({type:n,reason:e},[{reason:e}])}function r(t,e,i){var o=0,s=function(t){t.target===this&&o++},r=function(t){t.target===this&&0===--o&&(n.each(["$bg","$overlay","$wrapper","$modal"],function(t,n){i[n].off(v+" "+C)}),e())};n.each(["$bg","$overlay","$wrapper","$modal"],function(t,n){i[n].on(v,s).on(C,r)}),t(),0===a(i.$bg)&&0===a(i.$overlay)&&0===a(i.$wrapper)&&0===a(i.$modal)&&(n.each(["$bg","$overlay","$wrapper","$modal"],function(t,n){i[n].off(v+" "+C)}),e())}function c(t){t.state!==$.CLOSED&&(n.each(["$bg","$overlay","$wrapper","$modal"],function(n,a){t[a].off(v+" "+C)}),t.$bg.removeClass(t.settings.modifier),t.$overlay.removeClass(t.settings.modifier).hide(),t.$wrapper.hide(),o(),s(t,$.CLOSED,!0))}function d(t){var n,a,e,i,o={};for(t=t.replace(/\s*:\s*/g,":").replace(/\s*,\s*/g,","),n=t.split(","),i=0,a=n.length;a>i;i++)n[i]=n[i].split(":"),e=n[i][1],("string"==typeof e||e instanceof String)&&(e="true"===e||("false"===e?!1:e)),("string"==typeof e||e instanceof String)&&(e=isNaN(e)?e:+e),o[n[i][0]]=e;return o}function l(){for(var t=h,n=0;n<arguments.length;++n)t+="-"+arguments[n];return t}function m(){var t,a,e=location.hash.replace("#","");if(e){try{a=n("[data-"+g+"-id="+e.replace(new RegExp("/","g"),"\\/")+"]")}catch(i){}a&&a.length&&(t=n[g].lookup[a.data(g)],t&&t.settings.hashTracking&&t.open())}else u&&u.state===$.OPENED&&u.settings.hashTracking&&u.close()}function p(t,a){var e=n(document.body),i=this;i.settings=n.extend({},O,a),i.index=n[g].lookup.push(i)-1,i.state=$.CLOSED,i.$overlay=n("."+l("overlay")),i.$overlay.length||(i.$overlay=n("<div>").addClass(l("overlay")+" "+l("is",$.CLOSED)).hide(),e.append(i.$overlay)),i.$bg=n("."+l("bg")).addClass(l("is",$.CLOSED)),i.$modal=t.addClass(h+" "+l("is-initialized")+" "+i.settings.modifier+" "+l("is",$.CLOSED)).attr("tabindex","-1"),i.$wrapper=n("<div>").addClass(l("wrapper")+" "+i.settings.modifier+" "+l("is",$.CLOSED)).hide().append(i.$modal),e.append(i.$wrapper),i.$wrapper.on("click."+h,"[data-"+g+'-action="close"]',function(t){t.preventDefault(),i.close()}),i.$wrapper.on("click."+h,"[data-"+g+'-action="cancel"]',function(t){t.preventDefault(),i.$modal.trigger(E.CANCELLATION),i.settings.closeOnCancel&&i.close(E.CANCELLATION)}),i.$wrapper.on("click."+h,"[data-"+g+'-action="confirm"]',function(t){t.preventDefault(),i.$modal.trigger(E.CONFIRMATION),i.settings.closeOnConfirm&&i.close(E.CONFIRMATION)}),i.$wrapper.on("click."+h,function(t){var a=n(t.target);a.hasClass(l("wrapper"))&&i.settings.closeOnOutsideClick&&i.close()})}var u,f,g="remodal",h=t.REMODAL_GLOBALS&&t.REMODAL_GLOBALS.NAMESPACE||g,v=n.map(["animationstart","webkitAnimationStart","MSAnimationStart","oAnimationStart"],function(t){return t+"."+h}).join(" "),C=n.map(["animationend","webkitAnimationEnd","MSAnimationEnd","oAnimationEnd"],function(t){return t+"."+h}).join(" "),O=n.extend({hashTracking:!0,closeOnConfirm:!0,closeOnCancel:!0,closeOnEscape:!0,closeOnOutsideClick:!0,modifier:""},t.REMODAL_GLOBALS&&t.REMODAL_GLOBALS.DEFAULTS),$={CLOSING:"closing",CLOSED:"closed",OPENING:"opening",OPENED:"opened"},E={CONFIRMATION:"confirmation",CANCELLATION:"cancellation"},y=function(){var t=document.createElement("div").style;return void 0!==t.animationName||void 0!==t.WebkitAnimationName||void 0!==t.MozAnimationName||void 0!==t.msAnimationName||void 0!==t.OAnimationName}();p.prototype.open=function(){var t,a=this;a.state!==$.OPENING&&a.state!==$.CLOSING&&(t=a.$modal.attr("data-"+g+"-id"),t&&a.settings.hashTracking&&(f=n(window).scrollTop(),location.hash=t),u&&u!==a&&c(u),u=a,i(),a.$bg.addClass(a.settings.modifier),a.$overlay.addClass(a.settings.modifier).show(),a.$wrapper.show().scrollTop(0),a.$modal.focus(),r(function(){s(a,$.OPENING)},function(){s(a,$.OPENED)},a))},p.prototype.close=function(t){var a=this;a.state!==$.OPENING&&a.state!==$.CLOSING&&(a.settings.hashTracking&&a.$modal.attr("data-"+g+"-id")===location.hash.substr(1)&&(location.hash="",n(window).scrollTop(f)),r(function(){},function(){s(a,$.CLOSED,!1,t)},a))},p.prototype.getState=function(){return this.state},p.prototype.destroy=function(){var t,a=n[g].lookup;c(this),this.$wrapper.remove(),delete a[this.index],t=n.grep(a,function(t){return!!t}).length,0===t&&(this.$overlay.remove(),this.$bg.removeClass(l("is",$.CLOSING)+" "+l("is",$.OPENING)+" "+l("is",$.CLOSED)+" "+l("is",$.OPENED)))},n[g]={lookup:[]},n.fn[g]=function(t){var a,e;return this.each(function(i,o){e=n(o),null==e.data(g)?(a=new p(e,t),e.data(g,a.index),a.settings.hashTracking&&e.attr("data-"+g+"-id")===location.hash.substr(1)&&a.open()):a=n[g].lookup[e.data(g)]}),a},n(document).ready(function(){n(document).on("click","[data-"+g+"-target]",function(t){t.preventDefault();var a=t.currentTarget,e=a.getAttribute("data-"+g+"-target"),i=n("[data-"+g+"-id="+e+"]");n[g].lookup[i.data(g)].open()}),n(document).find("."+h).each(function(t,a){var e=n(a),i=e.data(g+"-options");i?("string"==typeof i||i instanceof String)&&(i=d(i)):i={},e[g](i)}),n(document).on("keydown."+h,function(t){u&&u.settings.closeOnEscape&&u.state===$.OPENED&&27===t.keyCode&&u.close()}),n(window).on("hashchange."+h,m)})});