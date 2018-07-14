function prepareAjaxUpload() {
	var modernUploadEnabled = function() {
	  const fde = document.createElement('div');
	  return (('draggable' in fde) || ('ondragstart' in fde && 'ondrop' in fde)) && 'FormData' in window && 'FileReader' in window;
	}();
	const uploadForm = $("form.file-upload");
	const uploadLabel = uploadForm.find('label');
	
	var fileAdded = function(filenames) {
		uploadLabel.text('');
		$('.upload-preview').remove();
		for (var i = 0; i < filenames.length; i++) {
			uploadLabel.append(filenames[i].name + "<br>");
			previewImage(filenames[i]);
		}
	}
	
	var previewImage = function(imageFile) {
		const reader = new FileReader();
		$(reader).on('load', function() {
			$('<img>').attr({src: reader.result, class: 'upload-preview'}).insertBefore(uploadForm);
		})
		if (imageFile) {
			reader.readAsDataURL(imageFile);
		}
	}
	
	if (modernUploadEnabled) {
		var droppedFiles = false;
		uploadForm.addClass('drop-enabled');
		uploadForm.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
			e.preventDefault();
			e.stopPropagation();
		})
		.on('dragover dragenter', function() {
			$(this).addClass('dragover');
		})
		.on('dragleave dragend drop', function() {
			$(this).removeClass('dragover');
		})
		.on('drop', function(e) {
			droppedFiles = e.originalEvent.dataTransfer.files;
			fileAdded(droppedFiles);
		});
	}

	uploadForm.find('input[type=file]').on('change', function(e) {
		fileAdded(e.target.files);
	});
}


$(document).ready(function() {
	prepareAjaxUpload();
});