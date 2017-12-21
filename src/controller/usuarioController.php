<?php


class usuarioController extends Controller {

  public function index($pagina=1,$estado='todos',$nombreyapellido= ''){
    $limite = (int) ELEM_PAGINA;
    $desde = $limite * ($pagina-1);
    $resources = ['pagina' => $pagina];
    if(isset($_POST['nombreyapellido'])){
      $nombreyapellido = htmlspecialchars(trim($_POST['nombreyapellido']));
    }
    if(isset($_POST['estado'])){
      $estado = htmlspecialchars(trim($_POST['estado']));
    }
    $resources['nombreyapellido'] = $nombreyapellido;
    $resources['estado'] = $estado;
    $resources['usuarios'] = UsuarioRepository::getInstance()->listLimitUsers($limite,$desde,$nombreyapellido,$estado);
    $total_elem = count(UsuarioRepository::getInstance()->listAll($nombreyapellido,$estado));
    $resources['cant_pag'] = ceil ($total_elem / $limite);
    $this->_view->render('index.html.twig',$resources);
  }

  public function show($id){
    // if(App::getInstance()->current_user()->getId() != $id){
    //   $this->redirect('index/indexAdmin');
    // }
    $usuario = UsuarioRepository::getInstance()->getUserById($id);
    $resources = array('usuario' => $usuario);
    $this->_view->render('show.html.twig',$resources);
  }

  public function create(){
    $resources = [];
    $resources['roles'] = RolRepository::getInstance()->listAll();
    if(isset($_POST['nombre']) && (isset($_POST['apellido'])) && (isset($_POST['email'])) && (isset($_POST['password'])) && (isset($_POST['passwordre']) && (isset($_POST['roles'])))){
      $nombre = htmlspecialchars(trim($_POST['nombre']));
      $apellido = htmlspecialchars(trim($_POST['apellido']));
      $email = htmlspecialchars(trim($_POST['email']));
      $roles = $_POST['roles'];
      $password = htmlspecialchars(trim($_POST['password']));
      $passwordre = htmlspecialchars(trim($_POST['passwordre']));
      $resources['nombre'] = $nombre;
      $resources['apellido'] = $apellido;
      $resources['email'] = $email;
      $resources['roles_selected'] = $roles;
      if(!empty($nombre) && !empty($apellido) && !empty($email) && !empty($password) && !empty($passwordre) ){
        if($password == $passwordre){
          $password = hash( 'sha256', $password );
          if(UsuarioRepository::getInstance()->getUserByEmail($email) == null){
            if(UsuarioRepository::getInstance()->create($nombre,$apellido,$email,$password)){
              $usuario = UsuarioRepository::getInstance()->getUserByEmail($email);
              foreach ($roles as $rol) {
                RolRepository::getInstance()->addRoleToUser($usuario->getId(),$rol);
              }
              UsuarioRepository::getInstance()->setEliminado($usuario->getId(),0);
              $this->getFlashBag()->setMsj('success',"Se ha dado de alta al usuario con exito.");
              $this->redirect('usuario/index');
            }else{
              $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error, intente nuevamente.");
            }
          }else{
            $this->getFlashBag()->setMsj('danger',"Ya existe un usuario con este email.");
          }
        }else{
          $this->getFlashBag()->setMsj('danger',"Las contraseñas no coinciden.");
        }
      } else {
        $this->getFlashBag()->setMsj('warning',"Debe completar todos los campos.");
      }
    }
    $this->_view->render('create.html.twig',$resources);
  }

