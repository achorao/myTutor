<?php
namespace App\Models;
use CodeIgniter\Model;
class SubjectModel extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; # db takes care of it
    protected $returnType = 'object'; # 'object' or 'array'
    protected $useSoftDeletes = false; # true if you expect to recover data
    # Fields that can be set during save, insert, or update methods
    protected $allowedFields = ['name',  'description'];
    protected $useTimestamps = false; # no timestamps on inserts and updates
    # Do not use validations rules (for the time being...)
    protected $validationRules = [];
    protected $validationMessages = [];
    
    
}