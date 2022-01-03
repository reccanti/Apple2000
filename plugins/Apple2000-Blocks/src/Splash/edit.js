import { __ } from "@wordpress/i18n";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
import { TextControl, ToggleControl } from "@wordpress/components";
import { useState, useEffect } from "@wordpress/element";

import "./editor.scss";

export function Edit() {
	return (
		<div {...useBlockProps()}>
			<InnerBlocks />
		</div>
	);
}
