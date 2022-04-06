/* eslint-disable-next-line import/no-extraneous-dependencies */
const fs = require("fs-extra");
const { compile } = require("./sassfuncs");

async function build() {
  // compile sass
  await compile({ entryFile: "./lib/scss/styles.scss", outDir: "./dist" });
  // copy fonts
  await fs.copy("./lib/scss/fonts", "./dist/fonts");
  // copy images
  await fs.copy("./lib/scss/img", "./dist/img");
}

build().then(() => {
  process.exit();
});
