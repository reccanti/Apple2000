export const attributes = {
	hasHeader: {
		type: "boolean",
		default: true,
	},
	headerText: {
		type: "string",
		selector: ".Header-inner",
		source: "text",
	},
	headerElement: {
		type: "string",
		default: "span",
	},
};
