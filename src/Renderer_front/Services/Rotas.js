import UsuarioForm from "../Views/Usuario/form/UsuarioForm.js"
class Rotas{
    constructor(){
        this.rotas={
            "/usuario_form": ()=> {
                return new UsuarioForm().renderizarFormulario();
            }
        }        
    }
    async getPage(rota){
            return await this.rotas[rota]();
        }
}
export default Rotas;