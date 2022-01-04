/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType, registerBlockVariation } from "@wordpress/blocks";

/**
 * Here's where we import and setup all our blocks. Blocks are expected
 * to export fields like name, Edit, Save, attributes, etc... similar
 * to how Storybook does it!
 */
import * as Box from "./Box";
import * as Banner from "./Banner";
import * as HorizontalRule from "./HorizontalRule";
import * as ShmancySectionBlock from "./ShmancySection";
import * as LinkGridBlock from "./LinkGrid";
import * as LinkGridItemBlock from "./LinkGridItem";
import * as TextBox from "./TextBox";

/**
 * @TODO I don't really like how this is setup. Let's refactor this one
 * once we update the npm package it's based on
 * ~reccanti 4/17/2021
 */
import * as SplashBlock from "./Splash";

const blocks = [
	ShmancySectionBlock,
	LinkGridBlock,
	LinkGridItemBlock,
	SplashBlock,
	Box,
	Banner,
	HorizontalRule,
	TextBox,
];

blocks.forEach(({ name, Edit, Save, ...data }) => {
	const block = registerBlockType(name, {
		apiVersion: 2,
		edit: Edit,
		save: Save,
		...data,
	});
});
