import Usuarios from "../Models/Usuarios.js";
class UsuarioController{
         constructor(){
            this.usuarioModel = new Usuarios();
         }
            async cadastrar(usuario){
                if(!usuario.nome || !usuario.email){
                    return false;
                }
                this.usuarioModel.adicionar(usuario);
                return true;
            }
  }

export default UsuarioController;