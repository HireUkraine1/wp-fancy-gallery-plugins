<?php

namespace WpFancyGallery\inc\DbClasses;
/**
 * Class WpFancyGalleryDbWorker
 *
 * Creating, updating and deleting galleries
 */
class WpFancyGalleryDbWorker extends WpFancyGalleryCommonDbClass
{
    protected $table;
    protected $fields;
    protected $idName = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->checkProperty();
        $this->setTable();
    }

    protected function setTable()
    {
        $this->table = $this->wpdb->get_blog_prefix() . $this->table;
    }

    public function checkProperty()
    {
        if (is_array($this->fields)
            || count($this->fields)
            || is_string($this->table)
        ) {
            return true;
        }
        die('pleasure init class property');
    }

    public function create(array $data)
    {
        $this->wpdb->insert($this->table, $data);

        return $this->wpdb->insert_id;
    }

    public function update($data)
    {
        $return_id = $data[$this->idName];
        $id = [$this->idName => $data[$this->idName]];
        unset($data[$this->idName]);
        $this->wpdb->update($this->table, $data, $id, '%s');

        return $return_id;
    }

    public function drop($id)
    {
        $this->wpdb->delete($this->table, array($this->idName => $id), array('%d'));
        return true;
    }
}
