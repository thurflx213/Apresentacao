import Servicos from '../Models/Servicos.js';
class ServicoController{
    constructor(){
        this.servicoModel = new Servicos();
    }
    listar(){
        return this.servicosModel.listar();
    }

}
export default ServicoController;