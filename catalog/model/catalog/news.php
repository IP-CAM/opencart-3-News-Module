<?php
class ModelCatalogNews extends Model
{
    public function getNews($id_news)
    {
        //EXECUTER REQUETE ->  DB_PREFIX option d'opencart il sera oc_
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news WHERE id_new = '" . $id_news . "'");

        //verifie tous les id si corespon donne l'id en question.
        if ($query->num_rows) {
            return $query->row;
        } else {
            return false;
        }
    }


    public function getAllNews()
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news ORDER BY date DESC");
        return $query->rows;
    }
}
