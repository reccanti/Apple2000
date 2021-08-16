const { compile } = require("./sassfuncs");
const path = require("path");

function didSassFileChange(files) {
	return !!files.find((file) => file.endsWith(".scss"));
}

module.exports = function (config) {
	const ASSET_DIR = path.relative(
		process.cwd(),
		path.join(__dirname, "assets")
	);
	const SASS_DIR = path.relative(process.cwd(), path.join(__dirname, "scss"));

	/**
	 * Run this initially no matter what
	 */
	compile({
		entryFile: path.join(SASS_DIR, "styles.scss"),
		outDir: path.join(__dirname, "_site", "styles"),
	});

	config.addWatchTarget(SASS_DIR);
	console.log(SASS_DIR);
	config.on("beforeWatch", async (changedFiles) => {
		console.log("changed");
		// changedFiles is an array of files that changed
		// to trigger the watch/serve build
		// if we detect a file
		if (didSassFileChange(changedFiles)) {
			compile({
				entryFile: path.join(SASS_DIR, "styles.scss"),
				outDir: path.join(__dirname, "_site", "styles"),
			});
		}
	});

	// console.log(path.relative(__dirname, path.join(OUT_DIR, "styles", "fonts")));

	config.addPassthroughCopy({
		[path.join(SASS_DIR, "fonts")]: path.join("styles", "fonts"),
	});

	config.addPassthroughCopy(ASSET_DIR);
	config.addWatchTarget(ASSET_DIR);
};
