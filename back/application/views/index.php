<body>
    <div class="row">
        <div class=" p-3 col-12 border-bottom" style="text-align: center;">
            <h3 class="h3">Ejercicio 1 php</h3>
        </div>
    </div>
    <div class="row"> 
        <div class="col-4" style="margin:auto;text-align: center;">
          <button class="btn btn-primary" data-toggle="modal" data-target="#AddprodModal">Agregar producto</button>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4">
            <form onsubmit="return mySubmitFunction(event)"> 
                <div class="form-group p-3">
                    <label for="dolar">Valor dolar:</label>
                    <input type="number" class="form-control" id="dolar" >  
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio ARG</th>
                    <th scope="col">Precio USD</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Borrar</th>
                  </tr>
                </thead>
                <tbody id="productos">
                </tbody>
              </table>
        </div>
    </div>
</body>
<div class="modal fade" id="AddprodModal" tabindex="-1" role="dialog" aria-labelledby="AddprodModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddprodLabel">Agregar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return mySubmitFunction(event)">
          <div class="form-group p-3">
            <label for="nombreprod">Nombre del producto:</label>
            <input type="text" class="form-control" id="nombreprod" >  
          </div>
          <div class="form-group p-3">
            <label for="preciopesos">Precio en pesos:</label>
            <input type="number" class="form-control" id="preciopesos" >  
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="putProducto" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="EditprodModal" tabindex="-1" role="dialog" aria-labelledby="EditprodModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditprodLabel">Editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return mySubmitFunction(event)">
          <div class="form-group p-3">
            <label for="nombreprodpost">Nombre del producto:</label>
            <input type="text" class="form-control" id="nombreprodpost" >  
          </div>
          <div class="form-group p-3">
            <label for="preciopesospost">Precio en pesos:</label>
            <input type="number" class="form-control" id="preciopesospost" >  
          </div>
          <input type="hidden" id="idprodpost">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="postProducto" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script>
  //los ajax estan en ajax.js
  $(document).ready(function(){
    getdolar();
  });

  function mySubmitFunction(e) {
    e.preventDefault();
    return false;
  }
  
  $(document).on("click", ".bi-pencil", function(){
      var currentRow=$(this).closest("tr");
      $('#idprodpost').val(currentRow.find("td:eq(0)").text());
      $('#nombreprodpost').val(currentRow.find("td:eq(1)").text());
      $('#preciopesospost').val(currentRow.find("td:eq(2)").text().replace("$",""));
      $('#EditprodModal').modal('show'); 
    
  });

  $('#dolar').on('change',function(){
    var dolar = $('#dolar').val();
    putdolar(dolar);
  });

  $('#putProducto').on("click",function(){
    $('#putProducto').attr("disabled","disabled");
    var nombreprod = $('#nombreprod').val();
    var preciopesos = $('#preciopesos').val();
    if(!nombreprod){
      $('#nombreprod').addClass("is-invalid");
      $('#nombreprod').after("<div id='invalid-nombreprod' class='invalid-feedback'>Error en la validacion datos</div>");
      $('#putProducto').removeAttr("disabled","disabled");
      setTimeout(function(){ 
        $("#invalid-nombreprod").remove(); 
        $('#nombreprod').removeClass("is-invalid");
      }, 2000);
      return;
    }
    if(!preciopesos){
      $('#preciopesos').addClass("is-invalid");
      $('#preciopesos').after("<div id='invalid-preciopesos' class='invalid-feedback'>Error en la validacion datos</div>");
      $('#putProducto').removeAttr("disabled","disabled");
      setTimeout(function(){ 
        $("#invalid-preciopesos").remove(); 
        $('#preciopesos').removeClass("is-invalid");
      }, 2000);
      return;
    }
    putproducto(nombreprod,preciopesos);
  });

  $('#postProducto').on("click",function(){
    $('#postProducto').attr("disabled","disabled");
    var nombreprod = $('#nombreprodpost').val();
    var preciopesos = $('#preciopesospost').val();
    var idprod = $('#idprodpost').val();
    if(!nombreprod){
      $('#nombreprodpost').addClass("is-invalid");
      $('#nombreprodpost').after("<div id='invalid-nombreprodpost' class='invalid-feedback'>Error en la validacion datos</div>");
      $('#postProducto').removeAttr("disabled","disabled");
      setTimeout(function(){ 
        $("#invalid-nombreprodpost").remove(); 
        $('#nombreprodpost').removeClass("is-invalid");
      }, 2000);
      return;
    }
    if(!preciopesos){
      $('#preciopesospost').addClass("is-invalid");
      $('#preciopesospost').after("<div id='invalid-preciopesospost' class='invalid-feedback'>Error en la validacion datos</div>");
      $('#postProducto').removeAttr("disabled","disabled");
      setTimeout(function(){ 
        $("#invalid-preciopesospost").remove(); 
        $('#preciopesospost').removeClass("is-invalid");
      }, 2000);
      return;
    }
    postproducto(nombreprod,preciopesos,idprod);
  });

  $(document).on("click", ".bi-x", function(){
    var currentRow=$(this).closest("tr");
    var idprod = currentRow.find("td:eq(0)").text();
    if(confirm("Esta seguro de eliminar este producto")){
      delprod(idprod);
    }  
  });
  
</script>
