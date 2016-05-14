var dest = "./app/assets";
var src = './assets';

module.exports = {
	browserSync: {
	  proxy: 'http://sbmodal.local/',
	  open: true
	},
	sass: {
		src: src + "/stylesheets/**/*.{sass,scss}",
		dest: dest + '/stylesheets',
		settings: {
			//includePaths: [],
			indentedSyntax: false, // Enable/Disable .sass syntax!
			imagePath: 'images' // Used by the image-url helper
		}
	},
	markup: {
		src: "./app/**/*.{php,html}"
	},
	browserify: {
		bundleConfigs: [
			{
				entries: src + '/javascripts/app.js',
				dest: dest + '/javascripts',
				outputName: 'app.js',
				external: ['jQuery']
			},{
				entries: src + '/javascripts/admin.js',
				dest: dest + '/javascripts',
				outputName: 'admin.js',
				external: ['jQuery']
			}
		]
	}
};
