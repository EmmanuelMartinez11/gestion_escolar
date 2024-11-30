<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CourseStudentController;


Route::get('/', function () {
    return view('dashboard'); // Dashboard principal
});

// Rutas específicas para el reporte de profesores
Route::get('professors/report', [ProfessorController::class, 'generateReport'])->name('professors.report');
// Ruta para el reporte de estudiantes
Route::get('students/report', [StudentController::class, 'generateReport'])->name('students.report');


Route::get('commissions/report', [CommissionController::class, 'generateReport'])->name('commissions.report');


Route::get('courses/report', [CourseController::class, 'generateReport'])->name('courses.report');

// Rutas para Students
Route::resource('students', StudentController::class);

// Rutas para Subjects
Route::resource('subjects', SubjectController::class);

// Rutas para Courses
Route::resource('courses', CourseController::class);

// Rutas para Professors
Route::resource('professors', ProfessorController::class);

// Rutas para Commissions
Route::resource('commissions', CommissionController::class);

// Rutas para Course_Student (inscripciones)
Route::resource('course_students', CourseStudentController::class);


Route::get('/courses/subject/{subjectId}', [CourseStudentController::class, 'getCoursesBySubject']);
Route::get('/commissions/course/{courseId}', [CourseStudentController::class, 'getCommissionsByCourse']);
