/**
 * HTML5 批量文件上传
 * @author yangjian <yangjian102621@gmail.com>
 * @since v4.1.12(2017-09-12)
 * @site http://git.oschina.net/blackfox/kindeditor
 */

KindEditor.plugin('multiimage', function(K) {
	var self = this, name = 'multiimage',
		uploadJson = K.undef(self.uploadJson, self.basePath + 'php/upload_json.php'),
		fileManagerJson = K.undef(self.fileManagerJson, self.basePath + 'php/file_manager_json.php'),
		imageSizeLimit = K.undef(self.imageSizeLimit, 2048), //单位KB
		imageFileTypes = K.undef(self.imageFileTypes, 'jpg|png|gif|jpeg'),
		imageUploadLimit = K.undef(self.imageUploadLimit, 20),
		filePostName = K.undef(self.filePostName, 'imgFile'),
		lang = self.lang(name + '.');

	if(typeof jQuery == 'undefined') {
		K.options.errorMsgHandler(lang.depJQueryError, "error");
		return;
	} else {
		K.loadScript(K.options.pluginsPath+name+"/BUpload.js");
		K.loadStyle(K.options.pluginsPath+name+"/css/upload.css");
	}

	//锁屏插件
	K.locker = function () {
		var docWidth = Math.max(document.documentElement.clientWidth, document.body.clientWidth);
		var docHeight = Math.max(document.documentElement.clientHeight, document.body.clientHeight, $(document).height()) + document.documentElement.scrollTop;
		return K.widget({
			x : 0,
			y : 0,
			cls : 'ke-dialog-lock',
			width : docWidth,
			height : docHeight
		});
	}
	self.plugin.multiImageDialog = function(options) {

		var clickFn = options.clickFn;
		var locker = K.locker();
		locker.show();

		var dialog = new BUpload({
			src : filePostName,
			upload_url : uploadJson,
			list_url : fileManagerJson,	//图片列表数据获取url
			max_filesize : imageSizeLimit,
			max_filenum : imageUploadLimit,
			ext_allow : imageFileTypes,
			lang : lang,
			top : self.dialogOffset,
			fileType : "image",
			errorHandler : K.options.errorMsgHandler,
			callback : function(data) {
				//console.log(data);
				clickFn.call(this, data);
			},
			close : function () {
				locker.remove();
			}
		});

		return dialog;
	};
	self.clickToolbar(name, function() {
		self.plugin.multiImageDialog({
			clickFn : function (urlList) {

				if (urlList.length === 0) {
					return;
				}
				K.each(urlList, function(i, data) {
					if (self.afterUpload) {
						self.afterUpload.call(self, data, data, 'multiimage');
					}
					self.exec('insertimage', data);
				});
				// Bugfix: [Firefox] 上传图片后，总是出现正在加载的样式，需要延迟执行hideDialog
				setTimeout(function() {
					self.hideDialog().focus();
				}, 0);
			}
		});
	});
});
