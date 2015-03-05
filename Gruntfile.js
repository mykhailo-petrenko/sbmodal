module.exports = function (grunt) {
	grunt.initConfig({
		less: {
			development: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					"assets/css/bootstrap.modal.css": "assets/less/bootstrap.modal.less"
				}
			}
		},
		watch: {
			styles: {
				files: ['assets/less/*.less', ],
				tasks: ['less'],
				options: {
					nospawn: true
				}
			}
		},
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
							'sbmodal.php',
							'screenshot-1.png',
							'screenshot-2.png',
							'screenshot-3.png',
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