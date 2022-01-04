import { __ } from "@wordpress/i18n";

import { useState, useEffect } from "@wordpress/element";

import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";

import { SelectControl } from "@wordpress/components";

import "./editor.scss";

const setTextAlign = (value) => {
	switch (value) {
		case "right":
			return { "text-align": "right" };
		case "center":
			return { "text-align": "center" };
		default:
			return { "text-align": "left" };
	}
};

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export function Edit({ attributes, setAttributes }) {
	const [directionStyle, setDirectionStyle] = useState(
		setTextAlign(attributes.orientation)
	);

	const handleOrientationChange = (orientation) => {
		setAttributes({
			...attributes,
			orientation,
		});
		setDirectionStyle(setTextAlign(orientation));
	};

	return (
		<div {...useBlockProps()}>
			<SelectControl
				label="Orientation"
				value={attributes.orientation}
				onChange={handleOrientationChange}
				options={[
					{ label: "Left", value: "left" },
					{ label: "Center", value: "center" },
					{ label: "Right", value: "right" },
				]}
			/>
			<div style={directionStyle}>
				<InnerBlocks />
			</div>
		</div>
	);
}
