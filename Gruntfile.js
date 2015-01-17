module.exports = function (grunt) {
	grunt.initConfig({
//		less: {
//			development: {
//				options: {
//					compress: true,
//					yuicompress: true,
//					optimization: 2
//				},
//				files: {
//					// target.css file: source.less file
//					"assets/css/admin_style.css": "assets/less/admin_style.less",
//					"assets/css/front.css": "assets/less/front.less",
//				}
//			}
//		},
//		watch: {
//			styles: {
//				files: ['assets/less/**/*.less', ],
//				tasks: ['less'],
//				options: {
//					nospawn: true
//				}
//			}
//		}
		compress: {
			main: {
				options: {
					archive: function () {
						return '../../../../sbmodal.zip'
					}
				},
				files: [
					{
						expand: true,
						src: [
							'assets/**',
							'core/**',
							'libs/**',
							'templates/**',
							'director.php',
							'index.php',
							'readme.txt',
							'sbmodal.php'
						],
						dest: 'sbmodal/'
					}
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compress');

	grunt.registerTask('default', ['compress']);
};