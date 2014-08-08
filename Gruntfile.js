module.exports = function(grunt){
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dev: {
				options: {
					style: 'expanded'
				},
				files: {
					'css/style.css':'css/style.scss'
				}
			},
			dist: {
				options: {
					banner: '/*! <%= pkg.name %> | <%= pkg.version %> | <%= pkg.author %> | <%= pkg.license %> */\n',
					style: 'compressed'
				},
				files: {
					'css/style.min.css':'css/style.scss'
				}
			}
		},

		watch: {
			css: {
				files: ['css/*.scss'],
				tasks: ['sass:dev'],
				options: {
					spawn: false
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', ['sass', 'watch']);
};