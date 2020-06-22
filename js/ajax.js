var URLdomain   = window.location.host;
var URLprotocol = window.location.protocol;
function getproductos(){
    $.ajax({
      type: "GET",
      url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Productos/getProductos",
      dataType: "json",
      success: function(data){
        $('#productos > tr').remove();
        data.forEach(prod => {
          $('#productos').append("<tr class='edit'>"+
            "<td scope='row'>"+prod["id"]+"</td>"+
            "<td>"+prod["nombre"]+"</td>"+
            "<td>$"+prod["preciopesos"]+"</td>"+
            "<td>USD "+(Math.round(((prod["preciopesos"]/$('#dolar').val()) + Number.EPSILON) * 100) / 100)+"</td>"+
            "<td><svg class='bi bi-pencil' width='2em' height='2em' viewBox='0 0 20 20' fill='currentColor'><path fill-rule='evenodd' d='M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z'clip-rule='evenodd'></path><path fill-rule='evenodd' d='M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z'clip-rule='evenodd'></path></svg></td>"+
            "<td><svg class='bi bi-x' width='2em' height='2em' viewBox='0 0 20 20' fill='currentColor'><path fill-rule='evenodd' d='M5.646 5.646a.5.5 0 000 .708l8 8a.5.5 0 00.708-.708l-8-8a.5.5 0 00-.708 0z' clip-rule='evenodd'></path><path fill-rule='evenodd' d='M14.354 5.646a.5.5 0 010 .708l-8 8a.5.5 0 01-.708-.708l8-8a.5.5 0 01.708 0z' clip-rule='evenodd'></path></svg></td>"+
            "</tr>");
        });
      },
      error : function(data) {
        alert("error no se puedo cargar la tabla de productos");
      }
    }); 
}
function getdolar(){
    $.ajax({
    type: "GET",
    url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Dolares/getDolar",
    dataType: "json",
    success: function(data){
        $('#dolar').val(data);
        //aca se llama a rellenar la tabla para primero obtener el valor del dolar y no causar errores
        getproductos();
    },
    error : function(data) {
        $('#dolar').addClass("is-invalid");
        $("#invalid-dolar").remove();
        $('#dolar').after("<div id='invalid-dolar' class='invalid-feedback'>Error al cargar</div>"); 
        setTimeout(function(){ 
        $("#invalid-dolar").remove(); 
        $('#dolar').removeClass("is-invalid");
        }, 3000);
    }
    }); 
}
function delprod(idprod){
    $.ajax({
        type: "POST",
        data: {[csrfName]: csrfHash,idprod:idprod},
        url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Productos/delProducto",
        dataType: "json",
        success: function(data){
        csrfName = data.csrfName;
        csrfHash = data.csrfHash;
          alert("El  producto "+idprod+" se elimino correctamente");
          getproductos();
        },
        error : function(data) {
          Alert("El "+idprod+" producto no se elimino");
        }
    }); 
}
function postproducto(nombreprod,preciopesos,idprod){
    $.ajax({
        type: "POST",
        data: {[csrfName]: csrfHash,nombreprod:nombreprod,preciopesos:preciopesos,idprod:idprod},
        url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Productos/postProducto",
        dataType: "json",
        success: function(data){
          csrfName = data.csrfName;
          csrfHash = data.csrfHash;
          getproductos();
          $('#EditprodModal').modal('hide'); 
          $('#putProducto').removeAttr("disabled","disabled");
        },
        error : function(data) {
          $('#postProducto').removeAttr("disabled","disabled");
          if(data.status===401){
            $('#preciopesospost').after("<div id='msgproductopost' style='color:red'>Error ese producto ya existe, no se puede modificar</div>");
          }else{
            $('#preciopesospost').after("<div id='msgproductopost' style='color:red'>Error al cargar completar datos correctamente</div>");
          }
          setTimeout(function(){ 
            $("#msgproductopost").remove(); 
          }, 2000);
        }
    });   
}
function putproducto(nombreprod,preciopesos){
    $.ajax({
        type: "POST",
        data: {[csrfName]: csrfHash,nombreprod:nombreprod,preciopesos:preciopesos},
        url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Productos/putProducto",
        dataType: "json",
        success: function(data){
          csrfName = data.csrfName;
          csrfHash = data.csrfHash;
          getproductos();
          $('#AddprodModal').modal('hide'); 
          $('#putProducto').removeAttr("disabled","disabled");
        },
        error : function(data) {
          $('#putProducto').removeAttr("disabled","disabled");
          if(data.status===401){
            $('#preciopesos').after("<div id='msgputproducto' style='color:red'>Error ese producto ya existe</div>");
          }else{
            $('#preciopesos').after("<div id='msgputproducto' style='color:red'>Error al cargar completar datos correctamente</div>");
          }
          setTimeout(function(){ 
            $("#msgputproducto").remove(); 
          }, 2000);
        }
      }); 
}
function putdolar(dolar){
    $.ajax({
        type: "POST",
        data: {[csrfName]: csrfHash,dolar:dolar},
        url: URLprotocol+"//"+URLdomain+"/ejerciciocac/Dolares/putDolar",
        dataType: "json",
        success: function(data){
          csrfName = data.csrfName;
          csrfHash = data.csrfHash;
          console.log(1);
          console.log(csrfHash);
          console.log(data.csrfHash);
          $('#dolar').removeClass("is-invalid");
          $('#dolar').addClass("is-valid");
          $("#valid-dolar").remove();
          $("#invalid-dolar").remove();
          $('#dolar').after("<div id='valid-dolar' class='valid-feedback'>Guardado correctamente</div>");
          getproductos();
          setTimeout(function(){ 
            $("#valid-dolar").remove(); 
            $('#dolar').removeClass("is-valid");
          }, 2000);
        },
        error : function(data) {
          $('#dolar').removeClass("is-valid");
          $('#dolar').addClass("is-invalid");
          $("#valid-dolar").remove();
          $("#invalid-dolar").remove();
          $('#dolar').after("<div id='invalid-dolar' class='invalid-feedback'>Error en la validacion datos</div>");
          setTimeout(function(){ 
            $("#invalid-dolar").remove(); 
            $('#dolar').removeClass("is-invalid");
          }, 2000);
        }
      }); 
}
