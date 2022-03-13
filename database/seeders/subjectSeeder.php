<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subjects = [
            "Bangla",
            "English",
            "Physics",
            "Chemistry",
            "Biology",
            "Math",
            "Accounting",
            "Finance",
            "Business Ent.",
            "Economics",
            "Civics",
            "Geography",
            "Social Science",
            "Islamic Religion",
            "ICT",
            "General Science"
        ];

        foreach($subjects as $subject)
        {
            $subjectModel = new Subject();
            $subjectModel->subject_name = $subject;
            $subjectModel->save();
        }
    }
}
