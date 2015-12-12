<?php

namespace App\Classes\Databases\Queries;
use \PDO;

trait Query{
	protected $query;
	protected $resultSet;
	public function all($columns = array('*')){
		try {
			$this->query = $this->connection
								->prepare('SELECT ' . join($columns, ', ') . ' FROM ' . $this->table);

			$this->query->execute();

			$this->resultSet = $this->query->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->message);
		}
		return $this->resultSet;
	}

	public function find($id, $columns = array('*')){
		try {
			$this->query = $this->connection
								->prepare('SELECT ' . join($columns, ', ') . ' FROM ' . $this->table . ' WHERE id = :id');

				$this->query->execute([
									':id' => $id
									]);

				$this->resultSet = $this->query->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->message);
		}
		return $this->resultSet;
	}

	public function findBy($column, $value, $columns = array('*')){
		try {
			$this->query = $this->connection
								->prepare('SELECT ' . join($columns, ', ') . ' FROM ' . $this->table . ' WHERE ' . $column . ' = :' . $column);
			$this->query->execute([
							':'.$column => $value
				]);
			$this->resultSet = $this->query
									->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->message);
		}

		return $this->resultSet;
	}

	public function create($data = array()){
		$columns = [];
		$valueColumns = [];
		foreach(array_keys($data) as $key){
			$columns[] = $key . ' = :' . $key;
			$valueColumns[] = ':' . $key;
		}
		try {
			$this->query = $this->connection
								->prepare('INSERT INTO ' . $this->table . '(' . join(array_keys($data), ', ') . ') VALUES('. join($valueColumns, ', ') .')');

			$result = $this->query->execute(
						$data
				);
		} catch (Exception $e) {
			die($e->message);
		}
		return $result;
	}

	public function update($id, $data = array()){
		$columns = [];
		$valueColumns = [];
		foreach(array_keys($data) as $key){
			$columns[] = $key . ' = :' . $key;
			$valueColumns[] = ':' . $key;
		}
		try {
			$this->query = $this->connection
								->prepare('UPDATE ' . $this->table . ' SET ' . join($columns, ', ') . ' WHERE id = :id');

			$result = $this->query->execute(
						$data + ['id' => $id]
				);
		} catch (Exception $e) {
			die($e->message);
		}
		return $result;
	}

	public function delete($id){
		try {
			$this->query = $this->connection
								->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');

			$result = $this->query->execute([
						':id' => $id
				]);
		} catch (Exception $e) {
			die($e->message);
		}

		return $result;
	}
}
