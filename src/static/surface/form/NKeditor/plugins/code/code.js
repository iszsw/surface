/*******************************************************************************
* KindEditor - WYSIWYG HTML Editor for Internet
* Copyright (C) 2006-2011 kindsoft.net
*
* @author Roddy <luolonghao@gmail.com>
* @site http://www.kindsoft.net/
* @licence http://www.kindsoft.net/license.php
*******************************************************************************/

// google code prettify: http://google-code-prettify.googlecode.com/
// http://google-code-prettify.googlecode.com/

KindEditor.plugin('code', function(K) {
	var self = this, name = 'code';
	self.clickToolbar(name, function() {
		var lang = self.lang(name + '.'),
			html = ['<div style="margin: 0px 20px;">',
				'<div class="ke-dialog-row">',
				'<select class="ke-select" style="margin-bottom: 5px;">',
				'<option value="javascript">JavaScript</option>',
				'<option value="html">HTML</option>',
				'<option value="css">CSS</option>',
				'<option value="php">PHP</option>',
				'<option value="perl">Perl</option>',
				'<option value="python">Python</option>',
				'<option value="ruby">Ruby</option>',
				'<option value="java">Java</option>',
				'<option value="go">Go</option>',
				'<option value="asp">ASP/VB</option>',
				'<option value="csharp">C#</option>',
				'<option value="cpp">C/C++</option>',
				'<option value="cs">C#</option>',
				'<option value="bash">Shell</option>',
				'<option value="sql">SQL</option>',
				'<option value="markup">Other</option>',
				'</select>',
				'</div>',
				'<textarea class="ke-textarea" style="width:408px;height:260px;"></textarea>',
				'</div>'].join(''),
			dialog = self.createDialog({
				name : name,
				width : 450,
				title : self.lang(name),
				body : html,
				yesBtn : {
					name : self.lang('yes'),
					click : function(e) {
						var type = K('.ke-select', dialog.div).val(),
							code = textarea.val(),
							cls = type === '' ? '' :  'language-' + type,
							html = '<pre class="' + cls + '"><code>' + K.escape(code) + '</code></pre> <br/>';
						if (K.trim(code) === '') {
							K.options.errorMsgHandler(lang.pleaseInput, "error");
							textarea[0].focus();
							return;
						}
						self.insertHtml(html).hideDialog().focus();
					}
				}
			}),
			textarea = K('textarea', dialog.div);
		textarea[0].focus();
	});
});
