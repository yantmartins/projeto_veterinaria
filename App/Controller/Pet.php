<?php
require_once '../Model/Database.php';

class Pet{
    
    public int $id_pet;
    public string $nome;
    public string $especie;
    public string $raca;
    public int $dono_id;
    


    public function cadastrar() 
    {
        $db = new Database('Pet');

        $res = $db->insert(
            [
                'nome' => $this->nome,
                'especie' => $this->especie,
                'raca' => $this->raca
            ]
            );
        return $res;
    }       
        $sql = "INSERT INTO pets (nome, especie, raca, dono_id) VALUES (:nome, :especie, :raca, :dono_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(["nome" => $nome, "especie" => $especie, "raca" => $raca, "dono_id" => $dono_id]);

    public function buscar($where = null, $order = null, $limit = null)
    {
        $db = new Database('Pet');

        $res = $db->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
        return $res;
    }

    public function buscarPorId($id_pet){
        $db = new Database('Pet');
        $where = 'id_pet ='.$id_pet;
        $res = $db->select($where)->fetchObject(self::class);
        return $res;
    }

    public function atualizar(){
        $db = new Database('Pet');
        $res = $db->update('id_pet ='.$this->id_pet,
            [
                "nome" => $this.nome,
                "especie" => $this.especie,
                "raca" => $this.raca
            ]
        );
        return $res;
    }

    public function buscar_agendamentos($id_pet) {
        $db = new Database();
        $query = "SELECT  agendamentos.*, pets.nome AS pet FROM agendamentos INNER JOIN pets ON agendamentos.pet_id = pets.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id){
        $db = new Database('Pet');
        $where = 'id_pet = ' .intval($id);
        return $db->delete($where);
    }
}

?>