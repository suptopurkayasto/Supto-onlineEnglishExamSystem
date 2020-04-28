<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\StudentGrammarQuestionExamGotMarks;
use App\Model\Marks\Marks;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        $authStudent = Auth::guard('student')->user();
        return view('student.dashboard')
            ->with('authStudent', $authStudent)
            ->with('exams', Exam::where('teacher_id', $authStudent->teacher->id)->get());
    }

    public function AnswerSheetShow($exam, $student)
    {
        if ($this->validAnswerSheetRequest($exam, $student)) {
            $examId = Crypt::decrypt($exam);
            $studentId = Crypt::decrypt($student);


            $authTeacher = Auth::guard('teacher')->user();

            $exam = Exam::all()->find($examId);
            $student = Student::all()->find($studentId);
            $marks = $student->marks()->where('exam_id', $examId)->first();

            // Grammar
            $grammars = $exam->grammars()->where('set_id', $student->set->id)->get();

            // Vocabulary
            $synonyms = $exam->synonyms()->where('set_id', $student->set->id)->get();
            $definitions = $exam->definitions()->where('set_id', $student->set->id)->get();
            $combinations = $exam->combinations()->where('set_id', $student->set->id)->get();
            $fillInTheGaps = $exam->fillInTheGaps()->where('set_id', $student->set->id)->get();

            // Reading
            $headings = $exam->headings()->where('set_id', $student->set->id)->get();
            $rearrange = $exam->rearranges()->where(['set_id' => $student->set->id])->get()->first();
            $studentRearrange = $exam->studentRearranges()->where(['set_id' => $student->set->id, 'student_id' => $studentId])->get()->first();

            // Writing
            $studentDialog = $exam->studentDialogs()->where(['student_id' => $studentId])->get()->first();
            $studentInformalEmail = $exam->studentInformalEmails()->where(['student_id' => $studentId])->get()->first();
            $studentFormalEmail = $exam->studentFormalEmails()->where(['student_id' => $studentId])->get()->first();
            $studentSortQuestions = $exam->studentSortQuestions()->where(['student_id' => $studentId])->get();

            return view('student.exam.show-answer-sheet')
                ->with('authTeacher', $authTeacher)
                ->with('exam', $exam)
                ->with('student', $student)
                ->with('marks', $marks)
                ->with('grammars', $grammars)
                ->with('synonyms', $synonyms)
                ->with('definitions', $definitions)
                ->with('combinations', $combinations)
                ->with('fillInTheGaps', $fillInTheGaps)
                ->with('headings', $headings)
                ->with('rearrange', $rearrange)
                ->with('studentRearrange', $studentRearrange)
                ->with('studentDialog', $studentDialog)
                ->with('studentInformalEmail', $studentInformalEmail)
                ->with('studentFormalEmail', $studentFormalEmail)
                ->with('studentSortQuestions', $studentSortQuestions);

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * @param $exam
     * @param $student
     * @return bool
     */
    private function validAnswerSheetRequest($exam, $student)
    {
        $authStudent = Auth::guard('student')->user();
        $examId = Crypt::decrypt($exam);
        $studentId = Crypt::decrypt($student);

        if ($authStudent->id === $studentId) {
            $marks = Marks::where(['exam_id' => $examId, 'student_id' => $studentId])->get()->first();

            $grammarMarksBoolean = $marks->grammar !== NULL;
            $vocabularyMarksBoolean = $marks->synonym !== NULL && $marks->definition !== NULL && $marks->combination !== NULL && $marks->fillInTheGap !== NULL;
            $readingMarksBoolean = $marks->heading !== NULL && $marks->rearrange !== NULL;
            $writingMarksBoolean = $marks->dialog !== NULL && $marks->informalEmail !== NULL && $marks->formalEmail !== NULL && $marks->sortQuestion !== NULL;

            $examDone = $grammarMarksBoolean && $vocabularyMarksBoolean && $readingMarksBoolean && $writingMarksBoolean;
            if ($examDone) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
}
