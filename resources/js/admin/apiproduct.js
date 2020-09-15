const { data } = require("jquery");

const apiproduct = new Vue({
    el: '#apiproduct',
    data: {
        nombre: '',
        slug: '',
        div_mensajeslug:'Slug Existe',
        div_clase_slug: 'badge badge-danger',
        div_aparecer: false,
        deshabilitar_boton:1,

        //variables de precios

        precioanterior:0,
        precioactual:0,
        descuento:0,
        porcentajededescuento:0,
        descuento_mensaje:'0'
    }, 
    computed: {
        generarSLug : function(){
            var char= {
                "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                "ñ":"n","Ñ":"N"," ":"-","_":"-"
            }
            var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;

            this.slug =  this.nombre.trim().replace(expr, function(e){
                return char[e]
            }).toLowerCase()

            return this.slug;
           //return this.nombre.trim().replace(/ /g,'-').toLowerCase()
        },


        generardescuento : function(){

            if(this.porcentajededescuento >100){

                
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes poner un valor mayor a 100!'
                });
                

                this.porcentajededescuento = 100;

                this.descuento = (this.precioanterior * this.porcentajededescuento) /100;
                this.precioactual = this.precioanterior - this.descuento;
                this.descuento_mensaje = 'Este producto tiene el 100% de descuento, por lo que es gratis';
                return this.descuento_mensaje;

            }else 
            
            if(this.porcentajededescuento <0){

                
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes poner un valor menor a 0!'
                });
                

                this.porcentajededescuento = 0;
                
                this.descuento = (this.precioanterior * this.porcentajededescuento) /100;
                this.precioactual = this.precioanterior - this.descuento;
                this.descuento_mensaje = '';
                return this.descuento_mensaje;

            }else

                if(this.porcentajededescuento >0){

                    this.descuento = (this.precioanterior * this.porcentajededescuento) /100;

                    this.precioactual = this.precioanterior - this.descuento;

                    if(this.porcentajededescuento == 100){
                        this.descuento_mensaje = 'Este producto tiene el 100% de descuento, por lo que es gratis';
                    }else{
                        this.descuento_mensaje = 'Hay un descuento de $' + this.descuento;
                    }

                    return this.descuento_mensaje;
                    
                }
                else{

                    this.descuento = '';

                    this.precioactual = this.precioanterior;

                    
                    this.descuento_mensaje = '';
                    
                
                    

                    return this.descuento_mensaje;
                    
                }
            

        
        
        }
    },

    methods: {
        eliminarimagen(imagen) {

            

            Swal.fire({
                title: 'Estas seguro?',
                text: "Esta accion no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {

                    let url = '/api/eliminarimagen/'+ imagen.id;
                    axios.delete(url).then(response => {

                        console.log(response.data);

                    });

                    //eliminar el  elemento visualmente
                    var elemento = document.getElementById('idimagen-' + imagen.id);
                    // console.log(elemento);
                    elemento.parentNode.removeChild(elemento);

                    Swal.fire(
                    'Elimidado!',
                    'Tu archivo ha sido eliminado correctamente.',
                    'success'
                    )
                }
            })
        },

        getProduct() {

            if(this.slug){

                let url = '/api/product/'+this.slug;
                axios.get(url).then(response => {
                    this.div_mensajeslug = response.data;
                    if (this.div_mensajeslug==="Slug Disponible") {
                        this.div_clase_slug = 'badge badge-success';
                        this.deshabilitar_boton=0;
                    } else {
                        this.div_clase_slug = 'badge badge-danger';
                        this.deshabilitar_boton=1;
                    }
                    this.div_aparecer = true;

                    if(data2.datos.nombre){

                        if(data2.datos.nombre === this.nombre){

                            this.deshabilitar_boton=0;
                            this.div_mensajeslug='';
                            this.div_clase_slug='';
                            this.div_aparecer = false;

                        }

                    }


                })

            }else{
                this.div_clase_slug = 'badge badge-danger';
                this.div_mensajeslug= "Debes escribir un producto";
                this.deshabilitar_boton=1;
                this.div_aparecer = true;
            }
            


        }


        
        
    },
    mounted(){
        
        

        if (data2.editar=='Si') {
            this.nombre = data2.datos.nombre;
            this.precioanterior = data2.datos.precioanterior;
            this.porcentajededescuento = data2.datos.porcentajededescuento;
            this.deshabilitar_boton=0;
            
        }
        
        console.log(data2);
        
        

    }

});