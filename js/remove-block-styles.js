// Dump block styles to the console
// https://soderlind.no/hide-block-styles-in-gutenberg/
wp.domReady(() => {
	wp.blocks.getBlockTypes().forEach((block) => {
		if (_.isArray(block['styles'])) {
			console.log(block.name, _.pluck(block['styles'], 'name'));
		}
	});
});

// Remove block options
wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/image', 'default');
	wp.blocks.unregisterBlockStyle('core/image', 'rounded');
	wp.blocks.unregisterBlockStyle('core/quote', 'default');
	wp.blocks.unregisterBlockStyle('core/quote', 'plain');
	wp.blocks.unregisterBlockStyle('core/table', 'regular');
	wp.blocks.unregisterBlockStyle('core/table', 'stripes');
} );

// Remove other editor panels
wp.data.dispatch('core/edit-post').removeEditorPanel('discussion-panel'); // Discussion
