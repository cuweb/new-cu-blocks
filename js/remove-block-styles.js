
wp.domReady(() => {
	// find blocks styles
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
	wp.blocks.unregisterBlockStyle('core/heading', 'text-shadow');
} );

// Remove other editor panels
wp.data.dispatch('core/edit-post').removeEditorPanel('discussion-panel'); // Discussion
