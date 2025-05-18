<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('Grade_id')->constrained('Grades')->onDelete('cascade');
            $table->foreignId('Classroom_id')->constrained('Classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('library_id')->constrained('library')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
        
            $table->enum('type', ['تحريري', 'واجبات', 'شفوي', 'المواضبة']);
            $table->float('score');
            $table->enum('term', ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني']);
            $table->string('year');
            $table->enum('month', [
                'محرم', 'صفر', 'ربيع الأول', 'ربيع الآخر', 'جمادى الأول', 'جمادى الآخر',
                'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة'
            ]);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degrees');
    }
}
?>
