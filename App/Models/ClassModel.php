<?php
    class ClassModel extends Database
    {
        // Menu
        public function findAllClasses()
        {
            $data = $this->fetchAllRecords("SELECT id, class FROM classes");
            return $data;
        }
    }