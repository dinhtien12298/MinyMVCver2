<?php
    class SubjectModel extends Database
    {
        // Menu + API
        public function searchSubjectsOfClass($class)
        {
            $data = $this->fetchAllRecords("SELECT id, subject, class FROM subjects WHERE class='$class'");
            return $data;
        }

        // Footer
        public function fetchAllSubjects()
        {
            $data = $this->fetchAllRecords("SELECT id, subject, class FROM subjects");
            return $data;
        }

        // Homepage
        public function findSubjectsForButton($class)
        {
            $data = $this->fetchAllRecords("
                SELECT id, subject, class
                FROM subjects
                WHERE class = '$class' 
                LIMIT 4
            ");
            return $data;
        }

        // Category + API
        public function searchSubjectIdByClassAndSubject($class, $subject)
        {
            $data = $this->fetchARecord("
                SELECT id, subject, class
                FROM subjects
                WHERE subject = '$subject' AND class = '$class'
            ");
            return $data;
        }
    }