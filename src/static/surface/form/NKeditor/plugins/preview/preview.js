/*******************************************************************************
* KindEditor - WYSIWYG HTML Editor for Internet
* Copyright (C) 2006-2011 kindsoft.net
*
* @author Roddy <luolonghao@gmail.com>
* @site http://www.kindsoft.net/
* @licence http://www.kindsoft.net/license.php
*******************************************************************************/

KindEditor.plugin('preview', function(K) {
	var self = this, name = 'preview', undefined;
	self.clickToolbar(name, function() {
		var lang = self.lang(name + '.'),
			width = document.documentElement.clientWidth * 0.9,
			height = document.documentElement.clientHeight - 160,
			html = '<div style="padding:10px 20px;">' +
				'<iframe class="ke-textarea" frameborder="0" style="width:'+(width-42)+'px;height:'+height+'px;"></iframe>' +
				'</div>',
			dialog = self.createDialog({
				name : name,
				width : width,
				title : self.lang(name),
				body : html
			}),
			iframe = K('iframe', dialog.div),
			doc = K.iframeDoc(iframe);
		doc.open();

		var cssPath = self.options.cssPath;
		var jsPath = self.options.jsPath;
		var arr = [
			'<html lang="en">',
			'<head><meta charset="utf-8" /><title></title>',
			//'<link href="http://localhost/editor/nkeditor/plugins/code/prettify.css" rel="stylesheet">',
			'<style>',
			'html {margin:0;padding:0;}',
			'body {margin:0;padding:5px;}',
			'body, td {font:12px/1.5 "sans serif",tahoma,verdana,helvetica;}',
			'body, p, div {word-wrap: break-word;}',
			'p {margin:5px 0;}',
			'table {border-collapse:collapse;}',
			'img {border:0;}',
			'noscript {display:none;}',
			'table.ke-zeroborder td {border:1px dotted #AAA;}',
			'img.ke-flash {',
			'	border:1px solid #AAA;',
			'	background-image:url(' + self.options.themesPath + 'common/flash.svg);',
			'	*background-image:url(' + self.options.themesPath + 'common/flash.png);',
			'	background-size:64px 64px;',
			'	background-position:center center;',
			'	background-repeat:no-repeat;',
			'	width:100px;',
			'	height:100px;',
			'}',
			'img.ke-rm {',
			'	border:1px solid #AAA;',
			'	background-image:url(' + self.options.themesPath + 'common/rm.gif);',
			'	background-position:center center;',
			'	background-repeat:no-repeat;',
			'	width:100px;',
			'	height:100px;',
			'}',
			'img.ke-media {',
			'	border:1px solid #AAA;',
			'	background-image:url(' + self.options.themesPath + 'common/play.svg);',
			'	*background-image:url(' + self.options.themesPath + 'common/play.png);',
			'	background-position:center center;',
			'	background-size:64px 64px;',
			'	background-repeat:no-repeat;',
			'	width:100px;',
			'	height:100px;',
			'}',
			'img.ke-anchor {',
			'	border:1px dashed #666;',
			'	width:16px;',
			'	height:16px;',
			'}',
			'.ke-script, .ke-noscript, .ke-display-none {',
			'	display:none;',
			'	font-size:0;',
			'	width:0;',
			'	height:0;',
			'}',
			'.ke-pagebreak {',
			'	border:1px dotted #AAA;',
			'	font-size:0;',
			'	height:2px;',
			'}'
		];

		if (self.options.showHelpGrid) {
			arr.push('p,ul,ol,li,div{border: 1px dashed #c1c1c1;}');
			arr.push('li{margin:5px 0px}');
			arr.push('div,ul,ol{margin-bottom:10px}');
		}
		arr.push('</style>');
		// 加载 css
		if (!K.isArray(cssPath)) {
			cssPath = [cssPath];
		}
		if (K.inArray(self.options.pluginsPath+'code/prism.css', cssPath) < 0) {
			cssPath.push(self.options.pluginsPath+'code/prism.css');
		}
		K.each(cssPath, function(i, path) {
			if (path) {
				arr.push('<link href="' + path + '" rel="stylesheet" />');
			}
		});
		if (self.options.cssData) {
			arr.push('<style>' + self.options.cssData + '</style>');
		}
		arr.push('</head><body ' + (self.options.bodyClass ? 'class="' + self.options.bodyClass + '"' : '') + '>');
		// 获取编辑器内容
		arr.push(self.fullHtml());
		// 加载脚本
		if (!K.isArray(jsPath)) {
			jsPath = [jsPath];
		}
		// 加载代码高亮的脚本
		if (K.inArray(self.options.pluginsPath+'code/prism.js', jsPath) < 0) {
			jsPath.push(self.options.pluginsPath+'code/prism.js');
		}
		K.each(jsPath, function(i, path) {
			if (path) {
				arr.push('<script type="text/javascript" src="' + path + '"></script>');
			}
		});
		arr.push('</body></html>');
		doc.write(arr.join('\n'));
		doc.close();
		K(doc.body).css('background-color', '#FFF');
		iframe[0].contentWindow.focus();
	});
});
