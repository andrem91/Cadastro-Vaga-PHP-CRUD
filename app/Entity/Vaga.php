<?php

namespace App\Entity;

use App\Db\Database;

use \PDO;

class Vaga{

  /**
   * Identificador único da vaga
   * @var integer
   */
  public $id;

  /**
   * Título da vaga
   * @var string
   */
  public $titulo;

  /**
   * Descrição da vaga
   * @var string
   */
  public $descricao;

  /**
   * Define se a vaga está ativa
   * @var string(s/n)
   */
  public $ativo;

  /**
   * Data de publicacao da vaga
   * @var string
   */
  public $data;

  /**
   * Metodo responsável por cadastrar nova vaga no banco
   * @return boolean
   */
  public function cadastrar() {

    //Definir a data
    $this->data = date('Y-m-d H:i:s');

    //Inserir a vaga no banco
    $obDatabase = new Database('Vagas');
    $this->id = $obDatabase->insert([
      'titulo' => $this->titulo,
      'descricao' => $this->descricao,
      'ativo' => $this->ativo,
      'data' => $this->data
    ]);

    return true;
  }

  public function atualizar() {
    return (new Database('vagas'))->update('id = '.$this->id,
      [
        'titulo' => $this->titulo,
        'descricao' => $this->descricao,
        'ativo' => $this->ativo,
        'data' => $this->data
      ]
    );
  }

  public function excluir() {
    return (new Database('vagas'))->delete('id = '.$this->id);
  }

  public static function getVagas($where = null, $order = null, $limit = null) {
    return  (new Database('vagas'))->select($where,$order,$limit)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  public static function getVaga($id) {
    return (new Database('vagas'))->select('id = '.$id)
      ->fetchObject(self::class);
  }

}