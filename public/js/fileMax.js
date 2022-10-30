//  para la longitudes

//  para tamaño y extencion de imagenes
$(document).on('change','.inputMax-image',function(){    
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if(fileSize > 10000000){
        alert('El archivo no debe superar los 3MB');
        this.value = '';
        this.files[0].name = '';
    }else{
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        
        // Convertimos en minúscula porque 
        // la extensión del archivo puede estar en mayúscula
        ext = ext.toLowerCase();
    
        // console.log(ext);
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf': break;
            default:
                alert('El archivo no tiene la extensión adecuada');
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }
});


//  para tamaño y extencion de video
$(document).on('change','.inputMax-video',function(){    
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if(fileSize > 50000000){
        alert('El archivo no debe superar los 3MB');
        this.value = '';
        this.files[0].name = '';
    }else{
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        
        // Convertimos en minúscula porque 
        // la extensión del archivo puede estar en mayúscula
        ext = ext.toLowerCase();
    
        // console.log(ext);
        switch (ext) {
            case '.mp4':
            case 'avi':
            case 'mov': break;
            default:
                alert('El archivo no tiene la extensión adecuada');
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }
});



//  para tamaño y extencion de PDF
$(document).on('change','.inputMax-pdf',function(){    
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if(fileSize > 5000000){
        alert('El archivo no debe superar los 3MB');
        this.value = '';
        this.files[0].name = '';
    }else{
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        
        // Convertimos en minúscula porque 
        // la extensión del archivo puede estar en mayúscula
        ext = ext.toLowerCase();
    
        // console.log(ext);
        switch (ext) {
            case '.pdf': break;
            default:
                alert('El archivo no tiene la extensión adecuada');
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }
});

