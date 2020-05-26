<?php
class ModelCatalogNew extends Model
{
    public function addNew($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "new SET new_id = '" . (int)$data['new_id'] . "', title = '" . $this->db->escape(strip_tags($data['title'])) . "', news = '" . (int)$data['news'] . "', author = '" . (int)$data['author'] . "', date = '" . $this->db->escape($data['date']) . "'");

        $new_id = $this->db->getLastId();

		$this->cache->delete('new');

		return $new_id;
	}

    public function editNew($new_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "', new_id = '" . (int)$data['new_id'] . "', title = '" . $this->db->escape(strip_tags($data['title'])) . "', news = '" . (int)$data['news'] . "', author = '" . (int)$data['author'] . "', date = '" . $this->db->escape($data['date']) . "' WHERE new_id = '" . (int)$new_id . "'");

		$this->cache->delete('new');
	}

	public function deleteNew($new_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "new WHERE new_id = '" . (int)$new_id . "'");

		$this->cache->delete('new');
    }
    
    public function getNews()
    {
		$sql = "SELECT * FROM " . DB_PREFIX . "new";
        
        $query = $this->db->query($sql);

		return $query->rows;
    }
}
