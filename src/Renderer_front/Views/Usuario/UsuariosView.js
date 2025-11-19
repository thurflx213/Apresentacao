class UsuariosView{
       constructor(){
       }
       renderizarLista(usuarios){
        let container = '<div class="container">';
        usuarios.forEach(usuario => {
            container += `<div>${usuario.nome} - ${usuario.email} </div><br/>`
        });
         container += "</div>";
         return container;
       }
       renderizarFormulario(){
        return `<form id="form-usuario">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" placeholder="Nome">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Email">
                    <button type="submit">Salvar</button>
                </form>`;
       }
}
export default UsuariosView;