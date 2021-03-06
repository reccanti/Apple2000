// import { separator as icon } from "@wordpress/icons";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import "./style.scss";

/**
 * Internal dependencies
 */
export { Edit } from "./edit";
export { Save } from "./save";
export { separator as icon } from "@wordpress/icons";

export const name = "apple2000/horizontal-rule";
