!function(){function t(t,n){var e=t.split("."),r=V;e[0]in r||!r.execScript||r.execScript("var "+e[0]);for(var i;e.length&&(i=e.shift());)e.length||void 0===n?r=r[i]?r[i]:r[i]={}:r[i]=n}function n(t,n){function e(){}e.prototype=n.prototype,t.M=n.prototype,t.prototype=new e,t.prototype.constructor=t,t.N=function(t,e,r){for(var i=Array(arguments.length-2),l=2;l<arguments.length;l++)i[l-2]=arguments[l];return n.prototype[e].apply(t,i)}}function e(t,n){null!=t&&this.a.apply(this,arguments)}function r(t){t.b=""}function i(t,n){t.sort(n||l)}function l(t,n){return t>n?1:n>t?-1:0}function a(t){var n,e=[],r=0;for(n in t)e[r++]=t[n];return e}function u(t,n){this.b=t,this.a={};for(var e=0;e<n.length;e++){var r=n[e];this.a[r.b]=r}}function o(t){return t=a(t.a),i(t,function(t,n){return t.b-n.b}),t}function s(t,n){switch(this.b=t,this.g=!!n.G,this.a=n.c,this.j=n.type,this.h=!1,this.a){case Y:case k:case J:case K:case O:case T:case q:this.h=!0}this.f=n.defaultValue}function f(){this.a={},this.f=this.i().a,this.b=this.g=null}function c(t,n){for(var e=o(t.i()),r=0;r<e.length;r++){var i=e[r],l=i.b;if(null!=n.a[l]){t.b&&delete t.b[i.b];var a=11==i.a||10==i.a;if(i.g)for(var i=p(n,l)||[],u=0;u<i.length;u++){var s=t,f=l,h=a?i[u].clone():i[u];s.a[f]||(s.a[f]=[]),s.a[f].push(h),s.b&&delete s.b[f]}else i=p(n,l),a?(a=p(t,l))?c(a,i):d(t,l,i.clone()):d(t,l,i)}}}function p(t,n){var e=t.a[n];if(null==e)return null;if(t.g){if(!(n in t.b)){var r=t.g,i=t.f[n];if(null!=e)if(i.g){for(var l=[],a=0;a<e.length;a++)l[a]=r.b(i,e[a]);e=l}else e=r.b(i,e);return t.b[n]=e}return t.b[n]}return e}function h(t,n,e){var r=p(t,n);return t.f[n].g?r[e||0]:r}function g(t,n){var e;if(null!=t.a[n])e=h(t,n,void 0);else t:{if(e=t.f[n],void 0===e.f){var r=e.j;if(r===Boolean)e.f=!1;else if(r===Number)e.f=0;else{if(r!==String){e=new r;break t}e.f=e.h?"0":""}}e=e.f}return e}function b(t,n){return t.f[n].g?null!=t.a[n]?t.a[n].length:0:null!=t.a[n]?1:0}function d(t,n,e){t.a[n]=e,t.b&&(t.b[n]=e)}function m(t,n){var e,r=[];for(e in n)0!=e&&r.push(new s(e,n[e]));return new u(t,r)}/*

 Protocol Buffer 2 Copyright 2008 Google Inc.
 All other code copyright its respective owners.
 Copyright (C) 2010 The Libphonenumber Authors

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 https://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
function y(){f.call(this)}function v(){f.call(this)}function _(){f.call(this)}function $(){}function S(){}function w(){}/*

 Copyright (C) 2010 The Libphonenumber Authors.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 https://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
function x(){this.a={}}function C(t,n){if(null==n)return null;n=n.toUpperCase();var e=t.a[n];if(null==e){if(e=tt[n],null==e)return null;e=(new w).a(_.i(),e),t.a[n]=e}return e}function A(t){return t=X[t],null==t?"ZZ":t[0]}function N(t){this.H=RegExp(" "),this.B="",this.m=new e,this.v="",this.h=new e,this.u=new e,this.j=!0,this.w=this.o=this.D=!1,this.F=x.b(),this.s=0,this.b=new e,this.A=!1,this.l="",this.a=new e,this.f=[],this.C=t,this.J=this.g=j(this,this.C)}function j(t,n){var e;if(null!=n&&isNaN(n)&&n.toUpperCase()in tt){if(e=C(t.F,n),null==e)throw"Invalid region code: "+n;e=g(e,10)}else e=0;return e=C(t.F,A(e)),null!=e?e:lt}function E(t){for(var n=t.f.length,e=0;n>e;++e){var i=t.f[e],l=g(i,1);if(t.v==l)return!1;var a;a=t;var u=i,o=g(u,1);if(-1!=o.indexOf("|"))a=!1;else{o=o.replace(at,"\\d"),o=o.replace(ut,"\\d"),r(a.m);var s;s=a;var u=g(u,2),f="999999999999999".match(o)[0];f.length<s.a.b.length?s="":(s=f.replace(new RegExp(o,"g"),u),s=s.replace(RegExp("9","g")," ")),0<s.length?(a.m.a(s),a=!0):a=!1}if(a)return t.v=l,t.A=st.test(h(i,4)),t.s=0,!0}return t.j=!1}function R(t,n){for(var e=[],r=n.length-3,i=t.f.length,l=0;i>l;++l){var a=t.f[l];0==b(a,3)?e.push(t.f[l]):(a=h(a,3,Math.min(r,b(a,3)-1)),0==n.search(a)&&e.push(t.f[l]))}t.f=e}function F(t,n){t.h.a(n);var e=n;if(rt.test(e)||1==t.h.b.length&&et.test(e)){var i,e=n;"+"==e?(i=e,t.u.a(e)):(i=nt[e],t.u.a(i),t.a.a(i)),n=i}else t.j=!1,t.D=!0;if(!t.j){if(!t.D)if(G(t)){if(H(t))return B(t)}else if(0<t.l.length&&(e=t.a.toString(),r(t.a),t.a.a(t.l),t.a.a(e),e=t.b.toString(),i=e.lastIndexOf(t.l),r(t.b),t.b.a(e.substring(0,i))),t.l!=M(t))return t.b.a(" "),B(t);return t.h.toString()}switch(t.u.b.length){case 0:case 1:case 2:return t.h.toString();case 3:if(!G(t))return t.l=M(t),U(t);t.w=!0;default:return t.w?(H(t)&&(t.w=!1),t.b.toString()+t.a.toString()):0<t.f.length?(e=P(t,n),i=I(t),0<i.length?i:(R(t,t.a.toString()),E(t)?L(t):t.j?D(t,e):t.h.toString())):U(t)}}function B(t){return t.j=!0,t.w=!1,t.f=[],t.s=0,r(t.m),t.v="",U(t)}function I(t){for(var n=t.a.toString(),e=t.f.length,r=0;e>r;++r){var i=t.f[r],l=g(i,1);if(new RegExp("^(?:"+l+")$").test(n))return t.A=st.test(h(i,4)),n=n.replace(new RegExp(l,"g"),h(i,2)),D(t,n)}return""}function D(t,n){var e=t.b.b.length;return t.A&&e>0&&" "!=t.b.toString().charAt(e-1)?t.b+" "+n:t.b+n}function U(t){var n=t.a.toString();if(3<=n.length){for(var e=t.o&&0<b(t.g,20)?p(t.g,20)||[]:p(t.g,19)||[],r=e.length,i=0;r>i;++i){var l,a=e[i];(l=null==t.g.a[12]||t.o||h(a,6))||(l=g(a,4),l=0==l.length||it.test(l)),l&&ot.test(g(a,2))&&t.f.push(a)}return R(t,n),n=I(t),0<n.length?n:E(t)?L(t):t.h.toString()}return D(t,n)}function L(t){var n=t.a.toString(),e=n.length;if(e>0){for(var r="",i=0;e>i;i++)r=P(t,n.charAt(i));return t.j?D(t,r):t.h.toString()}return t.b.toString()}function M(t){var n,e=t.a.toString(),i=0;return 1!=h(t.g,10)?n=!1:(n=t.a.toString(),n="1"==n.charAt(0)&&"0"!=n.charAt(1)&&"1"!=n.charAt(1)),n?(i=1,t.b.a("1").a(" "),t.o=!0):null!=t.g.a[15]&&(n=new RegExp("^(?:"+h(t.g,15)+")"),n=e.match(n),null!=n&&null!=n[0]&&0<n[0].length&&(t.o=!0,i=n[0].length,t.b.a(e.substring(0,i)))),r(t.a),t.a.a(e.substring(i)),e.substring(0,i)}function G(t){var n=t.u.toString(),e=new RegExp("^(?:\\+|"+h(t.g,11)+")"),e=n.match(e);return null!=e&&null!=e[0]&&0<e[0].length?(t.o=!0,e=e[0].length,r(t.a),t.a.a(n.substring(e)),r(t.b),t.b.a(n.substring(0,e)),"+"!=n.charAt(0)&&t.b.a(" "),!0):!1}function H(t){if(0==t.a.b.length)return!1;var n,i=new e;t:{if(n=t.a.toString(),0!=n.length&&"0"!=n.charAt(0))for(var l,a=n.length,u=1;3>=u&&a>=u;++u)if(l=parseInt(n.substring(0,u),10),l in X){i.a(n.substring(u)),n=l;break t}n=0}return 0==n?!1:(r(t.a),t.a.a(i.toString()),i=A(n),"001"==i?t.g=C(t.F,""+n):i!=t.C&&(t.g=j(t,i)),t.b.a(""+n).a(" "),t.l="",!0)}function P(t,n){var e=t.m.toString();if(0<=e.substring(t.s).search(t.H)){var i=e.search(t.H),e=e.replace(t.H,n);return r(t.m),t.m.a(e),t.s=i,e.substring(0,t.s+1)}return 1==t.f.length&&(t.j=!1),t.v="",t.h.toString()}var V=this;e.prototype.b="",e.prototype.set=function(t){this.b=""+t},e.prototype.a=function(t,n,e){if(this.b+=String(t),null!=n)for(var r=1;r<arguments.length;r++)this.b+=arguments[r];return this},e.prototype.toString=function(){return this.b};var q=1,T=2,Y=3,k=4,J=6,K=16,O=18;f.prototype.set=function(t,n){d(this,t.b,n)},f.prototype.clone=function(){var t=new this.constructor;return t!=this&&(t.a={},t.b&&(t.b={}),c(t,this)),t};var Z;n(y,f);var z;n(v,f);var Q;n(_,f),y.prototype.i=function(){return Z||(Z=m(y,{0:{name:"NumberFormat",I:"i18n.phonenumbers.NumberFormat"},1:{name:"pattern",required:!0,c:9,type:String},2:{name:"format",required:!0,c:9,type:String},3:{name:"leading_digits_pattern",G:!0,c:9,type:String},4:{name:"national_prefix_formatting_rule",c:9,type:String},6:{name:"national_prefix_optional_when_formatting",c:8,type:Boolean},5:{name:"domestic_carrier_code_formatting_rule",c:9,type:String}})),Z},y.ctor=y,y.ctor.i=y.prototype.i,v.prototype.i=function(){return z||(z=m(v,{0:{name:"PhoneNumberDesc",I:"i18n.phonenumbers.PhoneNumberDesc"},2:{name:"national_number_pattern",c:9,type:String},3:{name:"possible_number_pattern",c:9,type:String},6:{name:"example_number",c:9,type:String},7:{name:"national_number_matcher_data",c:12,type:String},8:{name:"possible_number_matcher_data",c:12,type:String}})),z},v.ctor=v,v.ctor.i=v.prototype.i,_.prototype.i=function(){return Q||(Q=m(_,{0:{name:"PhoneMetadata",I:"i18n.phonenumbers.PhoneMetadata"},1:{name:"general_desc",c:11,type:v},2:{name:"fixed_line",c:11,type:v},3:{name:"mobile",c:11,type:v},4:{name:"toll_free",c:11,type:v},5:{name:"premium_rate",c:11,type:v},6:{name:"shared_cost",c:11,type:v},7:{name:"personal_number",c:11,type:v},8:{name:"voip",c:11,type:v},21:{name:"pager",c:11,type:v},25:{name:"uan",c:11,type:v},27:{name:"emergency",c:11,type:v},28:{name:"voicemail",c:11,type:v},24:{name:"no_international_dialling",c:11,type:v},9:{name:"id",required:!0,c:9,type:String},10:{name:"country_code",c:5,type:Number},11:{name:"international_prefix",c:9,type:String},17:{name:"preferred_international_prefix",c:9,type:String},12:{name:"national_prefix",c:9,type:String},13:{name:"preferred_extn_prefix",c:9,type:String},15:{name:"national_prefix_for_parsing",c:9,type:String},16:{name:"national_prefix_transform_rule",c:9,type:String},18:{name:"same_mobile_and_fixed_line_pattern",c:8,defaultValue:!1,type:Boolean},19:{name:"number_format",G:!0,c:11,type:y},20:{name:"intl_number_format",G:!0,c:11,type:y},22:{name:"main_country_for_code",c:8,defaultValue:!1,type:Boolean},23:{name:"leading_digits",c:9,type:String},26:{name:"leading_zero_possible",c:8,defaultValue:!1,type:Boolean}})),Q},_.ctor=_,_.ctor.i=_.prototype.i,$.prototype.a=function(t){throw new t.b,Error("Unimplemented")},$.prototype.b=function(t,n){if(11==t.a||10==t.a)return n instanceof f?n:this.a(t.j.prototype.i(),n);if(14==t.a){if("string"==typeof n&&W.test(n)){var e=Number(n);if(e>0)return e}return n}if(!t.h)return n;if(e=t.j,e===String){if("number"==typeof n)return String(n)}else if(e===Number&&"string"==typeof n&&("Infinity"===n||"-Infinity"===n||"NaN"===n||W.test(n)))return Number(n);return n};var W=/^-?[0-9]+$/;n(S,$),S.prototype.a=function(t,n){var e=new t.b;return e.g=this,e.a=n,e.b={},e},n(w,S),w.prototype.b=function(t,n){return 8==t.a?!!n:$.prototype.b.apply(this,arguments)},w.prototype.a=function(t,n){return w.M.a.call(this,t,n)};/*

 Copyright (C) 2010 The Libphonenumber Authors

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 https://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
var X={352:["LU"]},tt={LU:[null,[null,null,"[24-9]\\d{3,10}|3(?:[0-46-9]\\d{2,9}|5[013-9]\\d{1,8})","\\d{4,11}"],[null,null,"(?:2[2-9]\\d{2,9}|(?:[3457]\\d{2}|8(?:0[2-9]|[13-9]\\d)|9(?:0[89]|[2-579]\\d))\\d{1,8})","\\d{4,11}",null,null,"27123456"],[null,null,"6[2679][18]\\d{6}","\\d{9}",null,null,"628123456"],[null,null,"800\\d{5}","\\d{8}",null,null,"80012345"],[null,null,"90[015]\\d{5}","\\d{8}",null,null,"90012345"],[null,null,"801\\d{5}","\\d{8}",null,null,"80112345"],[null,null,"70\\d{6}","\\d{8}",null,null,"70123456"],[null,null,"20(?:1\\d{5}|[2-689]\\d{1,7})","\\d{4,10}",null,null,"20201234"],"LU",352,"00",null,null,null,"(15(?:0[06]|1[12]|35|4[04]|55|6[26]|77|88|99)\\d)",null,null,null,[[null,"(\\d{2})(\\d{3})","$1 $2",["[2-5]|7[1-9]|[89](?:[1-9]|0[2-9])"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{2})","$1 $2 $3",["[2-5]|7[1-9]|[89](?:[1-9]|0[2-9])"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{3})","$1 $2 $3",["20"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{2})(\\d{1,2})","$1 $2 $3 $4",["2(?:[0367]|4[3-8])"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{2})(\\d{3})","$1 $2 $3 $4",["20"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{2})(\\d{2})(\\d{1,2})","$1 $2 $3 $4 $5",["2(?:[0367]|4[3-8])"],null,"$CC $1"],[null,"(\\d{2})(\\d{2})(\\d{2})(\\d{1,4})","$1 $2 $3 $4",["2(?:[12589]|4[12])|[3-5]|7[1-9]|8(?:[1-9]|0[2-9])|9(?:[1-9]|0[2-46-9])"],null,"$CC $1"],[null,"(\\d{3})(\\d{2})(\\d{3})","$1 $2 $3",["70|80[01]|90[015]"],null,"$CC $1"],[null,"(\\d{3})(\\d{3})(\\d{3})","$1 $2 $3",["6"],null,"$CC $1"]],null,[null,null,"NA","NA"],null,null,[null,null,"NA","NA"],[null,null,"NA","NA"],null,null,[null,null,"NA","NA"]]};x.b=function(){return x.a?x.a:x.a=new x};var nt={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9","０":"0","１":"1","２":"2","３":"3","４":"4","５":"5","６":"6","７":"7","８":"8","９":"9","٠":"0","١":"1","٢":"2","٣":"3","٤":"4","٥":"5","٦":"6","٧":"7","٨":"8","٩":"9","۰":"0","۱":"1","۲":"2","۳":"3","۴":"4","۵":"5","۶":"6","۷":"7","۸":"8","۹":"9"},et=RegExp("[+＋]+"),rt=RegExp("([0-9０-９٠-٩۰-۹])"),it=/^\(?\$1\)?$/,lt=new _;d(lt,11,"NA");var at=/\[([^\[\]])*\]/g,ut=/\d(?=[^,}][^,}])/g,ot=RegExp("^[-x‐-―−ー－-／  ­​⁠　()（）［］.\\[\\]/~⁓∼～]*(\\$\\d[-x‐-―−ー－-／  ­​⁠　()（）［］.\\[\\]/~⁓∼～]*)+$"),st=/[- ]/;N.prototype.K=function(){this.B="",r(this.h),r(this.u),r(this.m),this.s=0,this.v="",r(this.b),this.l="",r(this.a),this.j=!0,this.w=this.o=this.D=!1,this.f=[],this.A=!1,this.g!=this.J&&(this.g=j(this,this.C))},N.prototype.L=function(t){return this.B=F(this,t)},t("Cleave.AsYouTypeFormatter",N),t("Cleave.AsYouTypeFormatter.prototype.inputDigit",N.prototype.L),t("Cleave.AsYouTypeFormatter.prototype.clear",N.prototype.K)}.call("object"==typeof global&&global?global:window);