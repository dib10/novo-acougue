<?php 
    include_once "../factory/conexao.php";

    class FuncionarioModel {
        private $conn;

        public function __construct($conexao) {
            $this->conn = $conexao->getConn();
        }

        public function inserirFuncionario($nome, $telefone, $email, $senha, $cargo, $foto) {
            $query = "INSERT INTO funcionarios (Nome, Telefone, Email, Senha, Cargo, Foto) VALUES (:nome, :telefone, :email, :senha, :cargo, :foto)";
            $inserir = $this->conn->prepare($query);
            $inserir->bindParam(':nome', $nome, PDO::PARAM_STR);
            $inserir->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $inserir->bindParam(':email', $email, PDO::PARAM_STR);
            $inserir->bindParam(':senha', $senha, PDO::PARAM_STR);
            $inserir->bindParam(':cargo', $cargo, PDO::PARAM_STR);
            $inserir->bindParam(':foto', $foto, PDO::PARAM_STR);
            try {
                $inserir->execute();
            } catch(PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        }

        public function listarTodos() {
            $query = "SELECT * FROM funcionarios";
            $selecaoTotal = $this->conn->prepare($query);
            $selecaoTotal->execute();
            return $selecaoTotal->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listarPorNome($nome) {
            $query = "SELECT * FROM funcionarios WHERE Nome=:nome";
            $selecaoPorNome = $this->conn->prepare($query);
            $selecaoPorNome->bindParam(':nome', $nome, PDO::PARAM_STR);
            $selecaoPorNome->execute();
            return $selecaoPorNome->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listarPorId($id) {
            $query = "SELECT * FROM funcionarios WHERE Id=:id";
            $selecaoPorId = $this->conn->prepare($query);
            $selecaoPorId->bindParam(':id', $id, PDO::PARAM_INT);
            $selecaoPorId->execute();
            return $selecaoPorId->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deletarFuncionario($id) {
            $query = "DELETE FROM funcionarios WHERE Id=:id";
            $deletar = $this->conn->prepare($query);
            $deletar->bindParam(':id', $id, PDO::PARAM_INT);
            $deletar->execute();
        }

        public function updateFuncionario($id, $nome, $telefone, $email, $senha, $cargo) {
            $query = "UPDATE funcionarios SET Nome=:nome, Telefone=:telefone, Email=:email, Senha=:senha, Cargo=:cargo WHERE Id=:id";
            $update = $this->conn->prepare($query);
            $update->bindParam(':id', $id, PDO::PARAM_INT);
            $update->bindParam(':nome', $nome, PDO::PARAM_STR);
            $update->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $update->bindParam(':email', $email, PDO::PARAM_STR);
            $update->bindParam(':senha', $senha, PDO::PARAM_STR);
            $update->bindParam(':cargo', $cargo, PDO::PARAM_STR);
            $update->execute();
        }
    }
?>
