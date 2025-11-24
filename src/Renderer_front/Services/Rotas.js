import UsuarioForm from "../Views/Usuario/form/UsuarioForm.js"
class Rotas{
    constructor(){
        this.rotas={
            "/usuario_form": ()=> {
                return new UsuarioForm().renderizarFormulario();
            },
            "/usuario_listar":async () =>{
                return new UsuarioListar().renderizarLista();
            }
        }        
    }
    async getPage(rota){
            return await this.rotas[rota]();
        }
}
export default Rotas;