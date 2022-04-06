export const attributes = {
	bannerSpeed: {
		type: "number",
		default: 20,
	},
	bannerMessage: {
		type: "string",
		selector: ".Banner-inner",
		source: "text",
	},
};
