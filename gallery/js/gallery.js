var GalleryLib = GalleryLib || {};

function GalleryLib() {
	var extRe = /(?:\.([^.]+))?$/;

	this.getFileType = function(filename) {
		var ext = extRe.exec(filename)[1];
		if (ext) {
			ext = ext.toLowerCase();
		}

		switch (ext) {
		case 'jpg':
		case 'png':
			return 'image';
			break;
		case 'mov':
			return 'video';
			break;
		default:
			return 'folder';
		}
	};

	this.loadFullImage = function() {
		var path = 'service/photo.php?name='
				+ window.encodeURIComponent(this.albumName) + '/'
				+ window.encodeURIComponent(this.photo.filename);

		$('#fullimage-' + this.$index).on('shown.bs.modal', function() {
			var body = $(this).find('.modal-body');
			if (!body.find('img').length) {
				body.append($('<img>', {
					class : 'img-responsive',
					src : path
				}));
			}
		})
	};

	this.initMasonry = function() {
		$('.grid').masonry({
			// options
			itemSelector : '.grid-item',
			columnWidth : 200
		});
	};
}