  public function update($id){
    if(UsuarioRepository::getInstance()->getUserById($id) == null){
      $this->getFlashBag()->setMsj('warning',"El usuario no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }
    $resources = [];
    $resources['roles'] = RolRepository::getInstance()->listAll();
    $resources['usuario'] = UsuarioRepository::getInstance()->getUserById($id);
    if(isset($_POST['nombre']) && (isset($_POST['apellido'])) && (isset($_POST['roles']))){
      $nombre = htmlspecialchars(trim($_POST['nombre']));
      $apellido = htmlspecialchars(trim($_POST['apellido']));
      $password = $resources['usuario']->getPassword();
      $roles = $_POST['roles'];
      $resources['usuario'] = new Usuario($id, $resources['usuario']->getEmail(),'', $resources['usuario']->getActivo(), '', '', $nombre, $apellido);
      if(!empty($nombre) && !empty($apellido) && !empty($roles) ){
        if ((isset($_POST['password'])) && (isset($_POST['passwordre']))){
          $password_new = htmlspecialchars(trim($_POST['password']));
          $passwordre = htmlspecialchars(trim($_POST['passwordre']));
          if ((empty(!$password_new) && empty($passwordre)) || (empty($password_new) && empty(!$passwordre))) {
            $this->getFlashBag()->setMsj('danger',"Se debe ingresar la nueva contraseña y repetirla.");
            $this->_view->render('update.html.twig',$resources);return;
          } else {
            if($password_new == $passwordre){
              $password = hash( 'sha256', $password_new );
            }else{
              $this->getFlashBag()->setMsj('danger',"Las contraseñas no coinciden.");
              $this->_view->render('update.html.twig',$resources);return;
            }
          }
        }
        if(UsuarioRepository::getInstance()->update($id,$nombre,$apellido,$password)){
          foreach ($resources['usuario']->getRol() as $rol) {
            RolRepository::getInstance()->destroyRoleToUser($id,$rol->getId());
          }
          foreach ($roles as $rol) {
            RolRepository::getInstance()->addRoleToUser($id,$rol);
          }
          $this->getFlashBag()->setMsj('success',"Se ha actualizado al usuario con exito.");
          $this->redirect('usuario/index');
        }else{
          $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error, intente nuevamente.");
        }
      } else {
        $this->getFlashBag()->setMsj('warning',"Debe completar todos los campos.");
      }
    }
    $this->_view->render('update.html.twig',$resources);
  }



  public function login(){
    if(App::getInstance()->current_user() != null){
      $this->getFlashBag()->setMsj('warning',"Ya se encuentra en una sesión activa.");
      $this->redirect('index/indexAdmin');
    }
    $resource = [];
    if(isset($_POST['email']) && (isset($_POST['password']))){
      $email = htmlspecialchars(trim($_POST['email']));
      $password = htmlspecialchars(trim($_POST['password']));
      $resource['email'] = $email;
      if(!empty($password) && (!empty($email))){
        $password = hash( 'sha256', $password );
        $usuario = UsuarioRepository::getInstance()->validateUser($email,$password);
        if($usuario == null){
          $this->getFlashBag()->setMsj('danger',"Los datos ingresados no son correctos.");
        }else {
          $this->getFlashBag()->setMsj('success',"Ha iniciado sesión con exito.");
          $_SESSION['current_user'] = $usuario;
          $this->redirect('index/indexAdmin');
        }
      } else {
        $this->getFlashBag()->setMsj('warning',"Debe completar todos los campos");
      }
    }
    $this->_view->render('login.html.twig',$resource);
  }

  public function logout(){
    unset($_SESSION['current_user']);
    $this->getFlashBag()->setMsj('success',"Ha cerrado sesión.");
    $this->redirect('index');
  }

  public function suspend($id){
    $usuario = UsuarioRepository::getInstance()->getUserById($id);
    if($usuario == null){
      $this->getFlashBag()->setMsj('warning',"El usuario no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }
    $activo = $usuario->getActivo();
    if ($activo == "Activo") {
      $repo = UsuarioRepository::getInstance()->setActivo($id, 0);
      if ($repo) {
        $this->getFlashBag()->setMsj('success',"El usuario ha sido suspendido.");
      } else {
        $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error. Intentelo nuevamente.");
      }
    }
    else {
      $this->getFlashBag()->setMsj('danger',"El usuario ya se encuentra suspendido.");
    }
    $this->redirect("usuario/index");
  }

  public function activate($id){
    $usuario = UsuarioRepository::getInstance()->getUserById($id);
    if($usuario == null){
      $this->getFlashBag()->setMsj('warning',"El usuario no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }
    $activo = $usuario->getActivo();
    if ($activo == "Suspendido") {
      $repo = UsuarioRepository::getInstance()->setActivo($id, 1);
      if ($repo) {
        $this->getFlashBag()->setMsj('success',"El usuario ha sido activado.");
      } else {
        $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error. Intentelo nuevamente.");
      }
    }
    else {
      $this->getFlashBag()->setMsj('danger',"El usuario ya se encuentra activado.");
    }
    $this->redirect("usuario/index");
  }

  public function destroy($id){
    $usuario = UsuarioRepository::getInstance()->getUserById($id);
    if($usuario == null){
      $this->getFlashBag()->setMsj('warning',"El usuario no existe en el sistema.");
      $this->redirect('usuario');
    }
    $current_user = App::getInstance()->current_user();
    if($usuario->getid() == $current_user->getId()){
      $this->getFlashBag()->setMsj('warning',"No es posible eliminar su propio usuario.");
      $this->redirect('usuario');
    }
    $repo = UsuarioRepository::getInstance()->setEliminado($id, 1);
    if ($repo) {
      $this->getFlashBag()->setMsj('success',"El usuario ha sido eliminado.");
    } else {
      $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error. El usuario no existe.");
    }
    $this->redirect("usuario/index");
  }

}
