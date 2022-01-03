import { __ } from "@wordpress/i18n";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";

export function Save() {
	const props = useBlockProps.save();
	const classNames = `${props.className} Splash`;
	return (
		<section {...props} className={classNames}>
			<InnerBlocks.Content />
		</section>
	);
}
