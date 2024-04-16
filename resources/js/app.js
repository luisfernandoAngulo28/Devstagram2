import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,
    
    init: function () {
      if (document.querySelector('[name="imagen"]').value.trim()) {// si hay algo va agarrar lo de value
          const imagenPublicada = {};//object vacio
          imagenPublicada.size = 1234; //un valor cualquiera
          imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            //opciones de dropzon
          this.options.addedfile.call(this, imagenPublicada);
          //this.options.thumbnail.call(this,objeto,caminode la imagen);
          this.options.thumbnail.call(
              this,
              imagenPublicada,
              `/uploads/${imagenPublicada.name}`
          );
            //clases de dropzon
          imagenPublicada.previewElement.classList.add(
              "dz-success",
              "dz-complete"
          );
      }
  },
});

/*dropzone.on("sending",function(file,xhr,formData){
   console.log(formData);
});*/

dropzone.on("success",function(file,response){
    //console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
 });
/*
 dropzone.on("error",function(file,message){
    console.log(message);
 });*/
 //Reseteamos la imagen
 dropzone.on("removedfile",function(){
    //console.log("Archivo Eliminado");
    document.querySelector('[name="imagen"]').value = "";
 });

