**Dumping table structure and data**
------------------------------------
mysqldump –-user root –-password=  attsys_db>attsys_db.sql

**Dumping only table structure**
----------------------------------
mysqldump -d --user root --password=  attsys_db>structure.sql

**Dumping structure and data for core**
-----------------------------------------
mysqldump --user root --password=  attsys_db core_action_log core_dept core_exports core_images core_lock_record core_lock_record core_member core_module core_permission core_permission_group core_permission_rel_dept core_permission_rel_member core_session>core.sql

**Dumping structure and data for master**
------------------------------------------
mysqldump --user root --password=  attsys_db allowances attendances calendar leaves salary_detail salary_master taxs>master.sql