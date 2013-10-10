jQuery(document).ready(function(){
	jQuery('.tab-panel-inner .alert').remove();
	jQuery('a,.area-clone').removeClass('pro-only-disabled');
});
jQuery(window).load(function(){
	jQuery('a.section-clone[data-original-title="Clone (Pro Edition Only)"]').attr('data-original-title','Clone');

	jQuery('a.section-offset-increase[data-original-title="Offset Right (Pro Edition Only)"]').attr('data-original-title','Offset Right');
	jQuery('a.section-offset-reduce[data-original-title="Offset Left (Pro Edition Only)"]').attr('data-original-title','Offset Left');

	jQuery('a.section-start-row[data-original-title="Force to New Row (Pro Edition Only)"]').attr('data-original-title','Force to New Row');
	jQuery('span.area-control[data-original-title="Clone (Pro Edition Only)"]').attr('data-original-title','Clone');
});