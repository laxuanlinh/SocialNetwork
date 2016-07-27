<script>
(function ( $ ) {
 
    $.fn.emoticons = function(options) {
	
		var settings = $.extend({
			// These are the defaults.
			folder: "{{asset("/js/icons/")}}",
			img_ext: "png"
		}, options );

		var text = $(this).text();
		var folder = settings.folder;
		var img_ext = settings.img_ext;
		var icons = {
			':-)' : 'smile',
			':)'  : 'smile',
			':('  : 'sad',
			':D'  : 'laugh',
			':=D' : 'laugh',
			':-D' : 'laugh',
			'8=)' : 'cool',
			'8-)' : 'cool',
			'B=)' : 'cool',
			';)'  : 'wink',
			';-)' : 'wink',
			';=)' : 'wink',
			':o'  : 'surprised',
			':=o' : 'surprised',
			':-o' : 'surprised',				
			';('  : 'crying',
			';-(' : 'crying',
			';=(' : 'crying',			
			'(:|' : 'sweating',
			':|'  : 'speechless',
			':=|' : 'speechless',
			':-|' : 'speechless',
			':*'  : 'kiss',
			':=*' : 'kiss',
			':-*' : 'kiss',
			':P'  : 'cheeky',
			':=P' : 'cheeky',
			':-P' : 'cheeky',
			':p'  : 'cheeky', 
			':$'  : 'blush',
			':-$' : 'blush',
			':^)' : 'wondering',
			'|-)' : 'sleepy',
			'I-)' : 'sleepy',
			'I=)' : 'sleepy',
			'|('  : 'dull',
			'|-(' : 'dull',
			'|=(' : 'dull',
			']:)' : 'evilgrin',
			'>:)' : 'evilgrin', 			
			':&'  : 'puke',
			':-&' : 'puke',
			':=&' : 'puke',
			':-@' : 'angry', 
			'x('  : 'angry',
			'x-(' : 'angry',
			'x=(' : 'angry',
			'X('  : 'angry', 			
			'8-|' : 'nerd',
			'B-|' : 'nerd',
			'8|'  : 'nerd',
			'B|'  : 'nerd'
		};	
		  
        return text.replace(/[:;8B>^*@$&I\]|\-(=o)pPxXD]+/g, function (match) {
			return typeof icons[match] != 'undefined' ? '<span class="emoticons"><img src="'+folder+'/'+icons[match]+'.'+img_ext+'"/></span>' : match;
		});	
		

    };
 
}( jQuery ));

</script>