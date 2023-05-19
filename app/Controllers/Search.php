<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Search extends Controller
{
    public function postIndex()
    {
        // Validate and sanitize user input
        $validation = \Config\Services::validation();
        $searchTerm = $this->request->getPost('search', FILTER_SANITIZE_STRING);
        $userModel = new UserModel();
        $subjectModel = new \App\Models\SubjectModel();
        $classModel = new \App\Models\ClassModel();
        $filterdusers = $userModel->like('username', $searchTerm)->findAll();


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
                    
                    if (in_array($user, $filterdusers)){
                        $usersInSubject[$user->id] = $user;
                        array_push($tutor_subjects[$subject->name], $user);
                    }
                }
            }

        }
        $data["tutor_subjects"] = $tutor_subjects;
        
        return view('user_view/home', $data);
    }
}

