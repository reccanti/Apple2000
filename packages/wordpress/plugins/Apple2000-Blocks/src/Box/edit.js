import { __ } from "@wordpress/i18n";

import { useState, useEffect } from "@wordpress/element";

import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";

import {
	ToggleControl,
	TextControl,
	HStack,
	SelectControl,
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
	const handleCheckHeader = (hasHeader) => {
		setAttributes({
			...attributes,
			hasHeader,
		});
	};

	const handleHeaderTextChange = (headerText) => {
		setAttributes({
			...attributes,
			headerText,
		});
	};

	const handleHeaderElementSelect = (headerElement) => {
		setAttributes({
			...attributes,
			headerElement,
		});
	};

	return (
		<div {...useBlockProps()}>
			<ToggleControl
				label="Has Header?"
				checked={attributes.hasHeader}
				onChange={handleCheckHeader}
			/>
			{attributes.hasHeader && (
				<div>
					<TextControl
						label="Header Text"
						value={attributes.headerText}
						onChange={handleHeaderTextChange}
					/>
					<SelectControl
						label="Render Header As"
						value={attributes.headerElement}
						onChange={handleHeaderElementSelect}
						options={[
							{ label: "h1", value: "h1" },
							{ label: "h2", value: "h2" },
							{ label: "h3", value: "h3" },
							{ label: "h4", value: "h4" },
							{ label: "h5", value: "h5" },
							{ label: "h6", value: "h6" },
							{ label: "span", value: "span" },
						]}
					/>
				</div>
			)}
			<InnerBlocks />
		</div>
	);
}
