-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2016 at 05:08 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

set foreign_key_checks = 0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csit`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtn_album`
--

CREATE TABLE IF NOT EXISTS `dtn_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coverimage_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_16774FA8989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_16774FA8410045B8` (`coverimage_id`),
  KEY `IDX_16774FA8A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `dtn_album`
--

INSERT INTO `dtn_album` (`id`, `coverimage_id`, `user_id`, `name`, `slug`, `description`, `created`, `status`, `orderby`) VALUES
(20, 35, 1, 'Guest From America Participating Texas Techno ', 'guest-from-america-participating-texas-techno', 'Guest From America Participating Texas Techno', '2015-07-20 10:57:21', 'active', 3),
(21, 39, 1, 'MOU with Microsoft Company', 'mou-with-microsoft-company', 'MOU with Microsoft Company', '2015-07-22 10:52:39', 'active', 2),
(22, 40, 1, 'Academia Industry Tie Up', 'academia-industry-tie-up', 'Academia Industry Tie Up', '2015-07-22 10:53:30', 'active', 1),
(23, 41, 1, 'Miscellaneous', 'miscellaneous', 'Miscellaneous', '2015-07-30 08:00:43', 'active', 0),
(24, 49, 1, 'Blood Donation Program', 'blood-donation-program', 'Blood Donation Program', '2015-07-30 08:14:38', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_apply_to_faculty`
--

