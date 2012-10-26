--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` int(11) NOT NULL,
  `last_message` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `log` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `action_id` int(50) NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=635 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `board_name` varchar(25) NOT NULL,
  `category` varchar(50) NOT NULL,
  `who_can_tag` varchar(25) NOT NULL,
  `collaborator` text NOT NULL,
  `board_title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `board_position` int(10) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=167 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`id`, `user_id`, `board_name`, `category`, `who_can_tag`, `collaborator`, `board_title`, `description`, `board_position`, `time_created`, `content`) VALUES
(167, 165, 'My collections', 'Agriculture', 'me', 'Name or Email Address', 'My collections', 'This is my collection', 0, '2012-10-18 06:24:39', '');
-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `pin_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `board_id` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE IF NOT EXISTS `category_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `field` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `field`, `name`) VALUES
(39, 'Agriculture', 'Agriculture');
-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `pin_id` int(25) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=363 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `base_url` text COLLATE utf8_unicode_ci NOT NULL,
  `encryption_key` text COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_id` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_key` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_secret` text COLLATE utf8_unicode_ci NOT NULL,
  `need_invite` int(10) NOT NULL,
  `tweet_consumer_key` text COLLATE utf8_unicode_ci NOT NULL,
  `tweet_consumer_secret` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `all` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_pins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `likes` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `repins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `follows` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `digest` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `news` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `is_following` int(25) NOT NULL,
  `is_following_board_id` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1131 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends_list`
--

CREATE TABLE IF NOT EXISTS `friends_list` (
  `user_id` int(25) NOT NULL,
  `friend_id` int(25) NOT NULL,
  `connect_by` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE IF NOT EXISTS `gift` (
  `pin_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `price` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `pin_id` int(25) NOT NULL,
  `source_user_id` int(25) NOT NULL,
  `like_user_id` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE IF NOT EXISTS `pins` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `board_id` int(25) NOT NULL,
  `pin_url` text NOT NULL,
  `source_url` text NOT NULL,
  `type` varchar(25) NOT NULL,
  `gift` int(75) NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=363 ;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`id`, `user_id`, `board_id`, `pin_url`, `source_url`, `type`, `gift`, `description`, `time`) VALUES
(363, 165, 167, 'http://staging.cubettech.com/cubetboard/application/assets/pins/165/1350540855_apple.png', '', 'image', 0, 'An expensive choice.', '2012-10-18 06:14:15'),
(364, 165, 167, 'http://staging.cubettech.com/cubetboard/application/assets/pins/165/1350540855_apple.png', '', 'image', 0, 'An expensive choice.', '2012-10-18 08:49:35'),
(365, 165, 167, 'http://staging.cubettech.com/cubetboard/application/assets/pins/165/1350552514_pineapple.jpg', '', 'image', 0, 'Pine Apple', '2012-10-18 09:28:34'),
(366, 165, 167, 'http://staging.cubettech.com/cubetboard/application/assets/pins/165/1350558569_.jpeg', 'http://www.espnstar.com/home/football/', 'image', 0, 'Lance Armstrong', '2012-10-18 11:09:29'),
(367, 165, 167, 'http://staging.cubettech.com/cubetboard/application/assets/pins/165/1350562848_.jpeg', 'https://www.google.co.in/', 'image', 0, 'Google', '2012-10-18 12:20:48');
-- --------------------------------------------------------

--
-- Table structure for table `repin`
--

CREATE TABLE IF NOT EXISTS `repin` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `repin_user_id` int(25) NOT NULL,
  `owner_user_id` int(25) NOT NULL,
  `from_pin_id` int(25) NOT NULL,
  `new_pin_id` int(25) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

INSERT INTO `repin` (`id`, `repin_user_id`, `owner_user_id`, `from_pin_id`, `new_pin_id`, `timestamp`) VALUES
(106, 165, 165, 363, 364, '2012-10-18 08:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `report_pins`
--

CREATE TABLE IF NOT EXISTS `report_pins` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `pin_id` int(25) NOT NULL,
  `board_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `facebook_id` text NOT NULL,
  `twitter_id` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `status` int(11) NOT NULL,
  `verification` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(25) NOT NULL,
  `image` text NOT NULL,
  `connect_by` varchar(25) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notifications` varchar(25) NOT NULL,
  `twitter_post` varchar(25) NOT NULL,
  `facebook_post` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

INSERT INTO `user` (`id`, `username`, `first_name`, `middle_name`, `last_name`, `facebook_id`, `twitter_id`, `password`, `email`, `status`, `verification`, `description`, `location`, `image`, `connect_by`, `time_created`, `time_updated`, `notifications`, `twitter_post`, `facebook_post`) VALUES
(165, '0', 'Web', '', 'Master', '', '', '3651d36e18102d2212db72a364b139b7', 'anoop@cubettech.com', 1, 'done', '', 'Cochin, Kerala', 'http://staging.cubettech.com/cubetboard/application/assets/images/YW5vb3BAY3ViZXR0ZWNoLmNvbQ==.png', 'normal', '2012-10-18 06:58:23', '0000-00-00 00:00:00', '', '0', '0');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gfc_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;