import { useBlockProps } from '@wordpress/block-editor';

import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

// NEW IMPORTS
import { RangeControl, __experimentalInputControl as InputControl } from '@wordpress/components';
// Technically the input control is flagged experimental, but I've heard this will be stable quite soon - we're going to use it either way, but you could just create your own input component if you prefer



import './editor.scss';

export default function Edit() {

	// Attributes for the block wrapper
	const blockProps = useBlockProps()

	// Determine the curent post type in the editor context
	const currentPostType =  useSelect((select) => {
		return select('core/editor').getCurrentPostType()
	}, [])

	// Fetch the meta as an object and the setMeta function
	const [meta, setMeta] = useEntityProp('postType', currentPostType, 'meta');

	// Destructure all our individual properties from the meta for ease of use
	const {employeeTitle, employeeEmail} = meta

	// Flexible helper for setting a single meta value w/o mutating state
	const updateMeta = ( key, value ) => {
		setMeta( { ...meta, [key]: value } );
	};

	return (
		<div { ...blockProps }>
			<h4>Staff Details:</h4>
			<hr />
			<div className="fsd-property-meta-details__grid">
				<InputControl
					type="string"
					label='Employee Title'
					value={ employeeTitle || '' }
					onChange={ ( value ) => updateMeta( "employeeTitle",value  )}
                />
				<InputControl
					type="string"
					label='Employee Email'
					value={ employeeEmail || '' }
					onChange={ ( value ) => updateMeta( "employeeEmail",value  )}
                />
			</div>

		</div>
	);
}