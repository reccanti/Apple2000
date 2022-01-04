import { __ } from "@wordpress/i18n";

import { useState, useEffect } from "@wordpress/element";

import { useBlockProps } from "@wordpress/block-editor";

import {
	TextControl,
	__experimentalNumberControl as NumberControl,
} from "@wordpress/components";

import "./editor.scss";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export function Edit({ attributes, setAttributes }) {
	const handleTextUpdate = (bannerMessage) => {
		setAttributes({
			...attributes,
			bannerMessage,
		});
	};

	const handleSpeedUpdate = (bannerSpeed) => {
		setAttributes({
			...attributes,
			bannerSpeed,
		});
	};

	return (
		<div {...useBlockProps()}>
			<NumberControl
				label="Banner Speed"
				min={1}
				step={1}
				value={attributes.bannerSpeed}
				onChange={handleSpeedUpdate}
			/>
			<TextControl
				label="Banner Text"
				value={attributes.bannerMessage}
				onChange={handleTextUpdate}
			/>
		</div>
	);
}
