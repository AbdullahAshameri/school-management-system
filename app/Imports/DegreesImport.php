<?php
namespace App\Imports;

use App\Models\Degree;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DegreesImport implements ToModel, WithHeadingRow
{
    protected $grade_id;
    protected $classroom_id;
    protected $section_id;
    protected $teacher_id;
    protected $month;
    protected $year;
    protected $term;
    protected $library_id;

    public function __construct($grade_id, $classroom_id, $section_id, $teacher_id, $month, $year, $term, $library_id)
    {
        $this->grade_id = $grade_id;
        $this->classroom_id = $classroom_id;
        $this->section_id = $section_id;
        $this->teacher_id = $teacher_id;
        $this->month = $month;
        $this->year = $year;
        $this->term = $term;
        $this->library_id = $library_id;

    }

    /**
     * Map the Excel data to the model.
     */
    public function model(array $row)
    {
        return new Degree([
            'student_id'   => $row['student_id'],
            'Grade_id'     => $this->grade_id,
            'Classroom_id' => $this->classroom_id,
            'section_id'   => $this->section_id,
            'library_id'   => $this->library_id,  // Make sure this column exists in your Excel file if needed
            'teacher_id'   => $this->teacher_id,
            'score'        => $row['score'],
            'type'         => 'شفوي',  // Optional, depending on your Excel structure
            'term'         => $this->term,
            'year'         => $this->year,
            'month'        => $this->month,
            'title'        => 'تم التقييم',
        ]);
    }

    
}
