<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Core\View;
use App\Koketsu\Controles\Admin\AuthenticatedController;

class ConfiguracoesController extends AuthenticatedController {
    private $configFile;

    public function __construct() {
        parent::__construct();
        $this->configFile = __DIR__ . '/../Config/settings.json';
    }

    public function index(): void {
        $config = json_decode(file_get_contents($this->configFile), true);
        
        View::render('configuracoes/index', [
            'nomeUsuario' => $this->session->get('usuario_nome'),
            'usuarioTipo' => $this->session->get('usuario_tipo'),
            'manutencaoAtiva' => $config['manutencao'] ?? false
        ]);
    }

    public function salvarManutencao() {
        if ($this->session->get('usuario_tipo') !== 'admin') {
            echo json_encode(['success' => false, 'message' => 'Não autorizado']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $status = $input['status'] ?? false;

        $config = ['manutencao' => (bool)$status];
        
        if (file_put_contents($this->configFile, json_encode($config, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar arquivo']);
        }
    }
}
