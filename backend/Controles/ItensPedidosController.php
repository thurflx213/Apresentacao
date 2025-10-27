<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\ItensPedidos;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;


class ItensPedidosController {
    public $itenspedidos;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->itenspedidos = new ItensPedidos($this->db);
    }

    // index - Retorna todos os itens 
    public function index() {
        $resultado = $this->itenspedidos->buscarItensPedidos();
        return $resultado;
    } 

    // Exibe detalhes de um único item de pedido
    public function viewItemPedidoUnico($id) {
        $dados = $this->itenspedidos->buscarItemPedidoPorId($id);

        if ($dados) {
            View::render('itenspedidos/detalhes', ['itempedido' => $dados]);
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo 'Item de Pedido não encontrado.';
        }
    }

  
public function viewListarItemPedido(){
 $dados = $this->itenspedidos->paginacao();
 $total = $this->itenspedidos->totaldeitenspedidos();
 view::render("itenspedidos/index",
 ["itenspedidos" => $dados['data'],
 "total_itenspedidos" => $total[0],
 "total_inativos" => 22,
 "Total_ativos" => 12,
 'paginacao' => $dados
]
);
}
    // Exibe o formulário para criar um novo item de pedido
    public function viewCriarItemPedido() {
        View::render("itenspedidos/create");
    }


   public function viewEditarItemPedido($id) {
        $item = $this->itenspedidos->buscarItemPedidoPorId($id);
        if ($item) {
             View::render("itenspedidos/edit", ["itenspedidos" => $item]);
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo 'Item de Pedido não encontrado.';
        }
    }

  
    public function atualizarItensPedidos($id) {
       
        }
}
