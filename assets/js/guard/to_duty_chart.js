$(document).ready(function() {
	var showPhoto = function () {
		this.div = $('<div style="border: 2px solid #aaa; position: fixed; height: 300px; width: 300px; min-width: 60px;  background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;"></div>');
		return this;
	}
	showPhoto.prototype = {
		show: function(imageUrl, x, y, xoffset, yoffset, size, screen) {
			var top = y-yoffset;
			if (top + 200 > window.innerHeight) {
				top -= 120;
			}
			this.div.css({
				"background-image": "url('"+imageUrl+"')",
				"top": (top)+"px",
				"left": (x+61-xoffset)+"px",
				"height": "200px",
				"width": parseInt(200*size.width/size.height)+"px"
			});
			$(document.body).append(this.div);
		},
		hide: function() {
			this.div.detach();
		}
	}
	var photo = new showPhoto();
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#tomorrowDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#tomorrowDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	
	$("#compDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#compDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
});