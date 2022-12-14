wp.domReady(() => {
	const allowedCoreBlocks = [
		'core/embed',
		'core/gallery',
		'core/heading',
		'core/image',
		'core/list',
		'core/paragraph',
		'core/quote',
		'core/table'
	];
	
	const allowedCustomBlocks = [
		'starter-block/feature-card',
		'starter-block/hero-image'
	];
	
	const allowedAdminBlocks = [
		'core/html',
		'core/shortcode'
	];
	
	const allowedPluginBlocks = [
		// 'gravityforms/form'
	];
	
	const allowedBlocks = allowedCoreBlocks.concat(allowedCustomBlocks, allowedAdminBlocks, allowedPluginBlocks);

	const allowedEmbedBlocks = [
		'soundcloud',
		'twitter',
		'youtube',
		'vimeo'
	];
	
	// Set allowed blocks
	wp.blocks.getBlockTypes().forEach(function (coreBlocks) {
		if (allowedBlocks.indexOf(coreBlocks.name) === -1) {
			wp.blocks.unregisterBlockType(coreBlocks.name);
		}
	});

	// Set allowed embed blocks - https://wordpress.stackexchange.com/questions/393243/limit-gutenberg-blocks-available-to-users-to-choose-from
	wp.blocks.getBlockType('core/embed').variations.forEach(function (blockVariation) {
		if (allowedEmbedBlocks.indexOf(blockVariation.name) === -1) {
			wp.blocks.unregisterBlockVariation('core/embed', blockVariation.name);
		}
	});

	// Remove block styles
	wp.blocks.unregisterBlockStyle('core/image', 'default');
	wp.blocks.unregisterBlockStyle('core/image', 'rounded');
	wp.blocks.unregisterBlockStyle('core/quote', 'default');
	wp.blocks.unregisterBlockStyle('core/quote', 'plain');
	wp.blocks.unregisterBlockStyle('core/table', 'regular');
	wp.blocks.unregisterBlockStyle('core/table', 'stripes');
	
	// Dump block styles to the console - https://soderlind.no/hide-block-styles-in-gutenberg/
	wp.blocks.getBlockTypes().forEach((block) => {
		if (_.isArray(block['styles'])) {
			console.log(block.name, _.pluck(block['styles'], 'name'));
		}
	});
});

//
// Remove other editor panels

wp.data.dispatch('core/edit-post').removeEditorPanel('discussion-panel');

//
// Remove core block elements via the block support API
// @see https://css-tricks.com/a-crash-course-in-wordpress-block-filters/
// @see https://stackoverflow.com/questions/71637137/remove-property-from-wordpress-core-gutenberg-block
// @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#typography
// @see https://javascriptforwp.com/extending-wordpress-blocks/

const { addFilter } = wp.hooks;
const { assign, merge } = lodash;

function extendCoreBlocks(settings, name) {
	// Core heading block modifications
	// if (name === 'core/heading') {
	// 	console.log({ settings, name });
	// }

	// Core list block modifications
	if (name === 'core/list') {
		return lodash.assign({}, settings, {
			supports: lodash.assign({}, settings.supports, {
				color: false,
				typography: false,
			}),
		});
	}

	// Core quote block modifications
	if (name === 'core/quote') {
		return lodash.assign({}, settings, {
			supports: lodash.assign({}, settings.supports, {
				color: false,
			}),
		});
	}

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'cuBlockModifications',
	extendCoreBlocks,
);
