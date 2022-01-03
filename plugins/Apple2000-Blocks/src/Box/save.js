import React from "react";

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";

function HeaderElem({ elem, children, ...props }) {
	switch (elem) {
		case "h1":
			return <h1 {...props}>{children}</h1>;
		case "h2":
			return <h2 {...props}>{children}</h2>;
		case "h3":
			return <h3 {...props}>{children}</h3>;
		case "h4":
			return <h4 {...props}>{children}</h4>;
		case "h5":
			return <h5 {...props}>{children}</h5>;
		case "h6":
			return <h6 {...props}>{children}</h6>;
		default:
			return <span {...props}>{children}</span>;
	}
}

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export function Save({ attributes }) {
	const props = useBlockProps.save();
	const classNames = `${props.className} Box`;

	return (
		<section {...props} className={classNames}>
			{attributes.hasHeader && (
				<header class="Header">
					<HeaderElem elem={attributes.headerElement} className="Header-inner">
						{attributes.headerText}
					</HeaderElem>
				</header>
			)}
			<div class="Box-inner">
				<InnerBlocks.Content />
			</div>
		</section>
	);
}
