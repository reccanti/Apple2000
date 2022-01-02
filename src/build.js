/* eslint-disable-next-line import/no-extraneous-dependencies */
const fs = require("fs-extra");
const { compile } = require("./sassfuncs");

async function build() {
	// compile sass
	await compile({ entryFile: "./src/scss/styles.scss", outDir: "./css" });
	// copy fonts
	await fs.copy("./src/scss/fonts", "./css/fonts");
	// copy images
	await fs.copy("./src/scss/img", "./css/img");
}

build().then(() => {
	process.exit();
});
