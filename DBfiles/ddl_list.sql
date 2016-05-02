SQL>  select dbms_metadata.get_ddl('TABLE','DEPT','SCOTT') from dual;
ERROR:
ORA-31603: object "DEPT" of type TABLE not found in schema "SCOTT"
ORA-06512: at "SYS.DBMS_METADATA", line 4018
ORA-06512: at "SYS.DBMS_METADATA", line 5843
ORA-06512: at line 1 



no rows selected

SQL>  select dbms_metadata.get_ddl('INDEX','DEPT_IDX','SCOTT') from dual;
ERROR:
ORA-31603: object "DEPT_IDX" of type INDEX not found in schema "SCOTT"
ORA-06512: at "SYS.DBMS_METADATA", line 4018
ORA-06512: at "SYS.DBMS_METADATA", line 5843
ORA-06512: at line 1 



no rows selected

SQL>  spool off;select dbms_metadata.get_ddl('TABLE', 'CATEGORY') from dual;
SP2-0768: Illegal SPOOL command
Usage: SPOOL { <file> | OFF | OUT }
where <file> is file_name[.ext] [CRE[ATE]|REP[LACE]|APP[END]]
SQL> 
SQL> exit
