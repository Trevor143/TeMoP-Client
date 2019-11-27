/*
@license

dhtmlxGantt v.6.3.0 Professional Evaluation
This software is covered by DHTMLX Evaluation License. Contact sales@dhtmlx.com to get Commercial or Enterprise license. Usage without proper license is prohibited.

(c) XB Software Ltd.

*/
Gantt.plugin(function(e){!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define("ext/dhtmlxgantt_smart_rendering",[],t):"object"==typeof exports?exports["ext/dhtmlxgantt_smart_rendering"]=t():e["ext/dhtmlxgantt_smart_rendering"]=t()}(window,function(){return function(e){var t={};function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(i,r,function(t){return e[t]}.bind(null,r));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/codebase/",n(n.s=242)}({242:function(t,n){e.config.smart_rendering=!0,e._smart_render={getViewPort:function(){var t=e.$ui.getView("timeline"),n=e.$ui.getView("grid"),i=e.$layout;t&&t.isVisible()?i=t:n&&n.isVisible()&&(i=n);var r=i.getSize(),a=e.getScrollState();return{y:a.y,y_end:a.y+r.y,x:a.x,x_end:a.x+r.x}},getScrollSizes:function(){var t=e.getScrollState();return t.x=t.x||0,t.y=t.y||e.getVisibleTaskCount()*e.config.row_height,t},isInViewPort:function(e,t){return!!(e.y<t.y_end&&e.y_end>t.y)},isTaskDisplayed:function(t,n){return!(!e.$keyboardNavigation||!e.$keyboardNavigation.dispatcher.isTaskFocused(t))||this.isInViewPort(this.getTaskPosition(t),this.getViewPort())},isLinkDisplayed:function(e,t){return this.isInViewPort(this.getLinkPosition(e,t),this.getViewPort())},getTaskPosition:function(t){var n=e.getTaskTop(t);return{y:n,y_end:n+e.config.row_height}},getLinkPosition:function(t,n){var i=e.getTaskTop(n.source),r=e.getTaskTop(n.target);return{y:Math.min(i,r),y_end:Math.max(i,r)+e.config.row_height}},getRange:function(t){t=t||0;for(var n=this.getViewPort(),i=Math.floor(Math.max(0,n.y)/e.config.row_height)-t,r=Math.ceil(Math.max(0,n.y_end)/e.config.row_height)+t,a=e.$data.tasksStore.getIndexRange(i,r),o=[],s=0;s<a.length;s++)o.push(a[s].id);return o},_redrawItems:function(e,t){for(var n={},i=0;i<t.length;i++)n[t[i].id]=!0;for(var r={},a=0;a<e.length;a++){var o=e[a];for(var s in o.rendered)if(n[s]){var c=o.rendered[s];c&&c.parentNode&&(r[s]=!0)}else o.hide(s);for(i=0;i<t.length;i++)r[t[i].id]||o.restore(t[i])}},_getVisibleTasks:function(){for(var t=this.getRange(),n=[],i=0;i<t.length;i++){var r=e.getTask(t[i]);r.$index=i,e.resetProjectDates(r),n.push(r)}return n},_getVisibleLinks:function(){for(var t=[],n=e.$data.linksStore.getIndexRange(),i=0;i<n.length;i++)this.isLinkDisplayed(n[i].id,n[i])&&t.push(n[i]);return t},_recalculateLinkedProjects:function(t){for(var n={},i=0;i<t.length;i++)n[t[i].source]=!0,n[t[i].target]=!0;for(var i in n)e.isTaskExists(i)&&e.resetProjectDates(e.getTask(i))},updateRender:function(){e.callEvent("onBeforeSmartRender",[]);var t=this._getVisibleTasks(),n=this._getVisibleLinks();this._recalculateLinkedProjects(n);var i=e.$services.getService("layers"),r=i.getDataRender("task"),a=i.getDataRender("link");this._redrawTasks(r.getLayers(),t),this._redrawItems(a.getLayers(),n),e.callEvent("onSmartRender",[])},_redrawTasks:function(e,t){this._redrawItems(e,t)},cached:{},_takeFromCache:function(e,t,n){this.cached[n]||(this.cached[n]=null);var i=this.cached[n];return void 0!==e?(i||(i=this.cached[n]={}),void 0===i[e]&&(i[e]=t(e)),i[e]):(i||(i=t()),i)},initCache:function(){for(var t=["getLinkPosition","getTaskPosition","isTaskDisplayed","isLinkDisplayed","getViewPort","getScrollSizes"],n=0;n<t.length;n++){var i=t[n],r=e.bind(this[i],this);this[i]=function(e,t){return function(n){return this._takeFromCache(n,e,t)}}(r,i)}this.invalidateCache(),this.initCache=function(){}},invalidateCache:function(){var t=this;function n(){t.cached.getViewPort=null,t.cached.getScrollSizes=null,t.cached.isTaskDisplayed=null,t.cached.isLinkDisplayed=null}function i(){n(),t.cached.isTaskDisplayed=null,t.cached.isLinkDisplayed=null,t.cached.getLinkPosition=null,t.cached.getTaskPosition=null}e.attachEvent("onClear",function(){i()}),e.attachEvent("onParse",function(){i()}),e.attachEvent("onAfterLinkUpdate",function(e){t.cached.isLinkDisplayed&&(t.cached.isLinkDisplayed[e]=void 0),t.cached.getLinkPosition&&(t.cached.getLinkPosition[e]=void 0)}),e.attachEvent("onAfterTaskAdd",i),e.attachEvent("onAfterTaskDelete",i),e.attachEvent("onAfterTaskUpdate",function(e){t.cached.isTaskDisplayed&&(t.cached.isTaskDisplayed[e]=void 0),t.cached.getTaskPosition&&(t.cached.getTaskPosition[e]=void 0)}),e.attachEvent("onGanttScroll",n),e.attachEvent("onDataRender",i),this.invalidateCache=function(){}}},e.attachEvent("onGanttScroll",function(t,n,i,r){e.config.smart_rendering&&(n==r&&t!=i||e._smart_render.updateRender())}),e.attachEvent("onDataRender",function(){e.config.smart_rendering&&e._smart_render.updateRender()}),function(){var t=e.attachEvent("onGanttReady",function(){var n=e.$services.getService("layers");n.getDataRender("task").filters.push(function(t,n){return!e.config.smart_rendering||!!e._smart_render.isTaskDisplayed(t,n)}),n.getDataRender("link").filters.push(function(t,n){return!e.config.smart_rendering||!!e._smart_render.isLinkDisplayed(t,n)}),e.detachEvent(t)})}()}})})});