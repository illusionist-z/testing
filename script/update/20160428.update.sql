ALTER TABLE `attendances` CHANGE `notes` `notes` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
DROP TABLE for_get_user
DROP TABLE forgot_password

CREATE TABLE IF NOT EXISTS `core_forgot_password` (
`ID` int(11) NOT NULL,
  `check_mail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `curdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

ALTER TABLE `core_forgot_password`
 ADD PRIMARY KEY (`ID`);

ALTER TABLE `core_forgot_password`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;