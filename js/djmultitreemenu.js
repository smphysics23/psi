/**
* @version 1.5.1
* @package DJ-MultiTree Menu
* @copyright Copyright (C) 2010 Blue Constant Media LTD, All rights reserved.
* @license http://www.gnu.org/licenses GNU/GPL
* @author url: http://design-joomla.eu
* @author email contact@design-joomla.eu
* @developer Szymon Woronowski - szymon.woronowski@design-joomla.eu
*
*
* DJ-MultiTree Menu is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* DJ-MultiTree Menu is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with DJ-MultiTree Menu. If not, see <http://www.gnu.org/licenses/>.
*
*/

(function($){ // Mootools Safe Mode ON (require mootools 1.2.3+)

this.afterDJMultiTreeMenuHide = $empty;

this.DJTreeMenus = new Array();

this.DJTreeMenu = new Class({
	
	options: {
		transition: Fx.Transitions.Cubic.easeOut,	// transition effect for open/close submenu
		duration: 300,								// duration of transition effect at first menu level
		delay: 2000,								// delay before close submenu at first menu level
		height_fx: true,
		width_fx: true,
		opacity_fx: true,
		height_fx_sub: true,
		width_fx_sub: true,
		opacity_fx_sub: true,
		submenu_tree: 2,							// 0 - hide / 1 - show / 2 - show on mouse over
		mid: 0,										// module id
		wrapper: null
	},
	
    initialize: function(menu,level,parent,options){
		this.options = $merge(this.options, options);
		if(level>0) {
			this.parent = parent;
		} else {
			this.parent = null;
			this.options.wrapper = parent;
		}
		this.level = level;
        this.menu = menu;
		this.subMenu = menu.getElement('div.djsubwrap');
		this.subMenuFX = new Fx.Morph(this.subMenu, {transition: this.options.transition, duration: this.options.duration, wait: false})
		.addEvent('onComplete',this.onCompleteFX.bind(this)).addEvent('onStart',this.onStartFX.bind(this)).addEvent('onCancel',this.onCancelFX.bind(this));
		this.menu.addEvent('mouseenter',this.showSubmenu.bind(this));
		this.menu.addEvent('mouseleave',this.hideSubmenu.bind(this));
		this.hover = false;
		this.children = new Array();
		this.initChildren();
	},
	
	showSubmenu: function(){
		this.hover = true;
		if(this.menu.hasClass('hover')&&this.subMenu.getStyle('overflow') == 'visible') {
			return; // do nothing if menu is open
		}
		this.menu.addClass('hover');
		if (!this.height) this.initHovered();
		this.hideOther(this); // hide other submenus at the same level
		if(this.level>0) this.parent.subMenu.setStyle('overflow','visible');
		this.subMenuFX.start(this.properties_show);
	},
	
	hideSubmenu: function(){
		this.hover = false;
		(function(){
			if(this.hover) return;
			this.subMenuFX.start(this.properties_hide).chain(function(){
				this.menu.removeClass('hover');
				if($chk(afterDJMultiTreeMenuHide)) afterDJMultiTreeMenuHide();
			}.bind(this));
		}).delay(this.options.delay, this);
	},
	
	onStartFX: function(){
		this.subMenu.setStyle('overflow','hidden');
	},
	
	onCompleteFX: function(){
		this.subMenu.setStyle('overflow','visible');
	},
	
	onCancelFX: function(){
		this.subMenuFX.clearChain();
	},
	
    initHovered: function(){
		if(!$chk(this.options.wrapper)) this.options.wrapper = $('dj-mtmenu' + this.options.mid);
		var offset = this.subMenu.getPosition().x + this.subMenu.getSize().x - this.options.wrapper.getSize().x - this.options.wrapper.getPosition().x;
		if(offset > 0){			
				this.subMenu.setStyle('margin-left',-offset);
		}
		
		if(this.options.submenu_tree!=1) this.children.each(function(child) {
			var sub = child.getElement('.dj-submenu2');
			sub.set('morph',{duration: 250, transition: 'sine:in:out'});
			var height = sub.getStyle('height').toInt();
			sub.setStyle('height',0);
			sub.setStyle('opacity',0);
			sub.setStyle('overflow','hidden');
			if(!this.options.submenu_tree) { // if submenu tree hides
				child.getElement('a.dj-more').removeClass('dj-more');
			}
			if (this.options.submenu_tree == 2) { // if submenu tree shows on mouse over 
				child.addEvent('mouseenter', function(){
					this.subMenu.fireEvent('mouseleave');
					sub.morph({
						'height': height,
						'opacity': 1
					});
				}.bind(this));
				this.subMenu.addEvent('mouseleave', function(){
					sub.morph({
						'height': 0,
						'opacity': 0
					});
				});
			}
		}.bind(this));
		
		this.height = this.subMenu.getStyle('height').toInt();
		this.width = this.subMenu.getStyle('width').toInt();
		
		var min_height = this.height;
		var min_width = this.width;
		var min_opacity = 1;		
		if (this.options.height_fx) min_height = 0; 
		if (this.options.width_fx) min_width = 0;
		if (this.options.opacity_fx) min_opacity = 0;
		
		this.properties_show = {'height': this.height, 'width': this.width, 'opacity': 1};
		this.properties_hide = {'height': min_height, 'width': min_width, 'opacity': min_opacity};
		this.subMenuFX.set(this.properties_hide);
	},
	
	initChildren: function(){
		var children = this.subMenu.getElements('li');
		
		children.each(function(child){
			
			if(child.getElement('.dj-submenu2')) {
				this.children.include(child);
			}
			child.addEvent('mouseenter',function(){
				child.addClass('hover');
			});
			child.addEvent('mouseleave',function(){
				child.removeClass('hover');
			});
			
		}.bind(this));
	},
	
	hideOther: function(over_menu){
		if(over_menu.level==0) {
			DJTreeMenus.each(function(djmenu){
				if(djmenu.menu.hasClass('hover') && djmenu != over_menu) {
					djmenu.subMenuFX.start(djmenu.properties_hide).chain(function(){
						this.menu.removeClass('hover');
						if($chk(afterDJMultiTreeMenuHide)) afterDJMultiTreeMenuHide();
					}.bind(djmenu));
				}
			});
		}
	}
});

})(document.id);