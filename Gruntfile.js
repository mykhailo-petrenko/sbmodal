module.exports = function (grunt) {
	grunt.initConfig({
		less: {
			development: {
//        options: {
//          compress: true,
//          yuicompress: true,
//          optimization: 2
//        },
				files: {
					// target.css file: source.less file
					"assets/css/admin_style.css": "assets/less/admin_style.less",
					"assets/css/front.css": "assets/less/front.less",
					"assets/css/animate.css": "assets/less/animate.less",
					
					"assets/css/shortcodes/countdown.css": "assets/less/shortcodes/countdown.less",
					"assets/css/shortcodes/feature_icon.css": "assets/less/shortcodes/feature_icon.less",
					"assets/css/shortcodes/feature_side_icon.css": "assets/less/shortcodes/feature_side_icon.less",
					"assets/css/shortcodes/gmaps.css": "assets/less/shortcodes/gmaps.less",
					"assets/css/shortcodes/simple_slider.css": "assets/less/shortcodes/simple_slider.less",
					"assets/css/shortcodes/text.css": "assets/less/shortcodes/text.less"
				}
			}
		},
		watch: {
			styles: {
				files: [ 'assets/less/**/*.less', ],
				tasks: ['less'],
				options: {
					nospawn: true
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', ['watch']);
};