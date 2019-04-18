var DropzoneDemo = {
    init:function() {
        Dropzone.options.mDropzoneThree = {
            paramName:"file",
            maxFiles:10,
            maxFilesize:10,
            addRemoveLinks:!0,
            acceptedFiles:"image/*,application/pdf",
            accept:function(file,done) {
                console.log(file.name);              
            }
        }
    }
};
DropzoneDemo.init();