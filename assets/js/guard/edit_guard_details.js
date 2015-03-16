$(document).ready(function(){
	$("#photo").change(function(){
						readURL(this);
						});
});

$(document).ready(function() {
	var showPhoto = function () {
		this.div = $('<div style="position: fixed; z-index: 1000000; height: 300px; width: 300px; min-width: 60px;  background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;transition: all 0.5s cubic-bezier(.23,1.34,1,.93);"></div>');
		return this;
	}
	showPhoto.prototype = {
		show: function(imageUrl, x, y, xoffset, yoffset, size, screen) {
			if(arguments.length==6) {			
				var top = y-yoffset;
				if (top + 200 > window.innerHeight) {
					top -= 170;
				}
				this.div.css({
					"background-image": "url('"+imageUrl+"')",
					"top": (top)+"px",
					"left": (x+21-xoffset)+"px",
					width: 0,
					height: 0
					// "width": parseInt(200*size.width/size.height-1)+"px"
				});
			}
			$(document.body).append(this.div);
			var $this = this;
			(function() {
				setTimeout(function(){
					// console.log($this);
					$this.div.css({
						"height": "150px",
						width: "150px"
					});
				}, 10);
			})();
		},
		hide: function() {
			var $this = this;
			(function() {
				setTimeout(function(){
					// console.log($this);
					$this.div.detach();
				}, 300);
			})();
			$this.div.css({
				"height": "0px",
				width: "0px"
			});
		}
	}
	var photo = new showPhoto();
	$(".photo-zoom").on("mouseenter", function(e) {
		e.preventDefault();
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$(".photo-zoom").on("mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
});



function readURL(input) {
	var allowedTypes = {
		"image/jpeg": true,
		"image/bmp": true,
		"image/jpg": true,
		"image/png": true,
		"image/gif": true
	};
        if (input.files && input.files[0]) {
			var file = input.files[0];
			var error = false;
			if(!allowedTypes[file.type]) {
				alert("Invalid filetype, Choose again!");
				error = true;
			}
			else if(file.size > 1024*1024) {
				alert('Image Size is greator than 1 MB, Choose again!');
				//showError('Size is greater than 1MB.', errorTarget);
				error = true;
			}
			if(error) {
				input.value = null;
				$("#preview").attr("style", "");
			}
        }
}
