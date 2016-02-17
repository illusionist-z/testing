/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Kohei Iwasa <kiwasa@gnext.co.jp>
 * Created: Feb 3, 2016
 */

ALTER TABLE `core_member` ADD PRIMARY KEY( `member_id`);
ALTER TABLE `core_permission` CHANGE `permission_name_ja` `permission_name_jp` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;