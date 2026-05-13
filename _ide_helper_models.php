<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $year_name
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereYearName($value)
 */
	class AcademicYear extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $thesis_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property string|null $room
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ScheduleParticipant> $participants
 * @property-read int|null $participants_count
 * @property-read \App\Models\Thesis $thesis
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereThesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefenseSchedule whereUpdatedAt($value)
 */
	class DefenseSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $thesis_id
 * @property string $final_score
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Thesis $thesis
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereFinalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereThesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinalScore whereUpdatedAt($value)
 */
	class FinalScore extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $nidn
 * @property string|null $type
 * @property string|null $bagian
 * @property string|null $strata
 * @property string|null $gelar
 * @property string|null $tipe_dosen
 * @property int|null $min_sks
 * @property int|null $max_sks
 * @property string|null $gender
 * @property string|null $faculty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LecturerAvailability> $availability
 * @property-read int|null $availability_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ThesisExaminer> $examiners
 * @property-read int|null $examiners_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RubricScore> $rubricScores
 * @property-read int|null $rubric_scores_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereBagian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereFaculty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereGelar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereMaxSks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereMinSks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereNidn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereStrata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereTipeDosen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereUserId($value)
 */
	class Lecturer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Lecturer|null $lecturer
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerAvailability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerAvailability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerAvailability query()
 */
	class LecturerAvailability extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereToken($value)
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $weight
 * @property string|null $parent_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RubricScore> $scores
 * @property-read int|null $scores_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereParentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereWeight($value)
 */
	class Rubric extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $thesis_id
 * @property int $lecturer_id
 * @property int $rubric_id
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecturer $lecturer
 * @property-read \App\Models\Rubric $rubric
 * @property-read \App\Models\Thesis $thesis
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereRubricId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereThesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricScore whereUpdatedAt($value)
 */
	class RubricScore extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $schedule_id
 * @property int $lecturer_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecturer $lecturer
 * @property-read \App\Models\DefenseSchedule $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScheduleParticipant whereUpdatedAt($value)
 */
	class ScheduleParticipant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $academic_year_id
 * @property string $semester_name
 * @property int|null $is_active
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereSemesterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereUpdatedAt($value)
 */
	class Semester extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $type
 * @property string $nim
 * @property string|null $gender
 * @property string|null $angkatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Thesis> $thesis
 * @property-read int|null $thesis_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAngkatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUserId($value)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $thesis_id
 * @property int $lecturer_id
 * @property int $score
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecturer $lecturer
 * @property-read \App\Models\Thesis $thesis
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereThesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorScore whereUpdatedAt($value)
 */
	class SupervisorScore extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $student_id
 * @property string $title
 * @property string $research_type
 * @property string|null $file_path
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ThesisExaminer> $examiners
 * @property-read int|null $examiners_count
 * @property-read \App\Models\FinalScore|null $finalScore
 * @property-read \App\Models\DefenseSchedule|null $schedule
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RubricScore> $scores
 * @property-read int|null $scores_count
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\SupervisorScore|null $supervisorScore
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereResearchType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thesis whereUpdatedAt($value)
 */
	class Thesis extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $thesis_id
 * @property int $lecturer_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecturer $lecturer
 * @property-read \App\Models\Thesis $thesis
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer query()
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereThesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThesisExaminer whereUpdatedAt($value)
 */
	class ThesisExaminer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $gender
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecturer|null $lecturer
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Student|null $student
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