CREATE TABLE IF NOT EXISTS `dtn_apply_to_faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `address` longtext NOT NULL,
  `comments` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4A9B8885680CAB68` (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dtn_apply_to_faculty`
--

INSERT INTO `dtn_apply_to_faculty` (`id`, `faculty_id`, `name`, `email`, `phone`, `created`, `address`, `comments`, `status`, `orderby`) VALUES
(1, 1, 'test', 'test@dtn.com.np', '67689', '2015-08-14 06:59:13', 'ktm', 'test', 1, 0),
(2, 1, 'abc ', 'test@test.com', '12345678', '2015-08-14 07:00:28', 'sddsf', 'sdfsdf sdfsef sdffsdf ', 1, 0),
(3, 7, 'Test Institute', 'sucl@dtn.com.np', '57689', '2015-08-14 07:01:04', 'test', 'test', 1, 0),
(4, 6, 'hello', 'rimu@dtn.com.np', '56578', '2015-08-14 07:13:16', 'ktm', 'hello', 1, 0),
(6, 2, 'aaa', 'dsf@fg.com', '344545', '2015-09-02 13:54:17', 'fdgdfg', 'dfasdfsadf', 1, 0),
(7, 2, 'aaa', 'dsf@fg.com', '344545', '2015-09-02 14:01:01', 'fdgdfg', 'dfasdfsadf', 1, 0),
(8, 1, 'aaa', 'dsf@fg.com', '344545', '2015-09-02 14:03:56', 'fdgdfg', 'dfasdfsadf', 1, 0),
(9, 1, 'test', 'sucl@dtn.com.np', '014725836', '2015-09-03 08:03:37', 'ktm', 'test', 1, 0),
(10, 4, 'test', 'sucl@dtn.com.np', '014725836', '2015-09-03 08:03:59', 'ktm', 'test', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_college`
--

CREATE TABLE IF NOT EXISTS `dtn_college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created` datetime NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `university_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B399294309D1878` (`university_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtn_college`
--

INSERT INTO `dtn_college` (`id`, `name`, `email`, `description`, `created`, `address`, `contact`, `image`, `orderby`, `status`, `university_id`, `url`, `slug`) VALUES
(1, 'Texas International College', 'satish_rocky2@yahoo.com', 'Texas College', '2016-08-31 16:24:32', 'Sinamangal', '9803454045', 'texas.png', 0, 1, 1, 'www.texas.com.np', 'texas'),
(2, 'Bern Hardt College', 'silversatish2@gmail.com', 'hello world !!', '2016-08-31 16:26:47', 'koteshwor', '9803454045', 'bhd.png', 0, 1, 5, 'bhd.com.np', 'bern-hardt-college'),
(3, 'NCIT', 'info@ncit.com.np', 'Description', '2016-09-01 12:22:57', 'Balkumari', '0402631175', 'banner-home-011.jpg', 0, 1, 1, 'www.ncit.com.np', 'ncit');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_contactus`
--

CREATE TABLE IF NOT EXISTS `dtn_contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` longtext,
  `message` longtext,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_contactus`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_content`
--

CREATE TABLE IF NOT EXISTS `dtn_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `eventdate` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `orderby` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` longtext,
  `meta_description` longtext,
  `meta_keyword` longtext,
  `featured_banner` varchar(255) DEFAULT NULL,
  `showfront` int(11) NOT NULL,
  `updatenews` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F26253F989D9B62` (`slug`),
  KEY `IDX_F26253FA76ED395` (`user_id`),
  KEY `IDX_F26253F727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `dtn_content`
--

INSERT INTO `dtn_content` (`id`, `user_id`, `parent_id`, `title`, `body`, `type`, `slug`, `eventdate`, `status`, `created`, `updated`, `orderby`, `image`, `meta_title`, `meta_description`, `meta_keyword`, `featured_banner`, `showfront`, `updatenews`) VALUES
(4, 1, NULL, 'Profile', '<span style="line-height: 20.8px;">Orientation Program of Class XI Date: 2015-07-25 Time: 11 AM</span>', 'page', 'profile', '', 'active', '2015-07-10 06:32:43', '2016-09-01 10:46:10', 0, 'profile.jpg', '', '', '', NULL, 0, NULL),
(5, 1, NULL, 'Achievements', 'Achievements', 'page', 'achievements', '', 'active', '2015-07-10 06:33:29', '2015-07-10 06:33:29', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(6, 1, NULL, 'School', 'school', 'page', 'school', '', 'active', '2015-07-10 06:37:45', '2015-07-10 06:37:45', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(7, 1, NULL, '+ 2', '<div style="text-align: justify;">Texas Int&#39;l College, which has been running excellently under Texas Int&#39;l Education Network (2009), is a dynamic educational institution with outstanding academic programs (+2 Level) in Science, Management and Humanities faculties. Texas has been founded with a set of academicians and entrepreneurs to meet the rising demand for qualified and skilled manpower in the field of Management, Hotel Management, and Science and Technology. Since its very inception, Texas remains as an invitation to learning by both theory and practice.</div>\r\n<br />\r\nAdmission Open in +2 Program for Management, Science and Humanaties.<br />\r\n&nbsp;\r\n<p style="text-align:center"><img alt="" src="assets/upload/images/admission-plus2.jpg" style="height: 450px; width: 300px;" /></p>\r\n', 'page', '2', '', 'active', '2015-07-10 06:38:15', '2015-07-24 12:53:42', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(8, 1, NULL, 'College', 'college', 'page', 'college', '', 'active', '2015-07-10 06:38:47', '2015-07-10 06:38:47', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(9, 1, NULL, 'BBA', '<h4 style="text-align: justify;">BBA at Texas</h4>\r\n\r\n<div style="text-align: justify;">Texas BBA helps to build key theoretical concepts and significant current issues within Business Administration and prepare graduates for progressive career from middle and senior level managerial posts in both the private and public sectors. Texas BBA is a regular and full time 5 hours, 8 semesters, 129 credit hours program structured to garnish middle level managers Or, an entrepreneur.<br />\r\n<br />\r\n<strong>Bachelor of Business Administration (BBA)</strong><br />\r\n&nbsp;<br />\r\nThe Bachelor of Business Administration (BBA) programme was developed to reflect that the world of education is becoming increasingly global.&nbsp; The BBA program is designed for those desirous of pursuing&nbsp;a challenging career in business and innovation&nbsp;management. The students shall be trained in numerous&nbsp;disciplines, viz., marketing, accounting, entrepreneurship,&nbsp;business law, psychology and other indispensable skills&nbsp;considered essential to become a competent manager. It&nbsp;combines strong functional training with intensive exposure to&nbsp;communication skills, computer applications, plus other social&nbsp;sciences and applied sciences.<br />\r\n&nbsp;<br />\r\n<strong>Specifically the program aims to:</strong><br />\r\n&nbsp;<br />\r\n&bull; Equip students with well-developed analytical,&nbsp;conceptual, quantitative, and human skills.<br />\r\n&bull; Nurture positive attitude and self-confidence, ability to&nbsp;lead and work in teams and take responsibility and&nbsp;understanding of business ethics.<br />\r\n&bull; Nurture and develop professional communication skills in&nbsp;students.<br />\r\n&bull; Provide an opportunity to develop specific knowledge&nbsp;and skills in accordance with one&rsquo;s interest and talent.<br />\r\n&nbsp;</div>\r\n', 'page', 'bba', '', 'active', '2015-07-10 06:39:20', '2015-08-09 12:21:46', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(10, 1, NULL, 'Texas BBS', '<div style="text-align: justify;">Texas Int&rsquo;l College has recently introduced Bachelor of Business Studies (BBS) programme of three years, affiliated to Tribhuvan University. The students who have passed the PCL or + 2 in Commerce/Science or any equivalent course from any Board or University recognized by TU and has studied Mathematics or Economics as a full paper at the + 2 or equivalent level are eligible to apply. To strike a balance between the theoretical knowledge and practical applications, there will be the provision of trainings on banking and insurance, hospitality and catering management, health care management, corporate culture, among others.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Courses offered at BBS</h5>\r\n\r\n<table border="0" cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:232px;">First year</td>\r\n			<td style="width:232px;">Second year</td>\r\n			<td style="width:232px;">Third year</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:232px;">C. English</td>\r\n			<td style="width:232px;">Finance</td>\r\n			<td style="width:232px;">Courses based on area of specialization</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:232px;">Accountancy</td>\r\n			<td style="width:232px;">Accountancy</td>\r\n			<td style="width:232px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:232px;">Economics</td>\r\n			<td style="width:232px;">Marketing</td>\r\n			<td style="width:232px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:232px;">Principle of Management</td>\r\n			<td style="width:232px;">Business Law</td>\r\n			<td style="width:232px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:232px;">Statistics</td>\r\n			<td style="width:232px;">Human Resource Management<br />\r\n			&nbsp;</td>\r\n			<td style="width:232px;">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h4>&nbsp;</h4>\r\n\r\n<h5>Class Schedule</h5>\r\nMorning shift: 6.30 am- 10.15 am<br />\r\n&nbsp;\r\n<h5>Scholarships</h5>\r\n\r\n<table align="left" border="0" cellpadding="0" cellspacing="0" width="642">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:174px;"><strong>Achievement Category</strong></td>\r\n			<td style="width:216px;"><strong>Free in</strong><br />\r\n			<strong>Admission/ Annual Fees</strong></td>\r\n			<td style="width:126px;"><strong>Free in Monthly Fees</strong></td>\r\n			<td style="width:126px;"><strong>Quota</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">More than 80%</td>\r\n			<td style="width:216px;">100 %</td>\r\n			<td style="width:126px;">100 %</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">70 &ndash; 79.99 %</td>\r\n			<td style="width:216px;">75 %</td>\r\n			<td style="width:126px;">50%</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">65-69.99%</td>\r\n			<td style="width:216px;">50%</td>\r\n			<td style="width:126px;">50%</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">60-64.99%</td>\r\n			<td style="width:216px;">40%</td>\r\n			<td style="width:126px;">40%</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">55-59.99%</td>\r\n			<td style="width:216px;">30%</td>\r\n			<td style="width:126px;">30%</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:174px;">50-54.99%</td>\r\n			<td style="width:216px;">25%</td>\r\n			<td style="width:126px;">25%</td>\r\n			<td style="width:126px;">10</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'page', 'texas-bbs', '', 'active', '2015-07-10 06:39:45', '2015-07-24 12:33:13', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(11, 1, NULL, 'Social Service', '<div style="text-align: justify;">Texas encourages the dynamic modern youths to get intensively involved in various social and cultural works like blood donation, youth rehabilitation, cleaning campaign, awareness campaign, charity and donation that make them really humans</div>\r\n', 'page', 'social-service', '', 'active', '2015-07-10 06:40:51', '2015-07-17 09:16:59', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(12, 1, NULL, 'Scholarship', '<h4>Achievement Scholarships</h4>\r\n\r\n<table cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td valign="top" width="213">SLC Percent (%)</td>\r\n			<td valign="top" width="213">Admission off (%)</td>\r\n			<td valign="top" width="213">MF off (%)</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">Above 92</td>\r\n			<td colspan="2" valign="top" width="426">Special Extra-ordinary Performance Scholarships</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">90-91.99</td>\r\n			<td valign="top" width="213">100</td>\r\n			<td valign="top" width="213">100# special scholarships</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">85-89.99</td>\r\n			<td valign="top" width="213">100</td>\r\n			<td valign="top" width="213">100</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">80-84.99</td>\r\n			<td valign="top" width="213">75</td>\r\n			<td valign="top" width="213">60</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">75-79.99</td>\r\n			<td valign="top" width="213">60</td>\r\n			<td valign="top" width="213">50</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">70-74.99</td>\r\n			<td valign="top" width="213">50</td>\r\n			<td valign="top" width="213">40</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">65-69.99</td>\r\n			<td valign="top" width="213">40</td>\r\n			<td valign="top" width="213">30</td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top" width="213">60-64.99</td>\r\n			<td valign="top" width="213">30</td>\r\n			<td valign="top" width="213">30</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Note</strong>: Scholarships in Grades XI and XII will be awarded on the basis of the performance of the students in SLC and XI Exams, respectively.</p>\r\n\r\n<p><strong>Wow... plenty of scholarships!</strong></p>\r\n\r\n<ol>\r\n	<li>SLC Board Toppers&rsquo; Scholarships</li>\r\n	<li>SLC District Toppers&rsquo; Scholarships</li>\r\n	<li>Texas Entrance Toppers&rsquo; Scholarships</li>\r\n	<li>Martyr&rsquo;s family scholarships</li>\r\n	<li>Unprivileged and Remote Area Scholarships</li>\r\n	<li>School Toppers&rsquo; Scholarships</li>\r\n	<li>SLC Performance Scholarships</li>\r\n	<li>Poor and Intelligent Scholarships</li>\r\n	<li>Extraordinary Skill Scholarships, e.g. in music,&nbsp;sports</li>\r\n	<li>Except achievement category, Scholarships of all categories will be for one academic year only.</li>\r\n</ol>\r\n', 'page', 'scholarship', '', 'active', '2015-07-10 06:44:35', '2015-11-03 10:56:23', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(13, 1, NULL, 'Apply Online', 'Apply Online', 'page', 'apply-online', '', 'active', '2015-07-10 06:44:57', '2015-07-10 06:44:57', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(14, 1, NULL, 'Academic Calender', 'Academic Calender', 'page', 'academic-calender', '', 'active', '2015-07-10 06:45:39', '2015-07-10 06:45:39', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(16, 1, NULL, 'BIT', 'bit', 'page', 'bit', '', 'active', '2015-07-10 06:56:42', '2015-07-10 06:56:42', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(17, 1, NULL, 'About Texas', '<h5 style="text-align: justify;">What Texas is!</h5>\r\n\r\n<div style="text-align: justify;">Texas Int&#39;l College, which has been running excellently under Texas Int&#39;l Education Network (2009), is a dynamic educational institution with outstanding academic programs (+2 Level) in Science, Management and Humanities faculties. Texas has been founded with a set of academicians and entrepreneurs to meet the rising demand for qualified and skilled manpower in the field of Management, Hotel Management, and Science and Technology. Since its very inception, Texas remains as an invitation to learning by both theory and practice.<br />\r\n<br />\r\nTexas Int&#39;l College has also been running BBS, BSc (CSIT) programs (TU affiliate) to meet the demands in the field of Management and Information Technology. Moreover, Texas is going to launch A-Level (Cambridge University), BSc (Microbiology, TU) and BSc (Environment Science, TU), BSC (Geology, TU) from this year in the state-of-the-art educational complex, which is ideally located and is far from the polluting crowd. And, the programs in the pipeline, affiliated to National and International Universities, include BBA, BIT, MBA and BHM. BBA and MBA in Texas are Affiliated to Lincoln University (Malaysia). There are visiting professors, readers, lecturers and scholars in their respective fields who are attending the +2 and bachelor level classes with their up-dated knowledge.</div>\r\n\r\n<h5 style="text-align: justify;">Facilities</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Transportation through out the valley</li>\r\n	<li style="text-align: justify;">Sophisticated computer/science lab and rich library</li>\r\n	<li style="text-align: justify;">Free Internet access to the students</li>\r\n	<li style="text-align: justify;">Educational/HM/Biology excursions and tours and various sports activities</li>\r\n	<li style="text-align: justify;">Wide range of Scholarships on achievement and other categories</li>\r\n	<li style="text-align: justify;">Cafeteria with verities of foods</li>\r\n	<li style="text-align: justify;">Hostel with extra coaching classes</li>\r\n	<li style="text-align: justify;">Well furnished classes with CC camera in well ventilated rooms with fans</li>\r\n	<li style="text-align: justify;">Radio/TV station visit for the Mass Communication</li>\r\n</ul>\r\n\r\n<h5 style="text-align: justify;">Project Work and Field Visit</h5>\r\n\r\n<p style="text-align: justify;">To enhance both the theoretical and practical knowledge of the subject matter and the outer world, the college maximizes learning through project work, seminar and field visit.</p>\r\n\r\n<h5 style="text-align: justify;">Library</h5>\r\n\r\n<div style="text-align: justify;">The college is equipped with a rich library with plenty of reference materials, prescribed books and professional journals and magazines along with daily newspapers.</div>\r\n\r\n<h5 style="text-align: justify;">Labs</h5>\r\n\r\n<div style="text-align: justify;">Texas prides upon its well-equipped physics, chemistry, biology labs with availability of all required equipments. Moreover, the college feels proud of its spacious computer lab which has been facilitated with Internet connection to enable students accomplish their researches efficiently.</div>\r\n\r\n<h5 style="text-align: justify;">Assessments</h5>\r\n\r\n<div style="text-align: justify;">Regular internal assessment tests will be routinely conducted to find out the strengths and weaknesses of the students so that remedial teaching can be carried out to enhance individual potentiality. Those who become absent or fail in the exam are bound to pay the fine as per the college&rsquo;s rule and sit for the re-exam.</div>\r\n\r\n<h5 style="text-align: justify;">Sports and Cultural Programs</h5>\r\n\r\n<div style="text-align: justify;">Texas facilitates students to participate in a wide range of athletic activities including basket ball, volleyball, table-tennis, badminton, etc. Texas College also organizes various cultural programmes with the presence of national celebrities.</div>\r\n\r\n<h5 style="text-align: justify;">Transportation</h5>\r\n\r\n<div style="text-align: justify;">Texas provides easy and comfortable transportation facility to its students who wish to receive the college transportation facility.</div>\r\n\r\n<h5 style="text-align: justify;">Social Service</h5>\r\n\r\n<div style="text-align: justify;">Texas encourages the dynamic modern youths to get intensively involved in various social and cultural works like blood donation, youth rehabilitation, cleaning campaign, traffic awareness campaign, charity and donation that make them really humans</div>\r\n\r\n<h5 style="text-align: justify;">Appreciative Inquiry</h5>\r\n\r\n<div style="text-align: justify;">Texas focuses on the disciplined student with dignity. For this, special sessions on personality development and value education along with positive psychology will be conducted with the presence of renowned national and international experts.</div>\r\n', 'page', 'about-texas', '', 'active', '2015-07-10 12:14:27', '2015-08-03 07:26:56', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(28, 1, NULL, 'Admission Open in +2 Program for 2072', 'Admission Open in +2 Program for Management, Science and Humanaties<br />\r\n&nbsp;\r\n<p style="text-align:center"><img alt="" src="assets/upload/images/admission-plus2.jpg" style="width: 300px; height: 450px;" /></p>\r\n', 'article', 'admission-open-in-2-program-for-2072', '2015-07-17', 'active', '2015-07-17 08:31:50', '2016-09-01 11:38:07', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(29, 1, NULL, 'BSC CSIT 5th Semester MID-Term Examination Notice', '<h4 style="text-align: center;">Department of Computer Science &amp; IT</h4>\r\n&nbsp;\r\n\r\n<div style="text-align: right;"><strong><em>Date: - 2072-01-02</em></strong></div>\r\n<br />\r\nIt is notified to all the faculties and students of <strong>B.Sc.CSIT 5<sup>th</sup> Semester</strong> that the <strong><u>Mid-Term Exam</u></strong> to be held as per the following schedule.\r\n\r\n<table border="0" cellpadding="0" cellspacing="0" width="60%">\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan="2" style="width:16.94%;height:26px;"><strong>S.N.</strong></td>\r\n			<td rowspan="2" style="width:38.4%;height:26px;"><strong>Date</strong></td>\r\n			<td>&nbsp;</td>\r\n			<td height="26" style="height:26px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:44.64%;height:24px;">&nbsp;</td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:16.94%;height:24px;"><strong>1</strong></td>\r\n			<td style="width:38.4%;height:24px;"><strong>2072-01-13</strong></td>\r\n			<td style="width:44.64%;height:24px;"><strong>CN</strong></td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:16.94%;height:24px;"><strong>2</strong></td>\r\n			<td style="width:38.4%;height:24px;"><strong>2072-01-14</strong></td>\r\n			<td style="width:44.64%;height:24px;"><strong>AI</strong></td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:16.94%;height:24px;"><strong>3</strong></td>\r\n			<td style="width:38.4%;height:24px;"><strong>2072-01-15</strong></td>\r\n			<td style="width:44.64%;height:24px;"><strong>DAA</strong></td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:16.94%;height:24px;"><strong>4</strong></td>\r\n			<td style="width:38.4%;height:24px;"><strong>2072-01-16</strong></td>\r\n			<td style="width:44.64%;height:24px;"><strong>CP</strong></td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:16.94%;height:24px;"><strong>5</strong></td>\r\n			<td style="width:38.4%;height:24px;"><strong>2072-01-17</strong></td>\r\n			<td style="width:44.64%;height:24px;"><strong>S&amp;M</strong></td>\r\n			<td height="24" style="height:24px;">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />\r\n<strong>Note: - </strong>\r\n\r\n<ol>\r\n	<li>The Exam will Start From 7:00AM to 8:30 AM</li>\r\n	<li>All the faculties are requested to submit the softcopy of questionnaire (Two Sets of each Subject) as per the format and standard of TU before 10<sup>th</sup>&nbsp; of Baisakh 2072.</li>\r\n	<li>The Full Marks of Exam Paper will be 40.</li>\r\n</ol>\r\n&nbsp;\r\n\r\n<div style="text-align: right;"><strong>&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</strong><br />\r\n<strong>SHANKAR PD.SHARMA</strong><br />\r\n&nbsp;<br />\r\n<strong>HEAD, CSIT</strong></div>\r\n', 'article', 'bsc-csit-5th-semester-mid-term-examination-notice', '2015-07-17', 'active', '2015-07-17 08:35:53', '2016-09-01 11:38:07', 3, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(30, 1, NULL, 'Practical Examination Notice', '<h4 style="text-align: center;">Practical Examination Notice</h4>\r\n\r\n<h4 style="text-align: right;"><strong><strong><em>Date: - 2071-12-26</em></strong></strong></h4>\r\n\r\n<div style="text-align: justify;"><strong>It is notified to all the faculties and students of <strong>B.Sc.CSIT 1st&nbsp;Semesters</strong> that the <strong><u>Practical Examination</u></strong> is going to be held as per the following time and schedule.</strong></div>\r\n<strong><strong>Time: - 7:00am - onwards</strong> </strong>\r\n\r\n<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan="2" style="width:17.08%;height:24px;"><strong><strong>S.N.</strong></strong></td>\r\n			<td rowspan="2" style="width:38.42%;height:24px;"><strong><strong>Date</strong></strong></td>\r\n			<td style="width:44.5%;height:24px;"><strong><strong>&nbsp; SUB</strong></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:44.5%;height:24px;"><strong>&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:17.08%;height:24px;"><strong><strong>1</strong></strong></td>\r\n			<td style="width:38.42%;height:24px;"><strong><strong>2072-01-11</strong></strong></td>\r\n			<td style="width:44.5%;height:24px;"><strong><strong>STAT-I</strong></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:17.08%;height:24px;"><strong><strong>2</strong></strong></td>\r\n			<td style="width:38.42%;height:24px;"><strong><strong>2072-01-12</strong></strong></td>\r\n			<td style="width:44.5%;height:24px;"><strong><strong>Prob &amp; Stat</strong></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:17.08%;height:24px;"><strong><strong>3</strong></strong></td>\r\n			<td style="width:38.42%;height:24px;"><strong><strong>2072-01-13</strong></strong></td>\r\n			<td style="width:44.5%;height:24px;"><strong><strong>FIT</strong></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:17.08%;height:24px;"><strong><strong>4</strong></strong></td>\r\n			<td style="width:38.42%;height:24px;"><strong><strong>2072-01-14</strong></strong></td>\r\n			<td style="width:44.5%;height:24px;"><strong><strong>C</strong></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<strong> </strong>\r\n\r\n<div style="clear:both;"><strong>&nbsp;</strong></div>\r\n<br />\r\n<strong><strong>Note: - </strong> </strong>\r\n\r\n<ol>\r\n	<li><strong>&nbsp;All the Students are requested to present along with Lab Copy (Practical) and assignment of related subjects at the time of viva.</strong></li>\r\n	<li><strong>Must present with uniform and admit card.</strong></li>\r\n	<li><strong>Fully Prepare your board exam question answers</strong></li>\r\n	<li><strong><strong>2<sup>nd</sup> &nbsp;&nbsp;&nbsp;SEMESTER</strong> Classes will resume from 16<sup>th</sup> &nbsp;Baisakh &nbsp;2071 from 6:15am onwards.</strong></li>\r\n</ol>\r\n<strong> &nbsp;<br />\r\n&nbsp; </strong>\r\n\r\n<div style="text-align: right;"><strong><strong>&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</strong><br />\r\n<strong>Head, CSIT</strong></strong></div>\r\n<strong> </strong>', 'article', 'practical-examination-notice', '2015-07-17', 'active', '2015-07-17 09:03:11', '2016-09-01 11:38:07', 4, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(31, 1, NULL, 'Transportation', '<div style="text-align: justify;">Texas provides easy and comfortable transportation facility to its students who wish to receive the college transportation facility.&nbsp;<br />\r\n&nbsp;</div>\r\n', 'page', 'transportation', '', 'active', '2015-07-17 09:17:34', '2015-07-17 09:17:34', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(32, 1, NULL, 'Assements', '<div style="text-align: justify;">Regular internal assessment tests will be routinely conducted to find out the strengths and weaknesses of the students so that remedial teaching can be carried out to enhance individual potentiality.&nbsp;Those who become absent or fail in the exam are bound to pay the fine as per the college&rsquo;s rule and sit for the re-exam.</div>\r\n', 'page', 'assements', '', 'active', '2015-07-17 09:18:10', '2015-07-17 09:18:10', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(33, 1, NULL, 'Labs', '<div style="text-align: justify;">Texas prides upon its well-equipped physics, chemistry, biology labs with availability of all required equipments. Moreover, the college feels proud of its spacious IT lab which has been facilitated with Internet connection to enable students accomplish their researches efficiently.<br />\r\n&nbsp;</div>\r\n', 'page', 'labs', '', 'active', '2015-07-17 09:18:42', '2015-07-17 09:18:42', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(34, 1, NULL, 'Library', 'The college is equipped with a rich library with plenty of reference materials, prescribed books and professional journals and magazines along with daily newspapers.', 'page', 'library', '', 'active', '2015-07-17 09:19:46', '2015-07-17 09:19:46', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(35, 1, NULL, ' Project Work & Field Visit', 'To enhance both the theoretical and practical knowledge of the subject matter and the outer world, the college maximizes learning through project work, seminar and field visit.', 'page', 'project-work-field-visit', '', 'active', '2015-07-17 09:20:56', '2016-09-01 10:25:17', 0, 'project-work-field-visit.jpg', '', '', '', NULL, 0, NULL),
(36, 1, NULL, 'Texas features', '<h4>Collaborative pedagogical techniques&nbsp;</h4>\r\n\r\n<div>&bull; Caring, loving and supportive educational environment</div>\r\n\r\n<div>&bull; Inculcation of positive attitude&nbsp;</div>\r\n\r\n<div>&bull; Competent and co-operative faculties&nbsp;</div>\r\n\r\n<div>&bull; Comfortable and spacious classroom environment&nbsp;</div>\r\n\r\n<div>&bull; Sufficient playground with various sports events</div>\r\n\r\n<div>&bull; Additional coaching classes for the needy students</div>\r\n\r\n<div>&bull; Various scholarships based on quality &amp; need</div>\r\n\r\n<div>&bull; Well-equipped labs and resourceful library (strong commitment to update in the days to come as well)&nbsp;</div>\r\n\r\n<div>&bull; Several business and educational tours within an academic year</div>\r\n\r\n<div>&bull; The counseling for career development and abroad studies&nbsp;</div>\r\n\r\n<div>&bull; Provision of the guest lectures from the distinguished personalities</div>\r\n\r\n<div>&bull; Teaching using modern equipments</div>\r\n', 'page', 'texas-features', '', 'active', '2015-07-17 09:21:44', '2015-07-17 09:21:44', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(45, 1, NULL, 'MBA', '<h4 style="text-align: justify;">MBA at Texas</h4>\r\n\r\n<div style="text-align: justify;">Texas MBA acknowledges the broaden dimension and content of the different academic fields of Business Administration and suits for working professionals is a regular and full time 3 hours, 4 semesters, 70 credit hours program. It is equally competitive with the existent full-time courses within the domestic curricula which garnish the graduates in academic research, verbal argument and hone professional writing to become globally competitive at executive level or, to become a charismatic entrepreneur/ intrapreneur.</div>\r\n\r\n<h4 style="text-align: justify;"><br />\r\nMASTER OF BUSINESS ADMINISTRATION (MBA)</h4>\r\n\r\n<div style="text-align: justify;">The&nbsp;<strong>Master of Business Administration (MBA)</strong>&nbsp;course&nbsp;offered by&nbsp;<strong>Lincoln University</strong>&nbsp;focuses on the development&nbsp;of the self-reflective mindset, the analytic mindset, the&nbsp;collaborative mindset, the worldly mindset and the action&nbsp;mindset of the graduates. The&nbsp;MBA&nbsp;course is designed for&nbsp;mid-career professionals, whose careers and&nbsp;management responsibilities transcend a single functional&nbsp;specialty and require a broad array of specialized&nbsp;knowledge and skills. The emphasis of this&nbsp;interdisciplinary, integrated and applied program is on&nbsp;the significant organizational as well as management&nbsp;processes of the public or private institutions doing&nbsp;business on a global scale.<br />\r\n<br />\r\n<strong>PROGRAM OBJECTIVE</strong><br />\r\n&nbsp;<br />\r\nThe aim of the program is to prepare the students for senior&nbsp;management, executive-level positions and entrepreneurs as it helps&nbsp;them to acquire managerial competencies including critical thinking&nbsp;skills, systems thinking skills, team building skills, decision-making skills&nbsp;and ethical leadership skills, required for managing the affairs of a&nbsp;business enterprise. An MBA degree would prove to be beneficial for&nbsp;those, who work in senior managerial and executive positions in business organizations. An MBA program offers a range of benefits&nbsp;for the successful applicants, including:<br />\r\n&nbsp;<br />\r\n<strong>Business Knowledge:</strong><br />\r\nThe MBA program educates the students about&nbsp;business and all its related aspects. Students also gain an&nbsp;understanding of the business strategies, business concepts and&nbsp;business skills.<br />\r\n&nbsp;<br />\r\n<strong>Leadership Abilities:</strong><br />\r\nAn MBA program includes rigorous training&nbsp;sessions, assignments, presentations, group projects and discussions.&nbsp;Students thus acquire the essential skills, which will help them to&nbsp;administer the business affairs, in the professional field.&nbsp;Networking: The alliances that the students form with fellow students&nbsp;and the network that the students build up, is deemed as one of the&nbsp;most important and valuable aspects of an MBA program.<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n<strong>MBA at Texas</strong></div>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Expanded Leadership Development and Engaging Experiential Learning</li>\r\n	<li style="text-align: justify;">Networking Opportunities and Employer Information Sessions</li>\r\n	<li style="text-align: justify;">Mentorship</li>\r\n	<li style="text-align: justify;">Case Competitions</li>\r\n	<li style="text-align: justify;">Career Fairs</li>\r\n	<li style="text-align: justify;">Career Advancement Assistance</li>\r\n	<li style="text-align: justify;">Embracing a Global Approach</li>\r\n	<li style="text-align: justify;">Unique and Customizable Concentrations</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;"><br />\r\n<br />\r\n<br />\r\n&nbsp;</div>\r\n', 'page', 'mba', '', 'active', '2015-07-22 07:08:36', '2015-08-09 12:21:18', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(46, 1, NULL, 'Orientation Program of Class XI', 'Orientation Program of Class XI Date: 2015-07-25 Time: 11 AM', 'article', 'orientation-program-of-class-xi', '2015-07-25', 'active', '2015-07-23 07:22:13', '2016-09-01 10:18:44', 0, 'orientation-program-of-class-xi.jpg', '', '', '', NULL, 0, NULL),
(47, 1, NULL, 'Participation in Sports week', 'Sport week is going to start from 9th of Shrawan to 16th of Shrawan so all the students of all faculties +2 and bachelor are noticed to participate in the program.', 'article', 'participation-in-sports-week', '25-07-2015', 'active', '2015-07-23 07:25:09', '2016-09-01 10:18:15', 0, 'participation-in-sports-week.jpg', '', '', '', NULL, 0, NULL),
(49, 1, NULL, 'Facilities', '<h5>Collaborative pedagogical techniques</h5>\r\n\r\n<ul>\r\n	<li>Caring, loving and supportive educational environment</li>\r\n	<li>Inculcation of positive attitude</li>\r\n	<li>Competent and co-operative faculties</li>\r\n	<li>Comfortable and spacious classroom environment</li>\r\n	<li>Sufficient playground with various sports events</li>\r\n	<li>Additional coaching classes for the needy students</li>\r\n	<li>Various scholarships based on quality &amp; need</li>\r\n	<li>Well-equipped labs and resourceful library (strong commitment to update in the days to come as well)</li>\r\n	<li>Several business and educational tours within an academic year</li>\r\n	<li>The counseling for career development and abroad studies</li>\r\n	<li>Provision of the guest lectures from the distinguished personalities</li>\r\n	<li>Teaching using modern equipments</li>\r\n</ul>\r\n', 'article', 'facilities', '2015-07-24', 'active', '2015-07-24 11:29:17', '2015-07-30 08:20:13', 2, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(50, 1, NULL, ' Texas and F1 soft Signed Academia Industry Tie-Up', '<img alt="" src="assets/upload/images/achievements.jpg" style="width: 246px; height: 400px; float: right; margin: 1px;" />F1 Soft International, a company renowned for its contribution in creative products and transaction banking has commenced collabration with Texas Int&#39;l College. The agreement between the&nbsp;institutes&nbsp;states that F1 Soft will provide professional training session to every students of Texas International and moreover, it will also guarantee job&nbsp;opportunities&nbsp;for students with basic salary Rs.25000&nbsp;', 'article', 'texas-and-f1-soft-signed-academia-industry-tie-up', '2015-07-24', 'active', '2015-07-24 12:07:46', '2016-09-01 11:33:12', 0, 'texas-and-f1-soft-signed-academia-industry-tie-up.jpg', '', '', '', NULL, 0, NULL);
INSERT INTO `dtn_content` (`id`, `user_id`, `parent_id`, `title`, `body`, `type`, `slug`, `eventdate`, `status`, `created`, `updated`, `orderby`, `image`, `meta_title`, `meta_description`, `meta_keyword`, `featured_banner`, `showfront`, `updatenews`) VALUES
(51, 1, NULL, 'BBA/MBA', '<h5 style="text-align: justify;">About Lincoln University College</h5>\r\n\r\n<div style="text-align: justify;">Lincoln University&nbsp;(Malaysia) was founded in the year 2002, in collaboration with&nbsp;Lincoln&nbsp;Educational Network&nbsp;and other international universities namely: The&nbsp;University of Hertfordshire, U.K,&nbsp;The&nbsp;University of Cambridge, U.K.,&nbsp;The Hagga&ndash;Hella (University of Applied Science) Finland,&nbsp;University of London, The&nbsp;University of Huddersfield, the UK,&nbsp;Saint Louis University, the US,&nbsp;Presbyterian University, Ghana,&nbsp;Tribhuvan University, Nepal and Southeast University, the US. The&nbsp;university is accredited by Malaysian Qualification Agency (MQA) and Ministry of Higher Education,&nbsp;Malaysia. The degrees offered by Lincoln are globally accredited, valid and its credits are&nbsp;internationally transferable.&nbsp;Since its inception, Lincoln has been offering diversified programs including diploma/certificate&nbsp;level courses to PhD degrees in the disciplines of Business, Hospitality Management, Engineering, IT,&nbsp;Medicine, Nursing, and allied health services.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Texas College of Management (TCM)</h5>\r\n\r\n<div style="text-align: justify;">Texas College of Management&nbsp;(TCM), under&nbsp;Texas Int&#39;l Education Network&nbsp;(2009), is&nbsp;a dynamic educational institution with outstanding academic programs&nbsp;BBA&nbsp;and&nbsp;MBA,&nbsp;affiliated to world recognized Lincoln University, Malaysia. Texas has been founded with a&nbsp;set of academicians and entrepreneurs to meet the rising demand for qualified and skilled&nbsp;manpower in the field of Management, Science and Technology. Since its very inception,&nbsp;Texas remains as an invitation to learning by both theory and practice.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Vision Statement</h5>\r\n\r\n<div style="text-align: justify;"><strong><em>&lsquo;To be partner of educational excellence in global community&rsquo;.</em></strong><br />\r\n<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Mission</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Being a truly international business school</li>\r\n	<li style="text-align: justify;">The excellence of our learning experience</li>\r\n	<li style="text-align: justify;">World-class research and thinking</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">MBA &amp; BBA AT A GLANCE</h5>\r\n\r\n<div style="text-align: justify;">The Master in Business Administration (MBA) and Bachelors in Business Administration (BBA) course is offered by Lincoln University College (LUC) through its learning center. The Lincoln University College (LUC) MBA &amp; BBA is focused to have graduates who have developed the self-reflective mindset, the analytic mindset, the collaborative mindset, the worldly mindset and the action mindset.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">MBA at Texas</h5>\r\n\r\n<div style="text-align: justify;">Texas MBA acknowledges the broaden dimension and content of the different academic fields of Business Administration and suits for working professionals is a regular and full time 3 hours, 4 semesters, 70 credit hours program. It is equally competitive with the existent full-time courses within the domestic curricula which garnish the graduates in academic research, verbal argument and hone professional writing to become globally competitive at executive level or, to become a charismatic entrepreneur/ intrapreneur.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">BBA at Texas</h5>\r\n\r\n<div style="text-align: justify;">Texas BBA helps to build key theoretical concepts and significant current issues within Business Administration and prepare graduates for progressive career from middle and senior level managerial posts in both the private and public sectors. Texas BBA is a regular and full time 5 hours, 8 semesters, 129 credit hours program structured to garnish middle level managers Or, an entrepreneur.<br />\r\n&nbsp;</div>\r\n\r\n<h4 style="text-align: justify;">PROGRAMME OBJECTIVES</h4>\r\n\r\n<h5 style="text-align: justify;">The objectives of the MBA &amp; BBA course are aimed at:</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Creating the skills and abilities required to provide strong leadership and management in a complex global and changing business environment by providing students with an understanding of the management disciplines of accounting &amp; finance, marketing and managing people. Elective subjects can further extend this knowledge base to accommodate student interest and vocational needs.</li>\r\n	<li style="text-align: justify;">Offering opportunities to explore modern aspects of Business Administration not previously encountered and to broaden aspects that were covered in previous studies.</li>\r\n	<li style="text-align: justify;">Developing a keen appreciation of some key theoretical concepts, major economic themes and significant current issues surrounding Business Administration.</li>\r\n	<li style="text-align: justify;">Providing opportunities for a practical appreciation and application of the Business Administration perspective for businesses in the Asian region.</li>\r\n	<li style="text-align: justify;">Developing an awareness of the professional context in which graduates with Business Administration credentials may find employment.</li>\r\n	<li style="text-align: justify;">Assisting students to further develop personal skills in critical thinking, bibliography, analysis, verbal argument and professional writing.&nbsp;</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Bachelor of Business Administration (BBA)</h5>\r\n\r\n<div style="text-align: justify;">The Bachelor of Business Administration (BBA) programme was developed to reflect that the world of education is becoming increasingly global.&nbsp; The BBA program is designed for those desirous of pursuing&nbsp;a challenging career in business and innovation&nbsp;management. The students shall be trained in numerous&nbsp;disciplines, viz., marketing, accounting, entrepreneurship,&nbsp;business law, psychology and other indispensable skills&nbsp;considered essential to become a competent manager. It&nbsp;combines strong functional training with intensive exposure to&nbsp;communication skills, computer applications, plus other social&nbsp;sciences and applied sciences.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Specifically the program aims to:</h5>\r\n\r\n<div style="text-align: justify;">&bull; Equip students with well-developed analytical,&nbsp;conceptual, quantitative, and human skills.<br />\r\n&bull; Nurture positive attitude and self-confidence, ability to&nbsp;lead and work in teams and take responsibility and&nbsp;understanding of business ethics.<br />\r\n&bull; Nurture and develop professional communication skills in&nbsp;students.<br />\r\n&bull; Provide an opportunity to develop specific knowledge&nbsp;and skills in accordance with one&rsquo;s interest and talent.&nbsp;<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">MASTER OF BUSINESS ADMINISTRATION (MBA)</h5>\r\n\r\n<div style="text-align: justify;">The<strong>&nbsp;Master of Business Administration (MBA)&nbsp;</strong>course&nbsp;offered by<strong>&nbsp;Lincoln University&nbsp;</strong>focuses on the development&nbsp;of the self-reflective mindset, the analytic mindset, the&nbsp;collaborative mindset, the worldly mindset and the action&nbsp;mindset of the graduates. The&nbsp;MBA&nbsp;course is designed for&nbsp;mid-career professionals, whose careers and&nbsp;management responsibilities transcend a single functional&nbsp;specialty and require a broad array of specialized&nbsp;knowledge and skills. The emphasis of this&nbsp;interdisciplinary, integrated and applied program is on&nbsp;the significant organizational as well as management&nbsp;processes of the public or private institutions doing&nbsp;business on a global scale.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">PROGRAM OBJECTIVE</h5>\r\n\r\n<div style="text-align: justify;">The aim of the program is to prepare the students for senior&nbsp;management, executive-level positions and entrepreneurs as it helps&nbsp;them to acquire managerial competencies including critical thinking&nbsp;skills, systems thinking skills, team building skills, decision-making skills&nbsp;and ethical leadership skills, required for managing the affairs of a&nbsp;business enterprise. An MBA degree would prove to be beneficial for&nbsp;those, who work in senior managerial and executive positions in business organizations. An MBA program offers a range of benefits&nbsp;for the successful applicants, including:</div>\r\n\r\n<h5 style="text-align: justify;">Business Knowledge:</h5>\r\n\r\n<div style="text-align: justify;">The MBA program educates the students about&nbsp;business and all its related aspects. Students also gain an&nbsp;understanding of the business strategies, business concepts and&nbsp;business skills.</div>\r\n\r\n<h5 style="text-align: justify;">Leadership Abilities:</h5>\r\n\r\n<div style="text-align: justify;">An MBA program includes rigorous training&nbsp;sessions, assignments, presentations, group projects and discussions.&nbsp;Students thus acquire the essential skills, which will help them to&nbsp;administer the business affairs, in the professional field.&nbsp;Networking: The alliances that the students form with fellow students&nbsp;and the network that the students build up, is deemed as one of the&nbsp;most important and valuable aspects of an MBA program.<br />\r\n&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">MBA at Texas</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Expanded Leadership Development and Engaging Experiential Learning</li>\r\n	<li style="text-align: justify;">Networking Opportunities and Employer Information Sessions</li>\r\n	<li style="text-align: justify;">Mentorship</li>\r\n	<li style="text-align: justify;">Case Competitions</li>\r\n	<li style="text-align: justify;">Career Fairs</li>\r\n	<li style="text-align: justify;">Career Advancement Assistance</li>\r\n	<li style="text-align: justify;">Embracing a Global Approach</li>\r\n	<li style="text-align: justify;">Unique and Customizable Concentrations</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Department of student affairs (DSA)</h5>\r\n\r\n<div style="text-align: justify;">From&nbsp;<a href="http://orientation.colorado.edu/">orientation</a>, where you&#39;ll learn how to navigate your way through your first weeks and months at Texas, all the way through graduation and even beyond, student affairs plays an integral role in student success.&nbsp; Student Affairs is a diverse department of professionals focused on creating a positive environment that fosters successful learning and personal development, both inside and outside the traditional classroom. Student Affairs provides programs and services that support the optimal growth of Texas students, enhance their intellectual, social, cultural, moral and leadership development, and complement Texas&rsquo;s academic excellence by providing opportunities for students to experience education and explore interests beyond the classroom. <em>Our purpose is to:</em></div>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Graduate with integrity and purpose, focused on near term goals and capable of adjusting to both opportunity and adversity;</li>\r\n	<li style="text-align: justify;">Care about themselves and others; and</li>\r\n	<li style="text-align: justify;">Develop the skills and judgment to navigate their journeys, both individually and collectively.</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\nThe departments of the Division of Student Affairs meet the academic and co-curricular needs of students. The office provides leadership in the development of services and programs that enrich student life, extend and enhance the academic experience, and contribute to an environment that encourages personal growth and development. Student Affairs is a department of professionals who are dedicated to the social, psychological, ethical and cognitive development and wellbeing of all Texas students. DSA works under following divisions:</div>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Pre and Post Counseling &amp; Physiological Services</li>\r\n	<li style="text-align: justify;">Student Conduct</li>\r\n	<li style="text-align: justify;">Grievance Handling and Services</li>\r\n	<li style="text-align: justify;">Performance Evaluation</li>\r\n	<li style="text-align: justify;">Peer Circle Division</li>\r\n	<li style="text-align: justify;"><a href="http://www.dowhatmatters.umn.edu/" target="_blank">Office for Student Engagement</a></li>\r\n	<li style="text-align: justify;"><a href="http://www.scr.umn.edu/" target="_blank">Student and Community Relations</a></li>\r\n	<li style="text-align: justify;"><strong>Career Center&nbsp;</strong></li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<div>\r\n<h4 style="text-align: justify;">Department of Entrepreneurship &amp; Job - Placement</h4>\r\n</div>\r\n\r\n<div style="text-align: justify;">The Job Placement Cell at TCM is a department that works to establish and foster a wide range of corporate relations with the reputed business houses in Nepal that make room for internship or/and job placement of our MBA/BBA graduates whenever needed. The department is premised on the idea that business knowledge not put in application through internship programs or other kinds of empirical learning will fail to produce business leaders with real business acumen and expertise. It is in sync with this belief then that this department is devoted to exploring the best career opportunities available for the TCM graduates who pride in their international degrees, and competence that is beyond match.<br />\r\n<br />\r\nThe TCM team at this department comprises friendly professionals who deliver their specialist input into this cause of the Cell for the welfare of the TCM graduates. We are also proud to be associated with numerous esteemed media and corporate houses in Nepal for placement and internship arrangements. Besides, we cannot be happier as we further contemplate signing of MOUs with more corporate houses so as to increase the prospects of student employability in near future.</div>\r\n\r\n<h5 style="text-align: justify;">Teaching Pedagogies at Texas</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Coursework and Assignments</li>\r\n	<li style="text-align: justify;">Audio and Visual Tutorial</li>\r\n	<li style="text-align: justify;">Quizzes</li>\r\n	<li style="text-align: justify;">Individual and Group Presentation and Talk Program</li>\r\n	<li style="text-align: justify;">Group and Peer/Pair Discussion</li>\r\n	<li style="text-align: justify;">Field visit and study</li>\r\n	<li style="text-align: justify;">Guest Lectures &amp; Information Session</li>\r\n	<li style="text-align: justify;">Workshops and Funshops</li>\r\n	<li style="text-align: justify;">Conferences and Seminars</li>\r\n	<li style="text-align: justify;">Lincoln Learning Centre</li>\r\n	<li style="text-align: justify;">Knowledge Corridor</li>\r\n	<li style="text-align: justify;">Reviews of Articles/ Journals and others</li>\r\n	<li style="text-align: justify;">Training and Development</li>\r\n	<li style="text-align: justify;">Report Writing and Term Paper</li>\r\n	<li style="text-align: justify;">Capstone Projects/ Writings</li>\r\n	<li style="text-align: justify;">Case Studies</li>\r\n	<li style="text-align: justify;">Symposium</li>\r\n	<li style="text-align: justify;">Research and Project Based Work</li>\r\n	<li style="text-align: justify;">Internships and Placements</li>\r\n	<li style="text-align: justify;">Thesis Writing/Dissertation</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Key features of the program:</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Internationally accredited</li>\r\n	<li style="text-align: justify;">Approved by Ministry of Education</li>\r\n	<li style="text-align: justify;">T.U equivalent</li>\r\n	<li style="text-align: justify;">Credit transfer system</li>\r\n	<li style="text-align: justify;">Blending of global teaching pedagogies</li>\r\n	<li style="text-align: justify;">Internship - domestic and global</li>\r\n	<li style="text-align: justify;">State of art classroom environment</li>\r\n	<li style="text-align: justify;">Backed up by enriched library</li>\r\n	<li style="text-align: justify;">Regular corporate academia interactions</li>\r\n	<li style="text-align: justify;">Job placement</li>\r\n	<li style="text-align: justify;">Inbuilt for professional and regular</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\n&nbsp;</div>\r\n\r\n<h4 style="text-align: center;">Texas College of Management<br />\r\nCourses Offered<br />\r\nBBA_Fall 2014</h4>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\n&nbsp;<br />\r\nDuration: 4 years/ 8 semesters</div>\r\n\r\n<table border="0" cellpadding="0" cellspacing="0" width="642">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;"><strong>No</strong></td>\r\n			<td style="width: 259px; text-align: justify;"><strong>Subject Name</strong></td>\r\n			<td style="width: 100px; text-align: justify;"><strong>Subject Code</strong></td>\r\n			<td style="width: 127px; text-align: justify;"><strong>Subject Status</strong></td>\r\n			<td style="width: 116px; text-align: justify;"><strong>Credit Hours</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR I</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 1</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business English I</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1113</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Principle of Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1133</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Microeconomics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2413</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Introduction to Accounting</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1143</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Fundamental of Computer Principles &amp; Programming</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1153</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 2</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Human Resource Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1213</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Principles of Marketing</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1223</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Internet Fundamental &amp; Applications</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1233</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Macroeconomics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2553</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Business English II</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1253</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR II</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 3</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business Organization</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1313</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Quantitative Methods (Statistics)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2523</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Business Communication</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1123</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Product &amp; Operation Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 643</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Entrepreneurship</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1243</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 4</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business Law</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1323</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Project Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2423</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Introduction to Financial Accounting</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2433</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Company Law</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2453</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Psychology</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3763</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR III</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 5</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">International Business Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2543</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Marketing Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3733</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Business Ethics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2513</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Sociology</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1263</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Management Information System</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2533</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 6</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">E- Commerce</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2463</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Organizational Behavior</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2633</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Consumer Behavior</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2443</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Strategic Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3813</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Innovation Management for Global Competitiveness</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3823</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR IV</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 7</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Retail Management (RM)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3713</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Event Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3723</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Target Economic Region</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3753</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Business Research Methods</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3843</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">TQM and Six Sigma (TSS)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3833</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 8</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Marketing Research</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3853</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Multinational Enterprise</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3863</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Logistics &amp; Supply Chain Management (LSCM)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3743</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Bachelor&rsquo;s Thesis on Internship (Internship Project)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3913</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">6</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>TOTAL CREDIT HOURS</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">120+9(optional)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\n<strong>NOTE: Optional Courses will be informed later</strong><br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;</div>\r\n\r\n<h4 style="text-align: center;">Texas College of Management Courses Offered<br />\r\nBBA_Fall 2014</h4>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\n&nbsp;<br />\r\nDuration: 4 years/ 8 semesters</div>\r\n\r\n<table border="0" cellpadding="0" cellspacing="0" width="642">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;"><strong>No</strong></td>\r\n			<td style="width: 259px; text-align: justify;"><strong>Subject Name</strong></td>\r\n			<td style="width: 100px; text-align: justify;"><strong>Subject Code</strong></td>\r\n			<td style="width: 127px; text-align: justify;"><strong>Subject Status</strong></td>\r\n			<td style="width: 116px; text-align: justify;"><strong>Credit Hours</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR I</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 1</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business English I</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1113</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Principle of Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1133</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Microeconomics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2413</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Introduction to Accounting</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1143</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Fundamental of Computer Principles &amp; Programming</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1153</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 2</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Human Resource Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1213</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Principles of Marketing</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1223</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Internet Fundamental &amp; Applications</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1233</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Macroeconomics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2553</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Business English II</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1253</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR II</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 3</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business Organization</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1313</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Quantitative Methods (Statistics)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2523</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Business Communication</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1123</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Product &amp; Operation Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 643</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Entrepreneurship</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1243</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 4</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Business Law</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1323</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Project Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2423</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Introduction to Financial Accounting</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2433</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Company Law</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2453</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Psychology</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3763</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR III</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 5</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">International Business Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2543</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Marketing Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3733</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Business Ethics</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2513</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Sociology</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 1263</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Management Information System</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2533</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 6</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">E- Commerce</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2463</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Organizational Behavior</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2633</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Consumer Behavior</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 2443</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Strategic Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3813</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">Innovation Management for Global Competitiveness</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3823</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>YEAR IV</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 7</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Retail Management (RM)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3713</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Event Management</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3723</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Target Economic Region</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3753</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Business Research Methods</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3843</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">5</td>\r\n			<td style="width: 259px; text-align: justify;">TQM and Six Sigma (TSS)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3833</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong><em>Semester 8</em></strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">1</td>\r\n			<td style="width: 259px; text-align: justify;">Marketing Research</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3853</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">2</td>\r\n			<td style="width: 259px; text-align: justify;">Multinational Enterprise</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3863</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">3</td>\r\n			<td style="width: 259px; text-align: justify;">Logistics &amp; Supply Chain Management (LSCM)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3743</td>\r\n			<td style="width: 127px; text-align: justify;">MINOR</td>\r\n			<td style="width: 116px; text-align: justify;">3</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">4</td>\r\n			<td style="width: 259px; text-align: justify;">Bachelor&rsquo;s Thesis on Internship (Internship Project)</td>\r\n			<td style="width: 100px; text-align: justify;">BBA 3913</td>\r\n			<td style="width: 127px; text-align: justify;">MAJOR</td>\r\n			<td style="width: 116px; text-align: justify;">6</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">15</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width: 40px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 259px; text-align: justify;"><strong>TOTAL CREDIT HOURS</strong></td>\r\n			<td style="width: 100px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 127px; text-align: justify;">&nbsp;</td>\r\n			<td style="width: 116px; text-align: justify;">120+9(optional)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div style="text-align: justify;">&nbsp;<br />\r\n<strong>NOTE: Optional Courses will be informed later</strong></div>\r\n', 'page', 'bba-mba', '', 'active', '2015-07-24 12:28:22', '2015-07-24 12:41:11', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL);
INSERT INTO `dtn_content` (`id`, `user_id`, `parent_id`, `title`, `body`, `type`, `slug`, `eventdate`, `status`, `created`, `updated`, `orderby`, `image`, `meta_title`, `meta_description`, `meta_keyword`, `featured_banner`, `showfront`, `updatenews`) VALUES
(52, 1, NULL, ' BSC(CSIT)', '<h4 style="text-align: justify;">Bachelors of Science in Computer Science and Information Technology (B.Sc. CSIT)</h4>\r\n\r\n<p style="text-align: justify;"><br />\r\n<strong>Affiliation</strong>: Tribhuvan University</p>\r\n\r\n<p style="text-align: justify;"><strong>Faculty</strong>: Institute of Science and Technology</p>\r\n\r\n<p style="text-align: justify;"><strong>Duration</strong>: 4 years</p>\r\n\r\n<p style="text-align: justify;"><strong>System</strong>: Semester System</p>\r\n\r\n<p style="text-align: justify;"><strong>Evaluation</strong>: Percentage Basis<br />\r\n&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Course Introduction</h5>\r\n\r\n<p style="text-align: justify;">Bachelors of Science in Computer Science and Information Technology (B.Sc. CSIT) is a four year course affiliated to Tribhuvan University designed to provide the students with all sorts of knowledge in the field of Information Technology and Computing.</p>\r\n\r\n<p style="text-align: justify;">The program involves, in addition to conventional lectures, a great&nbsp; deal of practical and project works. The program develops the underlying principles of both Computer Science and Information Technology and shows how these principles can be applied into the real world problems. This program develops the skills that are essential for both computer professionals and IT specialists.</p>\r\n\r\n<p style="text-align: justify;">The design and implementation of B.Sc. CSIT course offers new challenges when compared to the traditional computing environment. The recent emergence of global business, new technologies for data processing and data communication / networking environment, equip specialized science graduates to focus on professional careers in Information Technology. B.Sc. CSIT course provides the students with adequate theoretical and practical knowledge which will enable students to effectively participate in solving the complex problem of the IT industry.</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Mission of the Course</h5>\r\n\r\n<p style="text-align: justify;">The mission of the B.Sc. CSIT course is to prepare the students to pursue career advancement in the field of information technology. At the completion of this degree, a student will be able to design the real world e-media products or create technical solutions to hardware and software problems, depending on the chosen area and electives.</p>\r\n\r\n<h5 style="text-align: justify;">However, the main aim of the B.Sc. CSIT program can be enlisted as:</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">To offer intensive knowledge in the field of theory, design, programming and application of computers.</li>\r\n	<li style="text-align: justify;">Providing an in-depth understanding and experience with computer systems.</li>\r\n	<li style="text-align: justify;">Developing creative and analytical skills that provides a basis for technical problem-solving.</li>\r\n	<li style="text-align: justify;">Equipping students with the technical knowledge required for an IT professionals to handle multi-tasking and multi-programming situations and to assess and develop computer based solutions.</li>\r\n	<li style="text-align: justify;">Imparting knowledge of computer and programming logic environment in IT.</li>\r\n	<li style="text-align: justify;">Knowledge of advanced IT applications in different business sectors.</li>\r\n	<li style="text-align: justify;">To provide intensive cognition in the field of functional knowledge of hardware system and the necessary knowledge of computer software system.</li>\r\n</ul>\r\n\r\n<div style="text-align: justify;">&nbsp;</div>\r\n\r\n<h5 style="text-align: justify;">Salient Features of the Course</h5>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">In addition to conventional lectures, a great deal of practical and project works.</li>\r\n	<li style="text-align: justify;">Develops the underlying principles of both Computer Science and Information Technology and shows how these principles can be applied to solve real world problems.</li>\r\n	<li style="text-align: justify;">Builds up the skills that are essential for both computer professionals and researchers including IT managers, Systems Analysts, Network Administrator, Computer Programmers, Database Administrator, Web Developers, etc.</li>\r\n	<li style="text-align: justify;">Semester based program affiliated to Tribhuvan University.</li>\r\n</ul>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Eligibility to Study</h5>\r\n\r\n<p style="text-align: justify;"><strong>The candidate applying for B.Sc. CSIT program:</strong></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Should have successfully completed a twelve year of schooling in the science stream or equivalent from any university, board or institution recognized by TU.</li>\r\n	<li style="text-align: justify;">Should have secured a minimum of second division in their +2 or equivalent.</li>\r\n	<li style="text-align: justify;">Should have successfully passed the entrance examination conducted by TU securing at least 35% marks.</li>\r\n	<li style="text-align: justify;">Compiled with all the application procedures.</li>\r\n</ul>\r\n\r\n<p style="text-align: justify;">&raquo;&raquo; All three: Biology, Physical and Computer group students of +2 level are eligible to apply for the course.</p>\r\n\r\n<p style="text-align: justify;">&raquo;&raquo; A student eligible to study the B.Sc. CSIT course should collect and submit the admission form from any of the B.Sc. CSIT colleges. The admission form generally opens during Shrawan or Bhadra every year.</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Curricular Structure</h5>\r\n\r\n<p style="text-align: justify;">The B.Sc. CSIT curriculum is designed by closely following the course practiced in accredited international universities and institutions, subject to the condition that the intake students are from twelve year of schooling in the science stream or equivalent from any university recognized by Tribhuvan University. In addition to the core computer science course and elective courses, the program offers service course to meet the need of high technology applications. The foundation and allied courses are designed to meet the need of undergraduate academic program requirements, and the service course are designed to meet the need of market demand and fast changing computer technology and application. Students enrolled in the four year B.Sc. CSIT program are required to take course in design and implementations of computer software systems, information technology and foundation of the theoretical model of computer science and functional background of computer hardware. All students are required to complete a minimum of 126 credit hours of computer science and allied courses.</p>\r\n\r\n<h5 style="text-align: justify;">B.Sc. CSIT program comprises of the following courses:</h5>\r\n\r\n<table border="0" cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">Credit Hours</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Computer Science Core Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">75</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Natural Science Elective Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">6</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Mathematics Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">12</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">English Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">3</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Social Science &amp; Management Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">6</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Computer Science Elective Courses</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">15</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Internship and Project</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">9</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align: justify;">Total Credit hours</p>\r\n			</td>\r\n			<td>\r\n			<p style="text-align: justify;">126</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Grading System</h5>\r\n\r\n<p style="text-align: justify;">The score of the students is evaluated on the basis of the percentage secured in the subjects. The grading system is maintained on the foundation of the percentage secured and is accompanied as follows:</p>\r\n\r\n<div>\r\n<ul>\r\n	<li style="text-align: justify;">Distinction: 80% and above.</li>\r\n	<li style="text-align: justify;">First Division: 70% and above.</li>\r\n	<li style="text-align: justify;">Second Division: 55% and above.</li>\r\n	<li style="text-align: justify;">To Pass: At least 40% of the marks must be secured.</li>\r\n</ul>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<h5 style="text-align: justify;">Job Prospectives</h5>\r\n\r\n<p style="text-align: justify;">B.Sc. CSIT graduates have a prosperous career opportunity at different government, non-government, private and public organizations, software companies, telecommunications, computer networking companies etc. especially as a:</p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;">Software Developer</li>\r\n	<li style="text-align: justify;">Web Developer</li>\r\n	<li style="text-align: justify;">Network Administrator</li>\r\n	<li style="text-align: justify;">Database Administrator</li>\r\n	<li style="text-align: justify;">IT Manager/Officer</li>\r\n	<li style="text-align: justify;">Cryptographer</li>\r\n	<li style="text-align: justify;">Ergonomics Program Designer</li>\r\n	<li style="text-align: justify;">System Analyst</li>\r\n	<li style="text-align: justify;">Project Manager</li>\r\n	<li style="text-align: justify;">Document Specialist</li>\r\n	<li style="text-align: justify;">Information System Auditor</li>\r\n	<li style="text-align: justify;">Artificial Intelligence Specialist</li>\r\n	<li style="text-align: justify;">Technical Writer</li>\r\n	<li style="text-align: justify;">Information System Manager</li>\r\n	<li style="text-align: justify;">Database Operator</li>\r\n</ul>\r\n</div>\r\n', 'page', 'bsc-csit', '', 'active', '2015-07-24 12:31:49', '2015-08-09 11:39:26', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(53, 1, NULL, ' BSW', 'Texas Internatinal college under the management of Texas International Education Network is launching BSW (Bachelor in Social Work) in affilation with Tribhuwan University&nbsp;', 'page', 'bsw', '', 'active', '2015-07-24 12:33:54', '2015-08-09 12:22:01', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(54, 1, NULL, 'MBS', 'MBS', 'page', 'mbs', '', 'active', '2015-07-24 12:44:47', '2016-08-31 17:52:34', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(55, 1, NULL, 'Mid Term Result of CSIT III Published', '<div style="text-align: justify;">BSC CSIT III semester Mid Term Result has been published on 2071-12-25. Stutents are requested to collect result from your respected department.</div>\r\n', 'article', 'mid-term-result-of-csit-iii-published', '24-07-2015', 'active', '2015-07-24 13:14:11', '2016-09-01 11:38:07', 5, NULL, NULL, NULL, NULL, NULL, 0, 1),
(58, 1, NULL, 'test', 'sdfsdf', 'page', 'test', '', 'active', '2015-10-09 12:57:02', '2016-08-31 17:51:40', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(59, 1, NULL, 'test', 'test', 'article', 'test-1', '14-10-2015', 'active', '2015-10-09 12:57:47', '2016-09-01 11:38:07', 1, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_content_meta`
--

CREATE TABLE IF NOT EXISTS `dtn_content_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `IDX_CE71EAEF84A0A3ED` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_content_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_country`
--

CREATE TABLE IF NOT EXISTS `dtn_country` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `short_name` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `domain` char(3) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=252 ;

--
-- Dumping data for table `dtn_country`
--

INSERT INTO `dtn_country` (`id`, `name`, `short_name`, `domain`) VALUES
(1, 'Algeria', '', ''),
(2, 'American Samoa', '', ''),
(3, 'Andorra', '', ''),
(4, 'Angola', '', ''),
(5, 'Anguilla', '', ''),
(6, 'Antarctica', '', ''),
(7, 'Antigua and Barbuda', '', ''),
(8, 'Argentina', '', ''),
(9, 'Armenia', '', ''),
(10, 'Aruba', '', ''),
(11, 'Australia', '', ''),
(12, 'Austria', '', ''),
(13, 'Azerbaijan', '', ''),
(14, 'Bahamas', '', ''),
(15, 'Bahrain', '', ''),
(16, 'Bangladesh', '', ''),
(17, 'Barbados', '', ''),
(18, 'Belarus', '', ''),
(19, 'Belgium', '', ''),
(20, 'Belize', '', ''),
(21, 'Benin', '', ''),
(22, 'Bermuda', '', ''),
(23, 'Bhutan', '', ''),
(24, 'Bolivia', '', ''),
(25, 'Bosnia and Herzegowina', '', ''),
(26, 'Botswana', '', ''),
(27, 'Bouvet Island', '', ''),
(28, 'Brazil', '', ''),
(29, 'British Indian Ocean Territory', '', ''),
(30, 'Brunei Darussalam', '', ''),
(31, 'Bulgaria', '', ''),
(32, 'Burkina Faso', '', ''),
(33, 'Burundi', '', ''),
(34, 'Cambodia', '', ''),
(35, 'Cameroon', '', ''),
(36, 'Canada', '', ''),
(37, 'Cape Verde', '', ''),
(38, 'Cayman Islands', '', ''),
(39, 'Central African Republic', '', ''),
(40, 'Chad', '', ''),
(41, 'Chile', '', ''),
(42, 'China', '', ''),
(43, 'Christmas Island', '', ''),
(44, 'Cocos (Keeling) Islands', '', ''),
(45, 'Colombia', '', ''),
(46, 'Comoros', '', ''),
(47, 'Congo', '', ''),
(48, 'Cook Islands', '', ''),
(49, 'Costa Rica', '', ''),
(50, 'Cote D&acute; Ivoire', '', ''),
(51, 'Croatia', '', ''),
(52, 'Cuba', '', ''),
(53, 'Cyprus', '', ''),
(54, 'Czech Republic', '', ''),
(55, 'Denmark', '', ''),
(56, 'Djibouti', '', ''),
(57, 'Dominica', '', ''),
(58, 'Dominican Republic', '', ''),
(59, 'East Timor', '', ''),
(60, 'Ecuador', '', ''),
(61, 'Egypt', '', ''),
(62, 'El Salvador', '', ''),
(63, 'Equatorial Guinea', '', ''),
(64, 'Eritrea', '', ''),
(65, 'Estonia', '', ''),
(66, 'Ethiopia', '', ''),
(67, 'Falkland Islands (Malvinas)', '', ''),
(68, 'Faroe Islands', '', ''),
(69, 'Fiji', '', ''),
(70, 'Finland', '', ''),
(71, 'France', '', ''),
(72, 'France, Metropolitan', '', ''),
(73, 'French Guiana', '', ''),
(74, 'French Polynesia', '', ''),
(75, 'French Southern Territories', '', ''),
(76, 'Gabon', '', ''),
(77, 'Gambia', '', ''),
(78, 'Georgia', '', ''),
(79, 'Germany', '', ''),
(80, 'Ghana', '', ''),
(81, 'Gibraltar', '', ''),
(82, 'Greece', '', ''),
(83, 'Greenland', '', ''),
(84, 'Grenada', '', ''),
(85, 'Guadeloupe', '', ''),
(86, 'Guam', '', ''),
(87, 'Guatemala', '', ''),
(88, 'Guinea', '', ''),
(89, 'Guinea-bissau', '', ''),
(90, 'Guyana (British)', '', ''),
(91, 'Haiti', '', ''),
(92, 'Honduras', '', ''),
(93, 'Heard and Mc Donald Islands', '', ''),
(94, 'Hong Kong', '', ''),
(95, 'Hungary', '', ''),
(96, 'Iceland', '', ''),
(97, 'India', '', ''),
(98, 'Indonesia', '', ''),
(99, 'Iran (Islamic Republic of)', '', ''),
(100, 'Iraq', '', ''),
(101, 'Ireland', '', ''),
(102, 'Israel', '', ''),
(103, 'Italy', '', ''),
(104, 'Jamaica', '', ''),
(105, 'Japan', '', ''),
(106, 'Jersey', '', ''),
(107, 'Kazakhstan', '', ''),
(108, 'Kenya', '', ''),
(109, 'Kiribati', '', ''),
(110, 'Korea, North', '', ''),
(111, 'Korea, South', '', ''),
(112, 'Kyrgyzstan', '', ''),
(113, 'Kuwait', '', ''),
(114, 'Lao People&acute;s Democratic Republic', '', ''),
(115, 'Lebanon', '', ''),
(116, 'Latvia', '', ''),
(117, 'Lesotho', '', ''),
(118, 'Liberia', '', ''),
(119, 'Libyan Arab Jamahiriya', '', ''),
(120, 'Liechtenstein', '', ''),
(121, 'Lithuania', '', ''),
(122, 'Luxembourg', '', ''),
(123, 'Macau', '', ''),
(124, 'Macedonia, The Former Yugoslav Republic of', '', ''),
(125, 'Madagascar', '', ''),
(126, 'Malawi', '', ''),
(127, 'Malaysia', '', ''),
(128, 'Maldives', '', ''),
(129, 'Mali', '', ''),
(130, 'Malta', '', ''),
(131, 'Marshall Islands', '', ''),
(132, 'Martinique', '', ''),
(133, 'Mauritania', '', ''),
(134, 'Mauritius', '', ''),
(135, 'Mayotte', '', ''),
(136, 'Mexico', '', ''),
(137, 'Micronesia, Federated States of', '', ''),
(138, 'Moldova, Republic of', '', ''),
(139, 'Monaco', '', ''),
(140, 'Mongolia', '', ''),
(141, 'Montserrat', '', ''),
(142, 'Morocco', '', ''),
(143, 'Mozambique', '', ''),
(144, 'Myanmar', '', ''),
(145, 'Namibia', '', ''),
(146, 'Nauru', '', ''),
(147, 'Nepal', '', ''),
(148, 'Netherlands', '', ''),
(149, 'Netherlands Antilles', '', ''),
(150, 'New Caledonia', '', ''),
(151, 'New Zealand', '', ''),
(152, 'Nicaragua', '', ''),
(153, 'Niger', '', ''),
(154, 'Nigeria', '', ''),
(155, 'Niue', '', ''),
(156, 'Norfolk Island', '', ''),
(157, 'Northern Mariana Islands', '', ''),
(158, 'Norway', '', ''),
(159, 'Oman', '', ''),
(160, 'Pakistan', '', ''),
(161, 'Palau', '', ''),
(162, 'Panama', '', ''),
(163, 'Papua New Guinea', '', ''),
(164, 'Paraguay', '', ''),
(165, 'Peru', '', ''),
(166, 'Philippines', '', ''),
(167, 'Pitcairn', '', ''),
(168, 'Poland', '', ''),
(169, 'Portugal', '', ''),
(170, 'Puerto Rico', '', ''),
(171, 'Qatar', '', ''),
(172, 'Reunion', '', ''),
(173, 'Romania', '', ''),
(174, 'Russian Federation', '', ''),
(175, 'Rwanda', '', ''),
(176, 'Saint Kitts and Nevis', '', ''),
(177, 'Saint Lucia', '', ''),
(178, 'Saint Vincent and the Grenadines', '', ''),
(179, 'Samoa', '', ''),
(180, 'San Marino', '', ''),
(181, 'Saudi Arabia', '', ''),
(182, 'Sao Tome and Principe', '', ''),
(183, 'Senegal', '', ''),
(184, 'Seychelles', '', ''),
(185, 'Sierra Leone', '', ''),
(186, 'Singapore', '', ''),
(187, 'Slovakia (Slovak Republic)', '', ''),
(188, 'Slovenia', '', ''),
(189, 'Solomon Islands', '', ''),
(190, 'Somalia', '', ''),
(191, 'South Africa', '', ''),
(192, 'South Georgia and the South Sandwich Islands', '', ''),
(193, 'Spain', '', ''),
(194, 'Sri Lanka', '', ''),
(195, 'St. Helena', '', ''),
(196, 'St. Pierre and Miquelon', '', ''),
(197, 'Sudan', '', ''),
(198, 'Suriname', '', ''),
(199, 'Svalbard and Jan Mayen Islands', '', ''),
(200, 'Swaziland', '', ''),
(201, 'Sweden', '', ''),
(202, 'Switzerland', '', ''),
(203, 'Syrian Arab Republic', '', ''),
(204, 'Taiwan', '', ''),
(205, 'Tajikistan', '', ''),
(206, 'Tanzania, United Republic of', '', ''),
(207, 'Thailand', '', ''),
(208, 'Togo', '', ''),
(209, 'Tokelau', '', ''),
(210, 'Tonga', '', ''),
(211, 'Trinidad and Tobago', '', ''),
(212, 'Tunisia', '', ''),
(213, 'Turkey', '', ''),
(214, 'Turkmenistan', '', ''),
(215, 'Turks and Caicos Islands', '', ''),
(216, 'Tuvalu', '', ''),
(217, 'Uganda', '', ''),
(218, 'Ukraine', '', ''),
(219, 'United Arab Emirates', '', ''),
(220, 'United Kingdom', '', ''),
(221, 'United States of America', '', ''),
(222, 'Uruguay', '', ''),
(223, 'Uzbekistan', '', ''),
(224, 'Vanuatu', '', ''),
(225, 'Vatican City State (Holy See)', '', ''),
(226, 'Venezuela', '', ''),
(227, 'Viet Nam', '', ''),
(228, 'Virgin Islands (British)', '', ''),
(229, 'Virgin Islands (U.S.)', '', ''),
(230, 'Wallis and Futuna Islands', '', ''),
(231, 'Western Sahara', '', ''),
(232, 'Yemen', '', ''),
(233, 'Yugoslavia', '', ''),
(234, 'Zaire', '', ''),
(235, 'Zambia', '', ''),
(236, 'Zimbabwe', '', ''),
(237, 'Canary Islands, The', '', ''),
(238, 'Curacao', '', ''),
(239, 'Jordan', '', ''),
(240, 'Nevis', '', ''),
(241, 'Saipan', '', ''),
(242, 'North Somalia', '', ''),
(243, 'St. Barthelemy', '', ''),
(244, 'St. Eustatius', '', ''),
(245, 'St. Kits', '', ''),
(246, 'St. Lucia', '', ''),
(247, 'St. Maarten', '', ''),
(248, 'St. Vincent', '', ''),
(249, 'Tabiti', '', ''),
(250, 'Bonaire', '', ''),
(251, 'Guernsey', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_course`
--

CREATE TABLE IF NOT EXISTS `dtn_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_course`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_download`
--

CREATE TABLE IF NOT EXISTS `dtn_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `download_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `showFront` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_61875714989D9B62` (`slug`),
  KEY `IDX_618757143CCB525A` (`download_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dtn_download`
--

INSERT INTO `dtn_download` (`id`, `download_category_id`, `name`, `showFront`, `slug`, `file`, `created`, `status`, `orderby`) VALUES
(1, 1, 'Model Question Maths Entrance CSIT ', NULL, 'model-question-maths-entrance-csit', 'model-question-of-math.pdf', '2015-07-20 11:26:50', 'active', 3),
(2, 1, 'Model Question Physics Entrance CSIT ', '1', 'model-question-physics-entrance-csit', 'model-question-physics.pdf', '2015-07-20 11:27:22', 'active', 4),
(3, 1, 'Model Question Chemistry Entrance CSIT ', NULL, 'model-question-chemistry-entrance-csit', 'model-question-chemistry.pdf', '2015-07-20 11:27:42', 'active', 5),
(4, 1, 'Model Question English Entrance CSIT', NULL, 'model-question-english-entrance-csit', 'model-question-english.pdf', '2015-07-20 11:28:07', 'active', 2),
(5, 1, 'Model Question of CSIT Entrance 2070 ', '1', 'model-question-of-csit-entrance-2070', '12-model-questions-2069.pdf', '2015-07-20 11:30:25', 'active', 1),
(6, 2, 'BBA / MBA Brouchure', '1', 'bba-mba-brouchure', 'texas_broucher_BBAMBA.pdf', '2015-07-20 11:32:36', 'active', 0),
(7, 3, 'Download Prospectus', NULL, 'download-prospectus', 'prospectus.pdf', '2015-07-24 13:19:47', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_download_category`
--

CREATE TABLE IF NOT EXISTS `dtn_download_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_85ABD80989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtn_download_category`
--

INSERT INTO `dtn_download_category` (`id`, `name`, `slug`, `status`, `orderby`) VALUES
(1, 'Model Questions', 'model-questions', 'active', 0),
(2, 'Brouchure', 'brouchure', 'active', 0),
(3, 'Prospectus', 'prospectus', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_email_subscription`
--

CREATE TABLE IF NOT EXISTS `dtn_email_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` longtext NOT NULL,
  `active` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_email_subscription`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_faculty`
--

CREATE TABLE IF NOT EXISTS `dtn_faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E67575D5989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_E67575D584A0A3ED` (`content_id`),
  UNIQUE KEY `UNIQ_E67575D55E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dtn_faculty`
--

INSERT INTO `dtn_faculty` (`id`, `content_id`, `name`, `description`, `orderby`, `status`, `slug`, `email`) VALUES
(1, 45, 'MBA', 'Our MBA program aims to transform you into an effective leader of business and society. Our strong focus on relevant knowledge, real-world experiences, networks, skills and values driven by a team of faculty and corporate leaders set you apart.', 0, 1, 'mba', 'mba@texasint.edu.np'),
(2, 9, 'BBA', 'BBA', 0, 1, 'bba', 'bba@texasintl.edu.np'),
(4, 52, 'BScCSIT', 'Bachelors of Science in Computer Science and Information Technology (B.Sc. CSIT) is a four year course affiliated to Tribhuvan University designed to provide the students with all sorts of knowledge in the field of Inform\r\n', 0, 1, 'bsccsit', NULL),
(5, 54, 'MBS', 'MBS', 0, 1, 'mbs', NULL),
(6, 53, 'BSW', 'Texas Internatinal college under the management of Texas International Education Network is launching BSW (Bachelor in Social Work) in affilation with Tribhuwan University\r\n', 0, 1, 'bsw', NULL),
(7, 7, '+2', 'Texas Int&#39;l College, which has been running excellently under Texas Int&#39;l Education Network (2009), is a dynamic educational institution with outstanding academic programs (+2 Level) in Science, Management and Humanities faculties. Texas has been ', 0, 1, '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_faqcat`
--

CREATE TABLE IF NOT EXISTS `dtn_faqcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E569A8BA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dtn_faqcat`
--

INSERT INTO `dtn_faqcat` (`id`, `user_id`, `name`, `orderby`, `status`, `created`, `updated`) VALUES
(1, 1, 'BBA', 0, 0, '2015-07-20 14:36:58', '2015-07-24 11:53:16'),
(2, 1, 'MBA', 0, 0, '2015-07-20 14:37:41', '2015-07-24 11:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_faqs`
--

CREATE TABLE IF NOT EXISTS `dtn_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `faqcat_id` int(11) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_969D2D9A76ED395` (`user_id`),
  KEY `IDX_969D2D9C8419FDA` (`faqcat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dtn_faqs`
--

INSERT INTO `dtn_faqs` (`id`, `user_id`, `faqcat_id`, `question`, `answer`, `orderby`, `status`, `created`, `updated`) VALUES
(1, 1, 1, 'Q1', 'A1', 0, 1, '2015-07-20 14:37:26', '2015-07-20 14:37:26'),
(2, 1, 1, 'Q2', 'A2', 0, 1, '2015-07-20 14:37:26', '2015-07-20 14:37:26'),
(3, 1, 1, 'Q3', 'A3', 0, 1, '2015-07-20 14:37:26', '2015-07-20 14:37:26'),
(4, 1, 2, 'Q1', 'A1', 0, 1, '2015-07-20 14:38:05', '2015-07-20 14:38:05'),
(5, 1, 2, 'Q2', 'A2', 0, 1, '2015-07-20 14:38:06', '2015-07-20 14:38:06'),
(6, 1, 2, 'Q3', 'A3', 0, 1, '2015-07-20 14:38:06', '2015-07-20 14:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_group`
--

CREATE TABLE IF NOT EXISTS `dtn_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtn_group`
--

INSERT INTO `dtn_group` (`id`, `name`, `status`) VALUES
(1, 'Super Admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_group_permission`
--

CREATE TABLE IF NOT EXISTS `dtn_group_permission` (
  `group_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`permissions_id`),
  KEY `IDX_E7457D98FE54D947` (`group_id`),
  KEY `IDX_E7457D989C3E4F87` (`permissions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtn_group_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_image`
--

CREATE TABLE IF NOT EXISTS `dtn_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EAD225B41137ABCF` (`album_id`),
  KEY `IDX_EAD225B4A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `dtn_image`
--

INSERT INTO `dtn_image` (`id`, `album_id`, `user_id`, `name`, `caption`, `created`, `status`, `orderby`) VALUES
(35, 20, 1, 'guest-from-different-sector.jpg', 'Guest from different sector', '2015-07-22 08:35:52', 'active', 0),
(39, 21, 1, 'mou-at-microsoft.jpg', 'MOU with Microsoft Company', '2015-07-22 10:52:39', 'active', 0),
(40, 22, 1, 'academia-industry-tie-up.jpg', 'Academia Industry Tie Up', '2015-07-22 10:53:30', 'active', 0),
(41, 23, 1, '3.jpg', 'Student watching 3D movies', '2015-07-30 08:00:39', 'active', 0),
(42, 23, 1, '4.jpg', 'Principal and president of Csit circle with guest ', '2015-07-30 08:00:39', 'active', 0),
(43, 23, 1, '5.jpg', 'Cheif guest from F1 soft Int''l Inaugurating texas techno share program', '2015-07-30 08:00:40', 'active', 0),
(44, 23, 1, '8.jpg', 'Group photo of organizer and guests ', '2015-07-30 08:00:40', 'active', 0),
(45, 23, 1, '9.jpg', 'Guest from America exibiting his project ', '2015-07-30 08:00:41', 'active', 0),
(46, 23, 1, '10.jpg', 'Principal of Texas College enjoying in game zone ', '2015-07-30 08:00:41', 'active', 0),
(49, 24, 1, '14.jpg', 'Principal sir donating blood ', '2015-07-30 08:14:36', 'active', 0),
(50, 24, 1, '15.jpg', 'Student donating blood ', '2015-07-30 08:14:36', 'active', 0),
(51, 24, 1, '13.jpg', 'CSIT co-ordinatior donating blood ', '2015-07-30 08:14:37', 'active', 0),
(52, 24, 1, '12.jpg', 'Shyam sir Co-ordinatior of BBS donating blood', '2015-07-30 08:14:37', 'active', 0),
(53, 24, 1, '11.jpg', 'Student participating in blod donation program ', '2015-07-30 08:14:38', 'active', 0),
(54, 20, 1, '17.jpg', 'Guest from America Wouter Zwart Delevering Speech', '2015-07-30 08:17:24', 'active', 0),
(55, 20, 1, '16.jpg', 'President of Csit Circle Delevering Speech.', '2015-07-30 08:17:25', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_mainmenu`
--

CREATE TABLE IF NOT EXISTS `dtn_mainmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `orderby` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `topmenu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F288A07727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `dtn_mainmenu`
--

INSERT INTO `dtn_mainmenu` (`id`, `parent_id`, `label`, `reference`, `type`, `orderby`, `image`, `topmenu`) VALUES
(1, NULL, 'About', '#', 'link', 0, NULL, 'N'),
(2, 3, 'Academic Calender', '14', 'page', 2, NULL, 'N'),
(3, NULL, 'Course Info', '#', 'link', 1, NULL, 'N'),
(4, 3, 'Achievements', '5', 'page', 3, NULL, 'N'),
(5, 3, 'Admission Open in +2 Program for 2072', '28', 'page', 4, NULL, 'N'),
(6, 7, 'Scholarship', '12', 'page', 6, NULL, 'N'),
(7, NULL, 'Syllabus', '#', 'link', 5, NULL, 'N'),
(8, 7, 'School', '6', 'page', 7, NULL, 'N'),
(9, 7, 'Social Service', '11', 'page', 8, NULL, 'N'),
(10, NULL, 'College List', 'collegelist', 'link', 9, NULL, 'N'),
(11, NULL, 'Admission', '#', 'link', 10, NULL, 'N'),
(12, NULL, 'E-Library', '#', 'link', 11, NULL, 'N'),
(13, NULL, 'News & Events', '1', 'category', 12, NULL, 'N'),
(14, NULL, 'More', '#', 'link', 13, NULL, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_management`
--

CREATE TABLE IF NOT EXISTS `dtn_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `description` longtext,
  `order_by` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `showFront` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FC66042A989D9B62` (`slug`),
  KEY `IDX_FC66042AC54C8C93` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `dtn_management`
--

INSERT INTO `dtn_management` (`id`, `type_id`, `name`, `slug`, `position`, `experience`, `description`, `order_by`, `image`, `active`, `showFront`) VALUES
(1, 1, 'MR. BHESH RAJ POKHREL', 'mr-bhesh-raj-pokhrel', 'Higher Studies Director / Principal', '15 Years', '<div style="text-align: justify;">Education cannot be confined to the narrow periphery of bookish knowledge; it transcends the narrow barriers of geography, culture and the nation and moves to the open path of perfection. Certainly, you will find Texas committed to the changes and reforms we are supposed to adopt in our education delivery and to boost all-round development of the students through project oriented techniques so that they will be well prepared theoretically and practically to deal with the problems in the days to come.</div>\r\n', 0, 'pricipal.jpg', 1, 0),
(2, 1, 'DR. KESHAV SHRESTHA', 'dr-keshav-shrestha', 'CHAIRMAN', '', '<span style="color: rgb(102, 102, 102); font-family: lato; letter-spacing: 0.300000011920929px; line-height: 22px; text-align: justify;">Education cannot be confined to the narrow periphery of bookish knowledge; it transcends the narrow barriers of geography, culture and the nation and moves to the open path of perfection. Certainly, you will find Texas committed to the changes and reforms we are supposed to adopt in our education delivery and to boost all-round development of the students through project oriented techniques so that they will be well prepared theoretically and practically to deal with the problems in the days to come.</span>', 0, 'DSC019211.JPG', 1, 1),
(3, 1, 'PROF. DR. GOVINDA PRASAD ACHARYA', 'prof-dr-govinda-prasad-acharya', 'FORMER DEAN', '', '<span style="color: rgb(102, 102, 102); font-family: lato; letter-spacing: 0.300000011920929px; line-height: 22px; text-align: justify;">Education cannot be confined to the narrow periphery of bookish knowledge; it transcends the narrow barriers of geography, culture and the nation and moves to the open path of perfection. Certainly, you will find Texas committed to the changes and reforms we are supposed to adopt in our education delivery and to boost all-round development of the students through project oriented techniques so that they will be well prepared theoretically and practically to deal with the problems in the days to come.</span>', 0, 'DSC01916.JPG', 1, 1),
(4, 3, 'Mr. Shyam Shrestha', 'mr-shyam-shrestha', 'Academic Co-ordinator', '', '', 0, '', 1, 0),
(5, 3, 'Mr. Shankar Prashad Sharma', 'mr-shankar-prashad-sharma', 'HEAD, Bsc CSIT', '', '', 0, '', 1, 0),
(6, 3, 'Ajay Khadka', 'ajay-khadka', 'HEAD, Texas College of Management', '', '', 0, '', 1, 0),
(7, 3, 'Mr.Narayan Pokhrel', 'mr-narayan-pokhrel', 'Coordinator Exam/Humanities', '', '', 0, '', 1, 0),
(8, 3, 'Mr. Yub Raj Basnet', 'mr-yub-raj-basnet', 'Head, Science Department', '', '', 0, '', 1, 0),
(9, 3, 'Mr.Rebant Thakulla', 'mr-rebant-thakulla', 'Head of Library Department', '', '', 0, '', 1, 0),
(10, 4, 'Krishna Pd. Dangal', 'krishna-pd-dangal', 'Administrative In-charge', '', '', 0, '', 1, 0),
(11, 4, 'Mr.Krishna Shrestha', 'mr-krishna-shrestha', 'Accountant', '', '', 0, '', 1, 0),
(12, 4, 'Bimala Ghimire Dangal', 'bimala-ghimire-dangal', 'Assistant Accountant', '', '', 0, '', 1, 0),
(13, 5, 'Mr. Prabin Khadka', 'mr-prabin-khadka', 'web content manager', '', '', 0, '', 1, 0),
(14, 6, 'Kalpana Karki', 'kalpana-karki', 'Front office', '', '', 0, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_management_type`
--

CREATE TABLE IF NOT EXISTS `dtn_management_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_21BB9EE3989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dtn_management_type`
--

INSERT INTO `dtn_management_type` (`id`, `name`, `slug`) VALUES
(1, 'Management', 'management'),
(3, 'Faculty', 'faculty'),
(4, 'Administration', 'administration'),
(5, 'Web', 'web'),
(6, 'Front Office', 'front-office');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_options`
--

CREATE TABLE IF NOT EXISTS `dtn_options` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(100) NOT NULL,
  `option_value` text NOT NULL,
  `autoload` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`option_name`),
  UNIQUE KEY `IDX_option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `dtn_options`
--

INSERT INTO `dtn_options` (`id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteconfig', 'a:3:{s:10:"admin_name";s:8:"BSC-CSIT";s:11:"admin_email";s:17:" info@bsccsit.com";s:6:"slogan";s:27:"...for a complete education";}', 1),
(12, 'brand_image', 'logo1.png', 1),
(13, 'brand_thumbnail', 'logo1_thumb.png', 1),
(14, 'scrolltitle', 'NO', 1),
(47, 'skype_id', 'texasintlcollege', 1),
(48, 'facebook_id', 'https://www.facebook.com/texasintlcollege', 1),
(49, 'twitter_id', 'https://twitter.com/texasintlcollege', 1),
(50, 'linkedIn_id', 'https://www.linkedin.com/texasintlcollege', 1),
(51, 'dashboardOrder_1', '-mainmenu-contactus-management-quicklinks-slider-testimonials-content/add', 1),
(52, 'homepage_content_right', '17', 1),
(53, 'home_page_news_events', '11', 1),
(55, 'homepage_message', '0', 1),
(56, 'homepage_team_a', '2', 1),
(57, 'homepage_team_b', '3', 1),
(58, 'toll_free_no', '9812345678', 1),
(59, 'feedback_email', ' info@bsccsit.com', 1),
(60, 'contact_details', 'Not Available', 1),
(61, 'meta_title', 'Texas International HSS/College', 1),
(62, 'meta_description', 'best csit college in Kathmandu ,best csit college in Nepal, CSIT college in Nepal, IT college in Nepal, Best IT college in Nepal, Best +2 college in Nepal, Best BBA colleges in Nepal, Best MBA College in Nepal, Best BBS college in Nepal, Best BSW college in Nepal, Best +2 Science college in Nepal, Best +2 Management college in Nepal, Best +2 Humanities college in Nepal', 1),
(63, 'meta_keyword', 'best csit college in Kathmandu ,best csit college in Nepal, CSIT college in Nepal, IT college in Nepal, Best IT college in Nepal, Best +2 college in Nepal, Best BBA colleges in Nepal, Best MBA College in Nepal, Best BBS college in Nepal, Best BSW college in Nepal, Best +2 Science college in Nepal, Best +2 Management college in Nepal, Best +2 Humanities college in Nepal', 1),
(64, 'mid-first', '47', 1),
(65, 'mid-second', '46', 1),
(66, 'mid-third', '4', 1),
(67, 'home-category', '1', 1),
(68, 'home-category-first', '4', 1),
(69, 'footer-content', '17', 1),
(70, 'footer_slogan', '© Copyright 2016 by HAMRO CSIT NEPAL. All Rights Reserved.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_outlets`
--

CREATE TABLE IF NOT EXISTS `dtn_outlets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtn_outlets`
--

INSERT INTO `dtn_outlets` (`id`, `location`, `name`, `description`, `email`, `latitude`, `longitude`, `status`, `phone`) VALUES
(1, 'Mitrapark, Chabahil, Kathmandu', 'Texas International college', 'TEXAS International College\r\nMitrapark, Chabahil, Kathmandu', 'info@texasintl.edu.np', '27.712586835543295', '85.34458369311528', 'active', '01-4479017,4490670');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_permissions`
--

CREATE TABLE IF NOT EXISTS `dtn_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `des` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_77CE310C5E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `dtn_permissions`
--

INSERT INTO `dtn_permissions` (`id`, `name`, `des`) VALUES
(1, 'administer content', 'Create, edit and delete contents.'),
(2, 'administer mainmenu', 'Create, edit and delete mainmenu.'),
(3, 'administer user', 'Create, edit and delete users.'),
(4, 'administer group', 'Create, edit and delete groups.'),
(5, 'quick links', 'Add, edit and delete items to/from the management team and the board of directors.'),
(6, 'administer slider', 'Add, edit and delete slider images.'),
(7, 'administer management list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(8, 'contact us list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(9, 'testimonials list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(10, 'email subscription list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(11, 'administer gallery', 'Create, edit and delete gallery.'),
(12, 'testimonial list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(13, 'administer faq', 'Create, edit and delete faq.'),
(14, 'administer outlets', 'Add, edit and delete ATM and branches outlets.'),
(15, 'administer popup', 'Create, edit and delete popups.'),
(16, 'administer downloads', 'Add, edit and delete download items.'),
(17, 'administer video', 'Create, edit and delete video.'),
(18, 'faculty list', 'Add, edit and delete items to/from the management team and the board of directors.'),
(19, 'administer quicklinks', 'Add, edit and delete quicklinks.'),
(20, 'course list', 'Add, edit and delete items to/from the Course'),
(21, 'college list', 'Add, edit and delete items to/from the college'),
(22, 'administer footer', 'Add, edit and delete footer.');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_popup`
--

CREATE TABLE IF NOT EXISTS `dtn_popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_25E645B3A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtn_popup`
--

INSERT INTO `dtn_popup` (`id`, `user_id`, `title`, `body`, `status`, `created`, `updated`) VALUES
(1, 1, 'est', '<img alt="" src="assets/upload/images/admission-plus2.jpg" />', 'active', '2015-09-02 12:55:44', '2015-09-02 12:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_quick_links`
--

CREATE TABLE IF NOT EXISTS `dtn_quick_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B409ABDA84A0A3ED` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtn_quick_links`
--

INSERT INTO `dtn_quick_links` (`id`, `content_id`, `title`, `status`, `type`, `link`) VALUES
(1, 4, 'Do you want to know more about BSC CSIT', 'active', 'internal', NULL),
(2, 5, 'Download model question of CSIT entrance 2070', 'active', 'internal', NULL),
(3, 5, 'Download model question of CSIT entrance 2070', 'active', 'internal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_sessions`
--

CREATE TABLE IF NOT EXISTS `dtn_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dtn_sessions`
--

INSERT INTO `dtn_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('05e143044556b6e07481a64cd0b50799', '10.13.210.10', 'Mozilla/5.0 (Windows NT 6.1; rv:48.0) Gecko/201001', 1472723974, ''),
('163bd5b1ead7dfdbfc149290a04b46a5', '10.13.210.22', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1472728668, 'a:1:{s:7:"user_id";i:1;}'),
('1c7e81c09c97f52f64f7e97c6b4f43ad', '10.13.210.22', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1472725768, 'a:1:{s:7:"user_id";i:1;}'),
('400326792e951d2bb901c70689fbc06a', '10.13.210.17', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko', 1472726570, ''),
('5a985268d0d38ac08cf6a9c41d335425', '10.13.210.22', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1472724073, 'a:1:{s:7:"user_id";i:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_slider`
--

CREATE TABLE IF NOT EXISTS `dtn_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `content_a` varchar(255) DEFAULT NULL,
  `content_b` varchar(255) DEFAULT NULL,
  `content_c` varchar(255) DEFAULT NULL,
  `linkType` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `istab` varchar(2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F830C4D6FE54D947` (`group_id`),
  KEY `IDX_F830C4D684A0A3ED` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dtn_slider`
--

INSERT INTO `dtn_slider` (`id`, `group_id`, `content_id`, `name`, `content_a`, `content_b`, `content_c`, `linkType`, `url`, `image`, `thumbnail`, `istab`, `status`, `orderby`) VALUES
(1, 1, 17, 'Texas International College', 'Welcome To Texas Int''l College', 'A dynamic educational institution', 'with outstanding academic programs', 'internal', '#', 'banner14.jpg', 'banner14_thumb.jpg', 'Y', 'active', 2),
(2, 1, 17, 'Texas International College', 'Welcome To Texas Int''l College', 'A dynamic educational institution', 'with outstanding academic programs', 'internal', '#', 'banner21.jpg', 'banner21_thumb.jpg', 'Y', 'active', 3),
(3, 2, NULL, 'Texas International College', '', '', '', 'external', '#', 'logo1.png', 'logo1_thumb.png', 'Y', 'active', 0),
(4, 2, NULL, 'Texas International College', '', '', '', 'external', '#', 'logo2.png', 'logo2_thumb.png', 'Y', 'active', 0),
(5, 2, 9, 'Texas International College', '', '', '', 'internal', '#', 'logo3.png', 'logo3_thumb.png', 'Y', 'active', 0),
(6, 1, NULL, 'Texas International College', '', '', '', 'external', '#', 'banner3.jpg', 'banner3_thumb.jpg', 'Y', 'active', 4),
(7, 1, NULL, 'Texas International College', '', '', '', 'external', '#', 'banner4.jpg', 'banner4_thumb.jpg', 'N', 'active', 5),
(8, 1, NULL, 'Texas International College', '', '', '', 'external', '#', 'banner5.jpg', 'banner5_thumb.jpg', 'Y', 'active', 6),
(9, 1, NULL, 'Texas International College', '', '', '', 'external', '#', 'banner6.jpg', 'banner6_thumb.jpg', 'Y', 'active', 7),
(10, 1, NULL, 'Academic Indutry Tie Up', 'Texas Int''l College', 'Academic Industry Tie Up', 'F1Soft International', 'external', '#', 'texas-indutry-tie-up.jpg', 'texas-indutry-tie-up_thumb.jpg', 'N', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_slider_group`
--

CREATE TABLE IF NOT EXISTS `dtn_slider_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_74F6C3B9989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dtn_slider_group`
--

INSERT INTO `dtn_slider_group` (`id`, `name`, `width`, `height`, `slug`) VALUES
(1, 'Main Slider', 1366, 511, 'main-slider'),
(2, 'Mini Slider', 235, 66, 'mini-slider');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_terms`
--

CREATE TABLE IF NOT EXISTS `dtn_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `showfront` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CEEAAAFD989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dtn_terms`
--

INSERT INTO `dtn_terms` (`id`, `name`, `slug`, `showfront`) VALUES
(1, 'News & Events', 'news-events', NULL),
(2, 'Why Us', 'why-us', NULL),
(3, 'Academic Calendar', 'academic-calendar', NULL),
(4, 'Achievements', 'achievements', NULL),
(5, 'Notice', 'notice', NULL),
(6, 'sdf', 'sdf', NULL),
(7, 'dsfsdf', 'dsfsdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_term_relationship`
--

CREATE TABLE IF NOT EXISTS `dtn_term_relationship` (
  `content_id` int(11) NOT NULL,
  `taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`content_id`,`taxonomy_id`),
  KEY `IDX_90F5FEFA84A0A3ED` (`content_id`),
  KEY `IDX_90F5FEFA9557E6F6` (`taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtn_term_relationship`
--

INSERT INTO `dtn_term_relationship` (`content_id`, `taxonomy_id`) VALUES
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(28, 1),
(29, 1),
(30, 1),
(46, 3),
(47, 3),
(47, 4),
(47, 5),
(48, 2),
(49, 2),
(50, 4),
(55, 1),
(55, 5),
(56, 5),
(57, 1),
(58, 6),
(58, 7),
(59, 1),
(59, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `dtn_term_taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `taxonomy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FF982A6FE2C35FC` (`term_id`),
  KEY `IDX_FF982A6F727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `dtn_term_taxonomy`
--

INSERT INTO `dtn_term_taxonomy` (`id`, `term_id`, `parent_id`, `taxonomy`) VALUES
(1, 1, NULL, 'category'),
(2, 2, NULL, 'category'),
(3, 3, NULL, 'category'),
(4, 4, NULL, 'category'),
(5, 5, NULL, 'category'),
(6, 6, NULL, 'tags'),
(7, 7, NULL, 'tags'),
(8, 6, NULL, 'tags');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_testimonial`
--

CREATE TABLE IF NOT EXISTS `dtn_testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `created` datetime NOT NULL,
  `order_by` int(11) NOT NULL,
  `showFront` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_testimonial`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_university`
--

CREATE TABLE IF NOT EXISTS `dtn_university` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dtn_university`
--

INSERT INTO `dtn_university` (`id`, `name`, `created`, `orderby`, `status`, `slug`) VALUES
(1, 'Tribuwan University', '2016-08-31 14:53:24', 0, 1, 'tribhuwan-university'),
(5, 'Purbanchal University', '2016-08-31 16:26:19', 0, 1, 'purbanchal-university');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_user`
--

CREATE TABLE IF NOT EXISTS `dtn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `resetcode` varchar(255) DEFAULT NULL,
  `resettime` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `no_of_login_attempts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ACB823E6F85E0677` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtn_user`
--

INSERT INTO `dtn_user` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `email`, `phone`, `resetcode`, `resettime`, `status`, `created`, `updated`, `last_login_date`, `no_of_login_attempts`) VALUES
(1, 'CMS', '', 'Admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'sulochana@f1soft.com', '977-1-1111111', NULL, NULL, 'active', '2013-03-11 04:00:00', '2016-09-01 16:40:31', '2016-09-01 16:40:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_user_group`
--

CREATE TABLE IF NOT EXISTS `dtn_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_A920C763A76ED395` (`user_id`),
  KEY `IDX_A920C763FE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtn_user_group`
--

INSERT INTO `dtn_user_group` (`user_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dtn_user_meta`
--

CREATE TABLE IF NOT EXISTS `dtn_user_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `IDX_563B0ACCA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_user_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `dtn_video`
--

CREATE TABLE IF NOT EXISTS `dtn_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `linktype` varchar(255) DEFAULT NULL,
  `ylink` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `orderby` int(11) NOT NULL,
  `views` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5328FBC7989D9B62` (`slug`),
  KEY `IDX_5328FBC712469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dtn_video`
--

INSERT INTO `dtn_video` (`id`, `category_id`, `title`, `linktype`, `ylink`, `image`, `active`, `orderby`, `views`, `slug`, `created`, `updated`) VALUES
(2, 1, 'BBA and MBA Admission Open in Texas College of Management', 'yt_code', 'zizQaQWPduc', NULL, 1, 1, NULL, 'bba-and-mba-admission-open-in-texas-college-of-management', '2015-07-20 06:11:23', '2015-07-23 12:13:17'),
(3, 1, 'Texas BBA MBA Admission', 'yt_link', 'YpPbG734Vq4', NULL, 1, 2, NULL, 'texas-bba-mba-admission', '2015-07-20 06:13:02', '2015-07-20 06:39:18'),
(5, 1, 'BSc(CSIT) at Texas College Ktm', 'yt_code', 'FKhK1xsLwSI', NULL, 1, 0, NULL, 'bsc-csit-at-texas-college-ktm', '2015-07-20 08:03:21', '2015-07-23 07:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_video_category`
--

CREATE TABLE IF NOT EXISTS `dtn_video_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2063379E989D9B62` (`slug`),
  KEY `IDX_2063379EA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtn_video_category`
--

INSERT INTO `dtn_video_category` (`id`, `user_id`, `title`, `orderby`, `status`, `slug`, `created`, `updated`) VALUES
(1, 1, 'Youtube', 0, 1, 'youtube', '2015-07-19 14:54:05', '2015-07-24 12:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `dtn_video_subtopic`
--

CREATE TABLE IF NOT EXISTS `dtn_video_subtopic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C1DC1F9E29C1004E` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dtn_video_subtopic`
--


-- --------------------------------------------------------

--
-- Table structure for table `f1_footer`
--

CREATE TABLE IF NOT EXISTS `f1_footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67982CDFE54D947` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `f1_footer`
--

INSERT INTO `f1_footer` (`id`, `group_id`, `title`, `url`, `type`, `order_by`, `active`) VALUES
(1, 1, 'First Semester', '53', 'internal', 0, 1),
(2, 2, 'Course Of Study', '35', 'internal', 0, 1),
(3, 3, 'Book', '49', 'internal', 0, 1),
(4, 3, 'Notes', '46', 'internal', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `f1_footer_group`
--

CREATE TABLE IF NOT EXISTS `f1_footer_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `f1_footer_group`
--

INSERT INTO `f1_footer_group` (`id`, `name`, `order_by`, `active`) VALUES
(1, 'Syllabus', 0, 1),
(2, 'Course Info', 0, 1),
(3, 'E-Library', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtn_album`
--
ALTER TABLE `dtn_album`
  ADD CONSTRAINT `FK_16774FA8410045B8` FOREIGN KEY (`coverimage_id`) REFERENCES `dtn_image` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_16774FA8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_apply_to_faculty`
--
ALTER TABLE `dtn_apply_to_faculty`
  ADD CONSTRAINT `FK_4A9B8885680CAB68` FOREIGN KEY (`faculty_id`) REFERENCES `dtn_faculty` (`id`);

--
-- Constraints for table `dtn_college`
--
ALTER TABLE `dtn_college`
  ADD CONSTRAINT `FK_5B399294309D1878` FOREIGN KEY (`university_id`) REFERENCES `dtn_university` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_content`
--
ALTER TABLE `dtn_content`
  ADD CONSTRAINT `FK_F26253F727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `dtn_content` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_F26253FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_content_meta`
--
ALTER TABLE `dtn_content_meta`
  ADD CONSTRAINT `FK_CE71EAEF84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `dtn_content` (`id`);

--
-- Constraints for table `dtn_download`
--
ALTER TABLE `dtn_download`
  ADD CONSTRAINT `FK_618757143CCB525A` FOREIGN KEY (`download_category_id`) REFERENCES `dtn_download_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_faculty`
--
ALTER TABLE `dtn_faculty`
  ADD CONSTRAINT `FK_E67575D584A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `dtn_content` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_faqcat`
--
ALTER TABLE `dtn_faqcat`
  ADD CONSTRAINT `FK_4E569A8BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_faqs`
--
ALTER TABLE `dtn_faqs`
  ADD CONSTRAINT `FK_969D2D9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`),
  ADD CONSTRAINT `FK_969D2D9C8419FDA` FOREIGN KEY (`faqcat_id`) REFERENCES `dtn_faqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_group_permission`
--
ALTER TABLE `dtn_group_permission`
  ADD CONSTRAINT `FK_E7457D989C3E4F87` FOREIGN KEY (`permissions_id`) REFERENCES `dtn_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E7457D98FE54D947` FOREIGN KEY (`group_id`) REFERENCES `dtn_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_image`
--
ALTER TABLE `dtn_image`
  ADD CONSTRAINT `FK_EAD225B41137ABCF` FOREIGN KEY (`album_id`) REFERENCES `dtn_album` (`id`),
  ADD CONSTRAINT `FK_EAD225B4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_mainmenu`
--
ALTER TABLE `dtn_mainmenu`
  ADD CONSTRAINT `FK_4F288A07727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `dtn_mainmenu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dtn_popup`
--
ALTER TABLE `dtn_popup`
  ADD CONSTRAINT `FK_25E645B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_slider`
--
ALTER TABLE `dtn_slider`
  ADD CONSTRAINT `FK_F830C4D684A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `dtn_content` (`id`),
  ADD CONSTRAINT `FK_F830C4D6FE54D947` FOREIGN KEY (`group_id`) REFERENCES `dtn_slider_group` (`id`);

--
-- Constraints for table `dtn_video`
--
ALTER TABLE `dtn_video`
  ADD CONSTRAINT `FK_5328FBC712469DE2` FOREIGN KEY (`category_id`) REFERENCES `dtn_video_category` (`id`);

--
-- Constraints for table `dtn_video_category`
--
ALTER TABLE `dtn_video_category`
  ADD CONSTRAINT `FK_2063379EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `dtn_user` (`id`);

--
-- Constraints for table `dtn_video_subtopic`
--
ALTER TABLE `dtn_video_subtopic`
  ADD CONSTRAINT `FK_C1DC1F9E29C1004E` FOREIGN KEY (`video_id`) REFERENCES `dtn_video` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
