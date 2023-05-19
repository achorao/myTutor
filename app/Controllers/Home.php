<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex()
    {

        $classModel = new \App\Models\ClassModel();
        $userModel = new \App\Models\UserModel();
        $subjectModel = new \App\Models\SubjectModel();

        $subjects = $subjectModel->findAll();
        $classes = $classModel->findAll();
        foreach ($subjects as $subject) {
            $tutor_subjects[$subject->name] = $subject->name;
        }
        $data["subjects"] = $subjects;
        foreach ($subjects as $subject) {
            $tutor_subjects[$subject->name] = array();
            foreach ($classes as $sclass) {
            
                if ($sclass->subject_id == $subject->name && $sclass->occupied == 0 ) {

                    $user = $userModel->find($sclass->tutor_id);
                    if ($user == null){
                        continue;
                    }
                    
                    array_push($tutor_subjects[$subject->name], $user);
                }
            }

        }
        $data["tutor_subjects"] = $tutor_subjects;
        echo view("templates/header", $data);
        echo view("templates/searchbar", $data);
        echo view('user_view/home', $data);
        echo view("templates/footer", $data);            
        
    }

}

