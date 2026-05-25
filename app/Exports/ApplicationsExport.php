<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Application::select(
            'application_number',
            'full_name',
            'phone',
            'gender',
            'dob',
            'address',
            'school',
            'qualification',
            'cgpa',
            'status',
            'admin_comment',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Application Number',
            'Full Name',
            'Phone',
            'Gender',
            'Date of Birth',
            'Address',
            'School',
            'Qualification',
            'CGPA',
            'Status',
            'Admin Comment',
            'Date Created',
        ];
    }
}