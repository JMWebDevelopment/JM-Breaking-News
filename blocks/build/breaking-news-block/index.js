!function(){"use strict";var A,n={199:function(){var A=window.wp.element,n=window.wp.blocks,e=window.wp.i18n,r=window.wp.blockEditor;window.wp.components,window.wp.data,window.moment;var g=JSON.parse('{"u2":"jm-breaking-news/jm-breaking-news"}');(0,n.registerBlockType)(g.u2,{icon:{src:(0,A.createElement)("svg",{version:"1.1",id:"Layer_1",xmlns:"http://www.w3.org/2000/svg",xlinkHref:"http://www.w3.org/1999/xlink",x:"0px",y:"0px",width:"256px",height:"256px",viewBox:"0 0 256 256","enable-background":"new 0 0 256 256"},"  ",(0,A.createElement)("image",{id:"image0",width:"256",height:"256",x:"0",y:"0",xlinkHref:"data:image/png;base64,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\nSUVORK5CYII="}))},edit:function(n){var g=n.attributes;return n.setAttributes,n.focus,n.setFocus,n.className,g.getPost,g.hasPost,g.posts,(0,A.createElement)("div",(0,r.useBlockProps)(),(0,A.createElement)("section",{className:"breaking-news-box"},(0,A.createElement)("div",{className:"breaking-news-left"},(0,A.createElement)("h2",{className:"breaking-news-left-h2"},(0,e.__)("Breaking News","jm-breaking-news"))),(0,A.createElement)("div",{className:"breaking-news-right"},(0,A.createElement)("p",{className:"breaking-news-right-h2"},(0,e.__)("Title of the Breaking News Section Will Go Here","jm-breaking-news")))))}})}},e={};function r(A){var g=e[A];if(void 0!==g)return g.exports;var s=e[A]={exports:{}};return n[A](s,s.exports,r),s.exports}r.m=n,A=[],r.O=function(n,e,g,s){if(!e){var t=1/0;for(a=0;a<A.length;a++){e=A[a][0],g=A[a][1],s=A[a][2];for(var w=!0,i=0;i<e.length;i++)(!1&s||t>=s)&&Object.keys(r.O).every((function(A){return r.O[A](e[i])}))?e.splice(i--,1):(w=!1,s<t&&(t=s));if(w){A.splice(a--,1);var E=g();void 0!==E&&(n=E)}}return n}s=s||0;for(var a=A.length;a>0&&A[a-1][2]>s;a--)A[a]=A[a-1];A[a]=[e,g,s]},r.o=function(A,n){return Object.prototype.hasOwnProperty.call(A,n)},function(){var A={276:0,432:0};r.O.j=function(n){return 0===A[n]};var n=function(n,e){var g,s,t=e[0],w=e[1],i=e[2],E=0;if(t.some((function(n){return 0!==A[n]}))){for(g in w)r.o(w,g)&&(r.m[g]=w[g]);if(i)var a=i(r)}for(n&&n(e);E<t.length;E++)s=t[E],r.o(A,s)&&A[s]&&A[s][0](),A[s]=0;return r.O(a)},e=self.webpackChunkjm_breaking_news=self.webpackChunkjm_breaking_news||[];e.forEach(n.bind(null,0)),e.push=n.bind(null,e.push.bind(e))}();var g=r.O(void 0,[432],(function(){return r(199)}));g=r.O(g)}();