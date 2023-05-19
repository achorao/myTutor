<?php
namespace App\Models;
use CodeIgniter\Model;
class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; # db takes care of it
    protected $returnType = 'object'; # 'object' or 'array'
    protected $useSoftDeletes = false; # true if you expect to recover data
    # Fields that can be set during save, insert, or update methods
    protected $allowedFields = ['student_id', 'subject_id','ocupied','tutor_id',  'start_time', 'end_time'];
    protected $useTimestamps = false; # no timestamps on inserts and updates
    # Do not use validations rules (for the time being...)
    protected $validationRules = [];
    protected $validationMessages = [];
    
    

}