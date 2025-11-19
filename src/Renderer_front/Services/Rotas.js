import UsuarioListar from "../Views/Usuario/listar/UsuarioListar.js";

class Rotas {
    constructor(){
        this.rotas={
            "/usuarios_listar": async () =>{
             return new UsuarioListar().renderizarLista();    
        },
        
}
}
async getPage(rota){
            // usuario_listar
                                    // new UsuarioListar()
            return await this.rotas[rota]();
    }
}
export default Rotas;