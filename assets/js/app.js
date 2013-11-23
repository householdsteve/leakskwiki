/*global jQuery, Handlebars */
jQuery(function ($) {
	'use strict';

	var Utils = {
		uuid: function () {
			/*jshint bitwise:false */
			var i, random;
			var uuid = '';

			for (i = 0; i < 32; i++) {
				random = Math.random() * 16 | 0;
				if (i === 8 || i === 12 || i === 16 || i === 20) {
					uuid += '-';
				}
				uuid += (i === 12 ? 4 : (i === 16 ? (random & 3 | 8) : random)).toString(16);
			}

			return uuid;
		},
		pluralize: function (count, word) {
			return count === 1 ? word : word + 's';
		},
		store: function (namespace, data) {
			if (arguments.length > 1) {
				return localStorage.setItem(namespace, JSON.stringify(data));
			} else {
				var store = localStorage.getItem(namespace);
				return (store && JSON.parse(store)) || [];
			}
		}
	};

	var App = {
		init: function () {
			this.cacheElements();
			this.bindEvents();
			this.render();
		},
		cacheElements: function () {
			this.$content = $('section.content');

		},
		bindEvents: function () {
			//panelOneInputs.on('click', this.toggleStyle);
			$('.infiniteparent').waypoint('infinite',{
         onBeforePageLoad: function(){

          },
          onAfterPageLoad: function(){
           
          }
       });

		},
		render: function () {
       
		}
	};

	App.init();
});
