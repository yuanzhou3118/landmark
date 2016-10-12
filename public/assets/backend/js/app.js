$(function() {
	
	var reader = new FileReader(),
		$fu= $('#fu'),
		$uploadBtn = $('.upload-btn'),
		$delete = $('.delete'),
		$childrens = $('#file li');
	var maxFileSize = 2 * 1024 * 1024,
		maxFileLength = 5,
		count = $('#file li').length,
		$uploadThumb = $('.upload-thumb');
	var checkFileList = [];
	deleteUploadImage(count);
	$fu[0].onchange = function(event) {
		var _s = this,
			file = _s.files[0];
		if (!file.type.match(/(gif|jpe?g|png)$/i)) {
			alert('Please upload an image.');
			return;
		}
		if (+file.size >= maxFileSize) {
			alert('Please upload a file within 2M.');
			return;
		}
		if (checkExistFile(file.name, checkFileList)) {
			alert('Upload already.');
			return;
		}
		count++;
		checkFileList.push(file.name);
		reader.readAsDataURL(this.files[0]);
		reader.onload = function() {
			$('#file').append('<li><img src="' + this.result + '"><span class="delete"></span></li>');
			$('#file li:hidden').remove();
			$delete = $('.delete');
			$childrens = $('#file li');
			deleteUploadImage($delete.length);
			if(count === maxFileLength) {
				$uploadBtn.hide();
			}
			 upload(this.result);
		}
		reader.onerror = function() {
			alert('Error');
		}
	}
	
	function checkExistFile(name, files) {
		var flag = false;
		files.forEach(function(item) {
			if (item === name) {
				flag = true;
			}
		});
		return flag;
	}

	function deleteUploadImage(len) {
		for (var i = 0; i < len; i++) {
			$delete[i].save = i;
			$delete[i].onclick = function() {
				$delete = $('.delete');
				$childrens.eq(this.save).remove();
				checkFileList.splice(this.save, 1);
				$fu[0].value = '';
				count--;
				$uploadBtn.show();
			}
		}
	}
	
	function upload(result) {
		$.ajax({
			url: '/upload-images',
			type: 'POST',
			dataType: 'json',
			data: {
				image_a: result
			},
			success: function(data) {
				if (data.result == 1) {
					$('#file li img').eq($('#file li').length - 1).attr('src', data.path);
				} else {
					alert('Upload fail.');
				}
			},
			xhrFields: {
				onsendstart: function() {
					this.upload.addEventListener('loadstart', function() {
						$('.uploadShow').show();
					}, false);
				},
				onsendend: function() {
					this.upload.addEventListener('loadend', function() {
						$('.uploadShow').hide();
					}, false);
				}
			}
		});
	}
});