/**
 * 引用插件
 * @author yangjian
 */
KindEditor.plugin('quote', function(K) {
	var self = this;
	var name = 'quote';
	self.clickToolbar(name, function() {
		self.insertHtml('<blockquote class="ke-quote"><p>这里输入引用内容...</p></blockquote><br/>');
		self.focus();
	});
});
