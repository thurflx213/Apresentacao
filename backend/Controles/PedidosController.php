<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Pedidos;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;


class PedidosController {
    public $pedidos;
    public $db;
    public function __construct() {
    $this->db = Database::getInstance();
    $this->pedidos = new Pedidos($this->db);
}

// index
public function index(){
 $resultado = $this->pedidos->buscarPedidos();
 return $resultado;
}  
    

    public function viewPedidoUnico(int $id) {
        $dados = $this->pedidos->buscarPedidoPorId($id);

        if ($dados) {

            View::render('pedidos/detalhes', ['pedido' => $dados]);
        } else {
        
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo 'Pedido não encontrado.';
        }
    }


 public function viewlistarPedido(){
 $dados = $this->pedidos->paginacao();
 $total = $this->pedidos->totaldePedidos();
 view::render("Pedidos/index",
 ["pedidos" => $dados['data'],
 "total_pedidos" => $total[0],
 "total_inativos" => 22,
 "Total_ativos" => 12,
 'paginacao' => $dados
]
);
}

public function viewCriarPedidos(){
 view::render("pedidos/create");
}
public function viewEditarPedido(int $id){
  $dados = $this->pedidos->buscarPedidoPorId($id);
var_dump($dados);
//  foreach($dados as $pedidos){
// $dados = $pedidos;
// }
 View::render('pedidos/edit', ['Pedido' => $dados]);
}

public function viewexcluirPedido(){
 view::render("pedidos/delete");
}

public function atualizarPedidos(){
 echo "Atualizar usuario";
}
public function deletarUsuario(){
 echo "Deletar usuario";
} 
public function relatorioPedido($id, $data1, $data2){
 View::render("pedido/relatorio",
 ["id"=> $id, "data1"=> $data1, "data2"=> $data2]);
}

 public function salvarPedido() {

}

}
