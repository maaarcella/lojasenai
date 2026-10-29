<?php
include 'conexao.php';
include 'funcoes.php';

// 2º momento: o botão "Sim, excluir" foi clicado (formulário com method="post")
if (isset($_POST['id'])) {
    $sql = $pdo->prepare('DELETE FROM cliente WHERE id = ?');
    $sql->execute([$_POST['id']]);

    header('Location: clientes.php?msg=excluido');
    exit;
}

// 1º momento: chegou pelo link Excluir (clientes.php -> cliente_excluir.php?id=...)
$id = $_GET['id'];

$sql = $pdo->prepare('SELECT * FROM cliente WHERE id = ?');
$sql->execute([$id]);
$cliente = $sql->fetch();

// Conta quantas vendas esse cliente tem (a coluna correta no banco é cliente_id)
$sql = $pdo->prepare('SELECT COUNT(*) FROM venda WHERE cliente_id = ?');
$sql->execute([$id]);
$qtd_vendas = $sql->fetchColumn();

$titulo = 'Excluir cliente';
$pagina = 'clientes.php';
include 'topo.php';
?>

<div class="caixa">
    <h1>Excluir cliente</h1>

    <?php if ($qtd_vendas > 0) { ?>
        <!-- Tem vendas: não deixa excluir, senão a venda fica sem cliente -->
        <div class="aviso erro">
            <b><?= e($cliente['nome']) ?></b> tem <b><?= $qtd_vendas ?></b> venda(s) registrada(s) e não pode ser excluído. Exclua as vendas primeiro.
        </div>
        <div class="acoes">
            <a href="clientes.php" class="botao botao-claro">Voltar</a>
        </div>
    <?php } else { ?>
        <p>Tem certeza que deseja excluir <b><?= e($cliente['nome']) ?></b>?</p>
        <p>Essa ação não pode ser desfeita.</p>

        <!-- Sem action: o formulário envia para esta mesma página -->
        <form method="post" class="acoes">
            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
            <button type="submit" class="botao botao-perigo">Sim, excluir</button>
            <a href="clientes.php" class="botao botao-claro">Cancelar</a>
        </form>
    <?php } ?>
</div>

<?php include 'rodape.php'; ?>