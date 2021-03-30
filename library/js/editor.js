wp.domReady( () => {

	wp.blocks.registerBlockStyle( 'core/group', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'memo',
			label: 'Memo',
		}
	]);
} );