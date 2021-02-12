<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fa-w fa-edit"></i>
               Nueva reserva
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('reserva.store') }}" method="POST">
               @csrf
               <div class="form-group required">
                <label for="" class="control-label">Nombre cliente: </label>
                <input  type="text" name="cliente" id="cliente"
                   class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                 <br>
                  <label for="mecanico" class="control-label">Telefono: </label>
                <input  type="text" name="telefono" id="telefono"
                class="form-control"   required  autofocus>
                <br>
                <label for="mecanico" class="control-label">DNI: </label>
                <input  type="text" name="dni" id="dni"
                class="form-control"   required  autofocus>
                <br>
                <label for="mecanico" class="control-label">Direccion: </label>
                <input  type="text" name="direccion" id="direccion"
                class="form-control"   required  autofocus>
                <br>
                <label for="codigo_material" class="control-label">Fecha: </label>
                  <input type="text" class="form-control" id="demo" name="fecha"/>
                                    
              
                <br>
                 <label for="hora" class="control-label">Hora: </label>
                   <select class="form-control"  name="hora" required>
                   
                     <option value="8-AM">8-AM</option>
                     <option value="9-AM">9-AM</option>
                     <option value="10-AM">10-AM</option>
                     <option value="11-AM">11-MD</option>
                     <option value="12-AM">12-MD</option>
                     <option value="1-PM">1-PM</option>
                     <option value="2-PM">2-PM</option>
                     <option value="3-PM">3-PM</option>
                     <option value="4-PM">4-PM</option>
                     <option value="5-PM">5-PM</option>
                    
                  </select>
               <label for="" class="control-label">Razon: </label>
                <input  type="text" name="razon" id="razon"
                   class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                 <br>
                
             
                <label for="codigo_material" class="control-label">Nota(Opcional): </label>
                <input  type="text" name="nota" id="nota"
                class="form-control"  autofocus>
                <br>

                <label for="codigo_material" class="control-label">Mecanico(Opcional): </label>
                <input  type="text" name="mecanico" id="mecanico"
                class="form-control" placeholder="Nombre mecanico"   autofocus>
                <br>
       
               <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">
                     <i class='fas fa-check-circle'></i>
                     Guardar reserva
                  </button>
                  <input type="hidden" id="edit_id" name="edit_id">
                  <a href="" class="btn btn-primary" data-dismiss="modal">
                     <i class='fa fa-times'></i>
                     Cancelar
                  </a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Fin Editar Modal-->



