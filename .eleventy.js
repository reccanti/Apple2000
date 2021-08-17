const { compile } = require("./src/sassfuncs");
const path = require("path");

function didSassFileChange(files) {
	return !!files.find((file) => file.endsWith(".scss"));
}

module.exports = function (config) {
	const ASSET_DIR = path.relative(
		__dirname,
		path.join(__dirname, "src", "assets")
	);
	const SASS_DIR = path.relative(
		__dirname,
		path.join(__dirname, "src", "scss")
	);

	// config.setUseGitIgnore(false);

	/**
	 * Run this initially no matter what
	 */
	compile({
		entryFile: path.join(SASS_DIR, "styles.scss"),
		outDir: path.join(__dirname, "src", "_site", "styles"),
	});

	// config.addWatchTarget(path.resolve(SASS_DIR));
	// config.addWatchTarget(path.join(path.relative(__dirname, SASS_DIR), "**"));
	config.addWatchTarget(SASS_DIR);
	config.on("beforeWatch", async (changedFiles) => {
		// changedFiles is an array of files that changed
		// to trigger the watch/serve build
		// if we detect a file
		if (didSassFileChange(changedFiles)) {
			console.log("compile sass");
			compile({
				entryFile: path.join(SASS_DIR, "styles.scss"),
				outDir: path.join(__dirname, "src", "_site", "styles"),
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
