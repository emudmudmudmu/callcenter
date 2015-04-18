module.exports=function(grunt){

	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		concat:{
			'js': {
				src: ['client/js/**/*.js'],
				dest: 'public/dist/js/concat.js'
			}, 
			'vendor-js': {
				src: [
				      'public/bower_components/jquery-autosize/jquery.autosize.min.js', 
				      'public/bower_components/matchHeight/jquery.matchHeight-min.js', 
				      'public/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'
		      	], 
				dest: 'public/dist/js/vendor.js'
			}, 
			'css': {
				src: ['client/css/**/*.css'], 
				dest: 'public/dist/css/concat.css'
			}, 
			'vendor-css': {
				src: [
			      	'public/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'
		      	], 
				dest: 'public/dist/css/vendor.css'
			}
		},
		uglify: {
			options:{
				banner:'/*!<%=pkg.name%><%=grunt.template.today("dd-mm-yyyy")%>*/\n'
			},
			'js': {
                files: {
                	'public/dist/js/concat.min.js': ['public/dist/js/concat.js']
                }
			},
			'vendor-js': {
                files: {
                	'public/dist/js/vendor.min.js': ['public/dist/js/vendor.js']
                }
			}
		}, 
		cssmin: {
			'css':{
				src: 'public/dist/css/concat.css',
			    dest: 'public/dist/css/concat.min.css'
			}, 
			'vendor-css':{
				src: 'public/dist/css/vendor.css',
			    dest: 'public/dist/css/vendor.min.css'
			}
		}, 
		compass: {
			'sass': {
				options: {
	                sassDir: 'client/sass',
	                cssDir: 'client/css',
	                imageDir  : 'client/img',
	                generatedImagesDir : 'public/dist/img',
	                httpGeneratedImagesPath  : '/dist/img',
	                noLineComments: true
				}
			}
		}, 
		watch: {
			'options': {

				livereload: true
				
			},
			'js': {
                files: ['client/js/**/*.js'],
                tasks: ['concat:js', 'uglify:js']
			}, 
			'sass': {
				files: ['client/sass/**/*.scss'],
                tasks: ['compass:sass', 'concat:css', 'cssmin:css']
			}, 
			'php': {
				files: ['app/**/*.php'],
				tasks: []	// only for livereload
			}
		}
		
	});
	
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-compass');
	
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['concat:vendor-js', 'uglify:vendor-js', 'concat:vendor-css', 'cssmin:vendor-css']);
	
};
