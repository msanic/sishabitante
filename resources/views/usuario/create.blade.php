<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('usuarios.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
                 <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="name"   placeholder="Nombre" required>
                  </div>

                  <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" name="email"   placeholder="Usuario" required>
                  </div>
                  <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control" name="password"   placeholder="Contraseña" required>
                  </div>
                  <div class="form-group">
                    <label for="">Rol</label>
                     <select name="rol" id="" class="form-control">
                        <option selected disabled value="">Selecciona...</option>
                        <option value="administrador">Administrador</option>
                        <option value="alcaldia">Alcaldia</option>
                        <option value="junta directiva">Junta directiva</option>
                        <option value="cocode">Cocode</option>
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" name="foto"   placeholder="">
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>