<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'semester_id',
        'title',
        'scheduled_date',
        'research_type',
        'thesis_file',
        'manuscript_file',
        'presentation_video',
        'status',
        'invitation_email_sent',
        'invitation_email_sent_at',
        'final_score',
        'final_result',
        'bap_file',
        'bap_sent_at',
        'ruang',
        'thesis_similarity',
        'manuscript_similarity',
        'publication_status',
        'journal_name',
        'journal_rank',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function examiners()
    {
        return $this->hasMany(ThesisExaminer::class);
    }

    public function scores()
    {
        return $this->hasMany(RubricScore::class);
    }

    public function supervisorScore()
    {
        return $this->hasMany(SupervisorScore::class, 'thesis_id');
    }
    public function revisionNotes()
    {
        return $this->hasMany(ThesisRevisionNote::class);
    }
}
