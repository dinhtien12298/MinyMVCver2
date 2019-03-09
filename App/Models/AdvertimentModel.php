<?php
    class AdvertimentModel extends Database
    {
        // Sidebar
        public function findAllAdvertiments()
        {
            $data = $this->fetchAllRecords("SELECT id, link, title, image FROM advertiments");
            return $data;
        }
    }