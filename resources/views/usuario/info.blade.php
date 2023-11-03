<!-- Modal -->
<div class="modal fade" id="edit{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> 
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">EDITAR USUARIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('usuarios.update',$usuario->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
        <div class="modal-body">
                   <div class="form-group">
                      <label for="">Nombre</label>
                      <input type="text" class="form-control" name="name" value="{{$usuario->name}}"   placeholder="Nombre" required>
                    </div>
  
                    <div class="form-group">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control" name="email" value="{{$usuario->email}}"  required>
                    </div>
                    <div class="form-group">
                      <label for="">Contraseña</label>
                      <h6>(déjalo en blanco si deseas mantener el actual)
                      </h6>
                      <input type="password" class="form-control" name="password" > 
                    </div>
                    <div class="form-group">
                      <label for="">Rol</label>
                       <select name="rol" id="" class="form-control">
                          <option selected disabled value="">Selecciona...</option>
                          @if($usuario->rol=="administrador")
                          <option value="administrador" selected>Administrador</option>
                          <option value="alcaldia">Alcaldia</option>
                          <option value="junta directiva">Junta directiva</option>
                          <option value="cocode">Cocode</option>
                          @elseif($usuario->rol=="alcaldia")
                          <option value="alcaldia" selected>Alcaldia</option>
                          <option value="administrador" >Administrador</option>
                          <option value="junta directiva">Junta directiva</option>
                          <option value="cocode">Cocode</option>
                          @elseif($usuario->rol=="junta directiva")
                          <option value="junta directiva" selected>Junta directiva</option>
                          <option value="administrador" >Administrador</option>
                          <option value="cocode">Cocode</option>
                          <option value="alcaldia">Alcaldia</option>
                          @elseif($usuario->rol=="cocode")
                          <option value="cocode" selected>Cocode</option>
                          <option value="junta directiva">Junta directiva</option>
                          <option value="administrador" >Administrador</option>
                          <option value="alcaldia">Alcaldia</option>
                          @endif
                       </select>
                    </div>
                    <div class="form-group">
                      <label for="">Foto</label>
                      <input type="file" class="form-control" name="foto"   placeholder="">
                      @if ($usuario->foto!="")
                      <img src="{{ asset('loginfoto/'.$usuario->foto)}}" alt="" width="50px" height="50px"> 
                      @endif
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </form>
      </div>
    </div>
  </div>




  <div class="modal fade" id="delete{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel">ELIMINAR USUARIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('usuarios.destroy',$usuario->id)}}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          Estás seguro de eliminar a <strong>{{$usuario->name}}?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
          </form>
      </div>
    </div>
  </div>