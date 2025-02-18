<?php

class Database {
    private $conn;
    private string $host = "127.0.0.1";
    private string $db_name = "clinica_veterinaria";
    private string $username = "root";
    private string $password = "";
    private string $table;
    

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
        return $this->conn;
    }
}

class ClinicaVeterinaria {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    
    public function cadastrarCliente($nome, $telefone, $email) {
        $sql = "INSERT INTO clientes (nome, telefone, email) VALUES (:nome, :telefone, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["nome" => $nome, "telefone" => $telefone, "email" => $email]);
    }

    
    public function editarCliente($id, $nome, $telefone, $email) {
        $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id, "nome" => $nome, "telefone" => $telefone, "email" => $email]);
    }

    
    public function deletarCliente($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id]);
    }

    
    public function listarClientes() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    

    
    public function editarPet($id, $nome, $especie, $raca, $dono_id) {
        $sql = "UPDATE pets SET nome = :nome, especie = :especie, raca = :raca, dono_id = :dono_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id, "nome" => $nome, "especie" => $especie, "raca" => $raca, "dono_id" => $dono_id]);
    }

    
    public function deletarPet($id) {
        $sql = "DELETE FROM pets WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id]);
    }

    
    public function listarPets() {
        $sql = "SELECT pets.*, clientes.nome AS dono FROM pets INNER JOIN clientes ON pets.dono_id = clientes.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function cadastrarAgendamento($pet_id, $data, $hora, $descricao) {
        $sql = "INSERT INTO agendamentos (pet_id, data, hora, descricao) VALUES (:pet_id, :data, :hora, :descricao)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["pet_id" => $pet_id, "data" => $data, "hora" => $hora, "descricao" => $descricao]);
    }

    
    public function editarAgendamento($id, $pet_id, $data, $hora, $descricao) {
        $sql = "UPDATE agendamentos SET pet_id = :pet_id, data = :data, hora = :hora, descricao = :descricao WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id, "pet_id" => $pet_id, "data" => $data, "hora" => $hora, "descricao" => $descricao]);
    }

    
    public function deletarAgendamento($id) {
        $sql = "DELETE FROM agendamentos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["id" => $id]);
    }

    
    public function listarAgendamentos() {
        $sql = 
    }
}

?>
