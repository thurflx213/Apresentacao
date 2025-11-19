class Usuarios{
    constructor() {
        this.usuarios = [
            {"nome": "Arthur", "email": "arthur@example.com"},
            {"nome": "Maria", "email": "maria@example.com"}
        ];
    }
    adicionar(usuario) {
        this.usuarios.push(usuario);
    }
     async listar() {
        return this.usuarios;
    }
    remover(usuario) {
        const index = this.usuarios.indexOf(usuario);
        if (index !== -1) {
            this.usuarios.splice(index, 1);
        }
    }
 }
export default Usuarios;