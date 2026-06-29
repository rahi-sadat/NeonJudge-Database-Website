<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   
    public function up(): void
    {
    
       DB::statement("
            CREATE TABLE users (
                id NUMBER(19, 0) PRIMARY KEY,
                handle VARCHAR2(32)  UNIQUE NOT NULL,
                email VARCHAR2(255) UNIQUE NOT NULL,
                password VARCHAR2(255) NOT NULL,
                role VARCHAR2(20)  DEFAULT 'user' NOT NULL,
                rating NUMBER(5, 0)  DEFAULT 0 NOT NULL,
                remember_token VARCHAR2(100),
                created_at TIMESTAMP,
                updated_at TIMESTAMP
            )
        ");

        DB::statement("
            CREATE SEQUENCE users_id_seq 
                START WITH 1 
                INCREMENT BY 1
        ");

    
        DB::statement("
            CREATE OR REPLACE TRIGGER users_id_trg
            BEFORE INSERT ON users
            FOR EACH ROW
            WHEN (new.id IS NULL)
            BEGIN
                SELECT users_id_seq.NEXTVAL INTO :new.id FROM dual;
            END;
        ");

       
        DB::statement("
            CREATE INDEX users_role_idx ON users (role)
        ");
    }

   
    public function down(): void
    {
        
        DB::statement("DROP TRIGGER users_id_trg");
        DB::statement("DROP TABLE users CASCADE CONSTRAINTS");
        DB::statement("DROP SEQUENCE users_id_seq");
    }
};