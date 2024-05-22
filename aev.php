<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Controle de Estoque</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Link para o CSS do Bootstrap -->
</head>
<body>
    <div class="container mt-5"> <!-- Container Bootstrap com margem superior de 5 -->
        <h2>Controle de Estoque</h2> <!-- Cabeçalho da página -->
        <table class="table"> <!-- Início da tabela com classes Bootstrap -->
            <thead>
                <tr>
                    <th>Nome do Item</th> <!-- Cabeçalho da coluna "Nome do Item" -->
                    <th>Valor</th> <!-- Cabeçalho da coluna "Valor" -->
                    <th>Quantidade</th> <!-- Cabeçalho da coluna "Quantidade" -->
                    <th>Descrição</th> <!-- Cabeçalho da coluna "Descrição" -->
                    <th>Ações</th> <!-- Cabeçalho da coluna "Ações" -->
                </tr>
            </thead>
            <tbody id="inventoryTable"> <!-- Corpo da tabela com ID "inventoryTable" -->
            <?php
            // Inclui a conexão ao banco de dados
            $conn = include_once('bd.php');

            // SQL para buscar os dados
            $sql = "SELECT id, nome, valor, quantidade, descricao FROM itens_estoque"; // Consulta SQL para selecionar dados da tabela
            $result = $conn->query($sql); // Executa a consulta SQL

            if ($result->num_rows > 0) { // Verifica se há resultados
                // Saída de cada linha
                while($row = $result->fetch_assoc()) { // Itera sobre os resultados
                    echo "<tr>
                            <td>{$row['nome']}</td> <!-- Exibe o nome do item -->
                            <td>{$row['valor']}</td> <!-- Exibe o valor do item -->
                            <td>{$row['quantidade']}</td> <!-- Exibe a quantidade do item -->
                            <td>{$row['descricao']}</td> <!-- Exibe a descrição do item -->
                            <td>
                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='setEditModalValues(\"{$row['id']}\", \"{$row['nome']}\", \"{$row['valor']}\", \"{$row['quantidade']}\", \"{$row['descricao']}\")'>Editar</button> <!-- Botão para abrir modal de edição com valores do item -->
                                <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick='document.getElementById(\"deleteItemId\").value={$row['id']}'>Excluir</button> <!-- Botão para abrir modal de exclusão com o ID do item -->
                            </td>
                          </tr>"; // Fecha a linha da tabela
                }
            } else { // Se não houver resultados
                echo "<tr><td colspan='5'>Nenhum item encontrado</td></tr>"; // Exibe mensagem informando que não há itens
            }
            $conn->close(); // Fecha a conexão com o banco de dados
            ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Script do Bootstrap -->

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"> <!-- Início do modal de exclusão -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5> <!-- Título do modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Botão para fechar o modal -->
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este item? <!-- Pergunta de confirmação -->
                    <form action="delete_item.php" method="post"> <!-- Formulário para enviar a exclusão -->
                        <input type="hidden" name="id" value="" id="deleteItemId"> <!-- Campo oculto para armazenar o ID do item -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> <!-- Botão para cancelar -->
                            <button type="submit" class="btn btn-danger">Excluir</button> <!-- Botão para confirmar a exclusão -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"> <!-- Início do modal de edição -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Item</h5> <!-- Título do modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Botão para fechar o modal -->
                </div>
                <div class="modal-body">
                    <form action="edit_item.php" method="post"> <!-- Formulário para enviar a edição -->
                        <input type="hidden" name="id" value="" id="editItemId"> <!-- Campo oculto para armazenar o ID do item -->
                        <div class="form-group">
                            <label>Nome do Item</label> <!-- Rótulo para o campo de nome -->
                            <input type="text" class="form-control" name="nome" value="" id="editItemName"> <!-- Campo de entrada para o nome do item -->
                        </div>
                        <div class="form-group">
                            <label>Valor</label> <!-- Rótulo para o campo de valor -->
                            <input type="text" class="form-control" name="valor" value="" id="editItemValue"> <!-- Campo de entrada para o valor do item -->
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label> <!-- Rótulo para o campo de quantidade -->
                            <input type="number" class="form-control" name="quantidade" value="" id="editItemQuantity"> <!-- Campo de entrada para a quantidade do item -->
                        </div>
                        <div class="form-group">
                            <label>Descrição</label> <!-- Rótulo para o campo de descrição -->
                            <textarea class="form-control" name="descricao" id="editItemDescription"></textarea> <!-- Área de texto para a descrição do item -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> <!-- Botão para cancelar -->
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button> <!-- Botão para salvar as alterações -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
