<div class="modal modal-default fade in" id="myModal{{ $slot }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <div style="font-size: 5em; color: red; text-align: center; margin: auto;">
                <i class="fas fa-exclamation-triangle"></i>
                <span style="font-size: 0.3em; color: black;"><p>¿Seguro quiere eliminarlo?</p></span>
              </div> 
            </div>
            <div class="modal-footer">
                <input hidden value = "1" name="number">
              <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No, salir</button>
              <label for="Eliminar{{ $slot }}" class='btn btn-danger'>Si, eliminar</label>
            </div>
          </div>
        </div>
      </div>