import UsuariosView from "../UsuariosView.js";
class UsuarioListar{
    constructor(){
        this.usuariosView = new UsuariosView();
    }
    async renderizarLista(){
        const dados = await window.api.listar();
        console.log('dados na usuario listar:', dados);
        return this.usuariosView.renderizarLista(dados);
    }
}
export default UsuarioListar;