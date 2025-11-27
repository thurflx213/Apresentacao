import UsuarioListar from "../Views/Usuario/listar/UsuarioListar.js"
import UsuarioForm from "../Views/Usuario/form/UsuarioForm.js"
import UsuariosView from "../Views/Usuario/UsuariosView.js";
class Rotas {
    constructor(){
        this.rotas={
            "/usuarios_listar": async () =>{
             return new UsuarioListar().renderizarLista();    
             },
            "/usuarios_criar": () =>{
                return new UsuarioForm().renderizarFormulario();
             },
            "/usuarios_menu": () =>{
                return new UsuariosView().renderizarMenu();
             }
}
}
async getPage(rota){
            // usuario_listar
                                    // new UsuarioListar()
            return await this.rotas[rota]();
    }
}
export default Rotas;