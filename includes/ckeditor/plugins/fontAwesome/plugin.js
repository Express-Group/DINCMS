/*
	Plugin	: FontAwesome (Premium)
	Author	: Michael Janea (www.michaeljanea.com)
	Version	: 1.0.6
*/

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2.p.9(\'7\',{1C:[\'4\',\'1B\',\'1z\',\'1w\',\'1v\',\'1u\',\'1t\',\'1s\',\'8\',\'e-1r\',\'e\',\'1n\',\'1k\',\'1j\',\'1i\',\'4-1h\',\'4-8\',\'4-1e\',\'1c\',\'1b\',\'1a\',\'T\',\'q\',\'q-8\',\'P\',\'N\',\'u\',\'17\',\'v\',\'w\',\'x\',\'y\',\'z\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\',\'G\',\'H\',\'I\',\'J\',\'K\',\'L\',\'M\',\'s\',\'O\',\'r-Q\',\'r\',\'R\',\'S\',\'t\',\'t-U\',\'V\',\'W\',\'X\',\'Y\',\'Z\',\'10\',\'11\',\'12\',\'13\',\'14\',\'15\',\'16\'],1L:\'18\',19:\'7\',o:6(m){m.1d.9(\'l\',{1f:\'l\',1g:\'<3 a=""></3>\',i:\'h\',1l:\'3(*){*}\',1m:6(1){1o 1.1p==\'3\'&&1.1q(\'s\')},o:6(){0.c(\'k\',0.1.j(\'g\'));0.c(\'f\',0.1.j(\'1x-1y\'));0.c(\'d\',0.1.1A(\'a\'))},5:6(){0.1.$.b.g=0.5.k;0.1.$.b.1D=0.5.f;0.1.1E(\'a\',0.5.d)}});2.i.9(\'h\',0.1F+\'1G/7.1H\');2.1I.1J(2.p.1K(\'7\')+\'n/b.n\')}});',62,110,'this|element|CKEDITOR|span|en|data|function|fontAwesome|ca|add|class|style|setData|fontAwesome_class|zh|fontAwesome_size|color|fontAwesomeDialog|dialog|getStyle|fontAwesome_color|FontAwesome|editor|css|init|plugins|fr|pt|fa|sr|de|gu|he|hi|hu|is|id|it|ja|km|ko|ku|lv|lt|mk|ms|mn|no|nb|ka|pl|gl|br|ro|ru|fi|latn|si|sk|sl|es|sv|tt|th|tr|ug|uk|vi|cy|el|widget|icons|fo|et|eo|widgets|gb|button|template|au|nl|da|cs|allowedContent|upcast|hr|return|name|hasClass|cn|bg|bs|bn|eu|ar|font|size|sq|getAttribute|af|lang|fontSize|setAttribute|path|dialogs|js|document|appendStyleSheet|getPath|requires'.split('|'),0,{}))

for(var i in CKEDITOR.instances){
	CKEDITOR.instances[i].ui.addButton('FontAwesome', {
        command : 'fontAwesome',
        icon 	: this.path + 'icons/fontAwesome.png',
    });
}