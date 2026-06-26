<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE TABLE users (
                id             NUMBER(19, 0) NOT NULL,
                handle         VARCHAR2(32) NOT NULL,
                email          VARCHAR2(255) NOT NULL,
                password       VARCHAR2(255) NOT NULL,
                role           VARCHAR2(20) DEFAULT 'user' NOT NULL,
                remember_token VARCHAR2(100),
                created_at     TIMESTAMP,
                updated_at     TIMESTAMP,
                CONSTRAINT users_id_pk PRIMARY KEY (id),
                CONSTRAINT users_handle_uk UNIQUE (handle),
                CONSTRAINT users_email_uk UNIQUE (email)
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

        DB::statement('CREATE INDEX users_role_idx ON users (role)');
    }

    public function down(): void
    {
        DB::statement("
            BEGIN
                EXECUTE IMMEDIATE 'DROP TRIGGER users_id_trg';
            EXCEPTION
                WHEN OTHERS THEN
                    IF SQLCODE != -4080 THEN
                        RAISE;
                    END IF;
            END;
        ");

        DB::statement("
            BEGIN
                EXECUTE IMMEDIATE 'DROP TABLE users CASCADE CONSTRAINTS';
            EXCEPTION
                WHEN OTHERS THEN
                    IF SQLCODE != -942 THEN
                        RAISE;
                    END IF;
            END;
        ");

        DB::statement("
            BEGIN
                EXECUTE IMMEDIATE 'DROP SEQUENCE users_id_seq';
            EXCEPTION
                WHEN OTHERS THEN
                    IF SQLCODE != -2289 THEN
                        RAISE;
                    END IF;
            END;
        ");
    }
};
