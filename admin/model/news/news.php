<?php
class ModelCatalogNew extends Model
{
    public function addNew($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "new SET author = '" . $this->db->escape($data['author']) . "', new_id = '" . (int)$data['new_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = '" . $this->db->escape($data['date_added']) . "'");

        $new_id = $this->db->getLastId();

		$this->cache->delete('new');

		return $new_id;
	}

    public function edit()
    {
        
    }

    public function delete()
    {
        
    }
}
