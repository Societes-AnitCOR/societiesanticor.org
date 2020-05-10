$('#summernote, .summernote').summernote({
   height: 150,                 // set editor height
   minHeight: 150,             // set minimum height of editor
   maxHeight: null,             // set maximum height of editor
   focus: true   ,               // set focus to editable area after initializing su
   lang: 'fr-FR',
   toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          // ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol']],
      ]
  });
