import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, RangeControl, TextControl } from '@wordpress/components';

registerBlockType('wc-order-map/map', {
	edit: ({ attributes, setAttributes }) => {
		const { height, zoom } = attributes;
		const blockProps = useBlockProps();
		const api_key = wf_map_block.api_key || '';

		const saveApiKey = (newKey) => {
			const formData = new FormData();
			formData.append('action', 'wcmap_block_save_key');
			formData.append('_ajax_nonce', wf_map_block.nonce_save_api_key);
			formData.append('api_key', newKey);

			fetch(wf_map_block.ajaxurl, {
				method: 'POST',
				body: formData,
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					console.log('API key saved:', data.data);
					window.location.reload();
				} else {
					console.error('Failed to save API key:', data.data);
				}
			})
			.catch(error => console.error('Error saving API key:', error));
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Map Settings', 'map-block-order-confirmation')}>
						<TextControl
							label={__('Google Maps API Key', 'map-block-order-confirmation')}
							value={api_key}
							onChange={saveApiKey}
							help={__('Enter your Google Maps API key', 'map-block-order-confirmation')}
						/>
						<RangeControl
							label={__('Zoom Level', 'map-block-order-confirmation')}
							value={zoom}
							onChange={(zoom) => setAttributes({ zoom })}
							min={1}
							max={21}
						/>
						<RangeControl
							label={__('Height', 'map-block-order-confirmation')}
							value={height}
							onChange={(height) => setAttributes({ height })}
							min={50}
							max={1000}
						/>
					</PanelBody>
				</InspectorControls>
				<div {...blockProps}>
					<div 
						className="map-placeholder" 
						style={{ height: height + 'px' }}
					>
						<div className="map-placeholder-content">
							<span className="dashicons dashicons-location"></span>
							<p>{__('Shipping address map will appear here', 'map-block-order-confirmation')}</p>
						</div>
					</div>
				</div>
			</>
		);
	},
	save: () => null // Use PHP render callback
});
