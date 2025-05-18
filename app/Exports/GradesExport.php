<?php

namespace App\Exports;

use App\Models\Degree;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GradesExport implements FromCollection, WithHeadings
{
    protected $filteredGrades;

    // Constructor to accept the filtered grades
    public function __construct($filteredGrades)
    {
        $this->filteredGrades = $filteredGrades;
    }

    /**
     * Return a collection of grades to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->filteredGrades;
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Student Name',
            'Grade',
            'Classroom',
            'Section',
            'Teacher',
            'Month',
            'Year',
            'Term',
            'Score'
        ];
    }
}
