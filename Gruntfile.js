module.exports = function(grunt) {

  // Project configuration.
	grunt.initConfig({
	    pkg: grunt.file.readJSON('package.json'),

	    // copies the plugin files to a svn-style 
	    // directory which is ignored by git
	    copy: {
	    	// copy wordpress assets
	    	// assets: {
	    	// 	files: [
			   //  	{ expand: true, src: 'assets/assets/*', dest: 'wordpress-plugin/' },
	    	// 	]
	    	// },
	    	// we need a trunk 
		  	trunk: {
			    files: [
					// include compiled assets
					{ expand: true, src: ['assets/dist/**'], dest: 'wordpress-plugin/trunk/' },
					// includes classes
					{ expand: true, src: ['classes/**'], dest: 'wordpress-plugin/trunk/' },
					// includes functions and other stuff
					{ expand: true, src: ['includes/**'], dest: 'wordpress-plugin/trunk/' },
					// includes vendor files
					{ expand: true,  src: ['vendor/**'],  dest: 'wordpress-plugin/trunk/vendor/' },
					// single files
					{ src: ['<%= pkg.name %>.php', 'README.txt'], dest: 'wordpress-plugin/trunk/' },
			    ],
		  	},
		  	// and also tags are great
		  	tag: {
			    files: [
					// include compiled assets
					{ expand: true, src: ['assets/dist/**'], dest: 'wordpress-plugin/tags/<%= pkg.version %>/' },
					// includes classes
					{ expand: true, src: ['classes/**'], dest: 'wordpress-plugin/tags/<%= pkg.version %>/'},
					// includes functions and other stuff
					{ expand: true, src: ['includes/**'], dest: 'wordpress-plugin/tags/<%= pkg.version %>/' },
					// includes vendor files
					{ expand: true, src: ['vendor/**'], dest: 'wordpress-plugin/tags/<%= pkg.version %>/vendor/'},
					// single files
					{ src: ['<%= pkg.name %>.php', 'README.txt'], dest: 'wordpress-plugin/tags/<%= pkg.version %>/' },
			    ],
		  	}
		},

		// compile sass
		sass: { 
		    dist: { 
		      	options: {
		        	style: 'expanded'
		      	},
		      	files: {
		        	'assets/dist/css/plugin.css': 'assets/src/scss/plugin.scss',
		      	}
		    }
	  	},

		// compile sass
	  	coffee: {
		  	compile: {
		    	files: {
		      		'assets/dist/js/plugin.js': ['assets/src/coffee/*.coffee'] // compile and concat into single file
		    	}
		  	}
		},

		// cssmin
		cssmin: {
			options: {
				shorthandCompacting: false,
				roundingPrecision: -1
			},
			target: {
				files: {
					'assets/dist/css/plugin.min.css': 'assets/dist/css/plugin.css'
				}
			}
		},

		// uglify
		uglify: {
			scripts: {
				files: {
					'assets/dist/js/plugin.min.js': 'assets/dist/js/plugin.js'
				}
			}
		},

		// watch files
	    watch: {
	        scripts: {
	            files: 'assets/src/coffee/*/**.coffee',
	            tasks: ['coffee', 'uglify']
	        },
	        styles: {
	            files: 'assets/src/scss/*.scss',
	            tasks: ['sass', 'cssmin']
	        }
	    }
  	});

	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('build', ['sass', 'coffee', 'uglify', 'cssmin']);
	grunt.registerTask('release', ['build', 'copy']);
	grunt.registerTask('default', ['build', 'watch']);

};