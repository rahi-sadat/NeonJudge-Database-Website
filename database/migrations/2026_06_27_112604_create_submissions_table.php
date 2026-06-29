<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
       
        DB::statement("
            CREATE TABLE submissions (
                id  NUMBER(19, 0) PRIMARY KEY,
                user_id  NUMBER(19, 0) REFERENCES users(id) ON DELETE CASCADE,
                problem_code VARCHAR2(30) NOT NULL,
                language_id  NUMBER(10, 0) NOT NULL,
                source_code CLOB NOT NULL,
                stdin  CLOB,
                expected_output CLOB,
                stdout CLOB,
                stderr CLOB,
                compile_output CLOB,
                status VARCHAR2(80) NOT NULL,
                judge_token  VARCHAR2(100),
                execution_time  NUMBER(8, 3),
                memory_used NUMBER(19, 0),
                created_at  TIMESTAMP,
                updated_at  TIMESTAMP
            )
        ");

     
        DB::statement("CREATE SEQUENCE submissions_id_seq START WITH 1 INCREMENT BY 1");

        DB::statement("
            CREATE OR REPLACE TRIGGER submissions_id_trg
            BEFORE INSERT ON submissions
            FOR EACH ROW
            WHEN (new.id IS NULL)
            BEGIN
                SELECT submissions_id_seq.NEXTVAL INTO :new.id FROM dual;
            END;
        ");

       
        DB::statement('CREATE INDEX submissions_user_problem_idx ON submissions (user_id, problem_code)');
        DB::statement('CREATE INDEX submissions_status_idx ON submissions (status)');
    }

    public function down(): void
    { 
        DB::statement("DROP TRIGGER submissions_id_trg");
        DB::statement("DROP TABLE submissions CASCADE CONSTRAINTS");
        DB::statement("DROP SEQUENCE submissions_id_seq");
    }
};