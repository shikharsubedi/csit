<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "Web";
$route['404_override'] = '';

/* 	MY ROUTES	 */

//content module
//ajax
//front
$route['web'] = "web";

//front
$route['content/ajax/(:any)'] = "content/ajax/$1";
$route["slider/ajax/updateOrder"] = "slider/ajax/updateOrder";
$route["slider/ajax/setActivate"] = "slider/ajax/setActivate";


//front
$route['category/searchByTitle/(:any)'] = "content/searchByTitle/$1";
$route['notice'] = "content/texasNotice";
$route['notice/(:num)'] = "content/notice/$1";
$route['achievements'] = "content/texasAchievements";
$route['achievements/(:num)'] = "content/texasAchievements/$1";
$route['content/whyuslist'] = "content/whyuslist";
$route['academic-calendar'] = "content/academicCalendar";
$route['academic-calendar/(:any)'] = "content/academicCalendar/$1";
/*$route['why-us'] = "content/texasWhyUs";
$route['why-us/(:any)'] = "content/texasWhyUs/$1";*/
$route['category/(:any)'] = "content/category/$1";
$route['content/search'] = "content/search";
$route['content/emi_calculator'] = "content/emi_calculator";
$route['content/sitemap'] = "content/sitemap";
$route['content/categoryA'] = "content/categoryA";
$route['content/(:any)'] = "content/index/$1";

$route['slider/_widget/(:any)'] = "slider/_widget/$1";
$route['slider/(:any)/(:any)'] = "slider/index/$1/$2";

$route['forex'] = "forex/index";
$route['college/collegeDetail/(:any)'] = "college/collegeDetail/$1";

$route['feedback'] = "feedback/index";
$route['forex/widget'] = "forex/widget";

$route['downloads/(:any)'] = "downloads/download/$1";
//$route['download/(:any)/(:any)'] = "downloads/$1/$2";

$route['profile/(:any)'] = "management/profile/$1";

$route['vacancy'] = "vacancy/index";
$route['vacancy/details/(:num)'] = "vacancy/details/$1";
$route['career/(:any)'] = "career/index/$1";
$route['career/captcha'] = "career/captcha";

$route['management/showFront'] = "management/showFront";
$route['management/showMore/(:num)'] = "management/showWholeContent/$1";
$route['our-team'] = "management/index";
$route['profile'] = "management/viewall";
$route['management/(:any)'] = "management/profile/$1";

$route['content/showFront'] = "content/showFront";
$route['testimonial/showFront'] = "testimonial/showFront";
$route['testimonial'] = "testimonial/index";
$route['outletlocator/showFront'] = "outletlocator/showFront";
$route['outletlocator'] = "outletlocator/index";
$route['contactus'] = "contactus/index";
$route['emailsubscription'] = "emailsubscription/index";


$route['gallery/(:any)'] = "gallery/viewAlbum/$1";
$route['gallery/(:num)'] = "gallery/index/$1";
$route['gallery'] = "gallery/index";
$route['collegelist'] = "college/getAllCollegelist";
$route['collegelist/(:num)'] = "college/getAllCollegelist/$1";
$route['videos'] = "video/index";
$route['videos/(:any)'] = "video/index/$1";


$route['popup'] = "popup/latest";
$route['downloads/ajax/setQuickLinks'] = 'downloads/ajax/setQuickLinks';
$route['downloads/ajax/updateDownloadOrder'] = 'downloads/ajax/updateDownloadOrder';
$route['downloads/showFront'] = 'downloads/showFront';
$route['downloads'] = 'downloads/index';

$route['faq'] = 'faq/index';
$route['applyonline'] = 'faculty/index';
$route['applyonline/(:any)'] = 'faculty/index/$1';

$route['tools/update'] = 'tools/update';

//Control routs
$route["console/login"] = "console/login";
$route["console/captcha"] = "console/captcha";
$route["console/authenticate"] = "console/authenticate";
$route["console/logout"] = "console/logout";

$route[$this->config->item('admin_dir_mask')] = $this->config->item('admin_dir_mask') . "/dashboard";
$route[$this->config->item('admin_dir_mask') . "/dashboard"] = $this->config->item('admin_dir_mask') . "/dashboard";
$route[$this->config->item('admin_dir_mask') . "/mainmenu"] = $this->config->item('admin_dir_mask') . "/mainmenu";
$route[$this->config->item('admin_dir_mask') . "/content"] = $this->config->item('admin_dir_mask') . "/content";

$route[$this->config->item('admin_dir_mask') . "/content/index/(:num)"] = $this->config->item('admin_dir_mask') . "/content/index/$1";
$route[$this->config->item('admin_dir_mask') . "/content/index"] = $this->config->item('admin_dir_mask') . "/content/index";


$route[$this->config->item('admin_dir_mask') . "/content/add"] = $this->config->item('admin_dir_mask') . "/content/add";
$route[$this->config->item('admin_dir_mask') . "/content/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/content/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/content/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/content/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/footer"] = $this->config->item('admin_dir_mask') . "/footer";
$route[$this->config->item('admin_dir_mask') . "/footer/add"] = $this->config->item('admin_dir_mask') . "/footer/add";
$route[$this->config->item('admin_dir_mask') . "/footer/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/content/category"] = $this->config->item('admin_dir_mask') . "/content/category";

$route[$this->config->item('admin_dir_mask') . "/content/showfrontt"] = $this->config->item('admin_dir_mask') . "/content/showfrontt";

$route[$this->config->item('admin_dir_mask') . "/content/category/add"] = $this->config->item('admin_dir_mask') . "/content/category/add";
$route[$this->config->item('admin_dir_mask') . "/content/category/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/content/category/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/content/category/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/content/category/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/content/cat/(:num)"] = $this->config->item('admin_dir_mask') . "/content/cat/$1";
$route[$this->config->item('admin_dir_mask') . "/content/addFromCategory"] = $this->config->item('admin_dir_mask') . "/content/addFromCategory";
$route[$this->config->item('admin_dir_mask') . "/content/addFromCategory/(:any)"] = $this->config->item('admin_dir_mask') . "/content/addFromCategory/$1";
$route[$this->config->item('admin_dir_mask') . "/content/updatenews"] = $this->config->item('admin_dir_mask') . "/content/updatenews";

$route[$this->config->item('admin_dir_mask') . "/logs/(:any)"] = $this->config->item('admin_dir_mask') . "/logs/index/$1";
$route[$this->config->item('admin_dir_mask') . "/logs"] = $this->config->item('admin_dir_mask') . "/logs";
$route[$this->config->item('admin_dir_mask') . "/user"] = $this->config->item('admin_dir_mask') . "/user";
$route[$this->config->item('admin_dir_mask') . "/user/add"] = $this->config->item('admin_dir_mask') . "/user/add";
$route[$this->config->item('admin_dir_mask') . "/user/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/user/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/user/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/user/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/user/addgroup"] = $this->config->item('admin_dir_mask') . "/user/addgroup";
$route[$this->config->item('admin_dir_mask') . "/user/editgroup/(:num)"] = $this->config->item('admin_dir_mask') . "/user/editgroup/$1";
$route[$this->config->item('admin_dir_mask') . "/user/deletegroup/(:num)"] = $this->config->item('admin_dir_mask') . "/user/deletegroup/$1";
$route[$this->config->item('admin_dir_mask') . "/user/editgrouppermissions/(:num)"] = $this->config->item('admin_dir_mask') . "/user/editgrouppermissions/$1";
$route[$this->config->item('admin_dir_mask') . "/user/profile"] = $this->config->item('admin_dir_mask') . "/user/profile";
$route[$this->config->item('admin_dir_mask') . "/user/profile/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/user/profile/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/user/profile/changepwd"] = $this->config->item('admin_dir_mask') . "/user/profile/changepwd";
$route[$this->config->item('admin_dir_mask') . "/config"] = $this->config->item('admin_dir_mask') . "/config";

$route[$this->config->item('admin_dir_mask') . "/slider"] = $this->config->item('admin_dir_mask') . "/slider";
$route[$this->config->item('admin_dir_mask') . "/slider/add"] = $this->config->item('admin_dir_mask') . "/slider/add";
$route[$this->config->item('admin_dir_mask') . "/slider/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/slider/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/slider/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/slider/delete/$1";



$route[$this->config->item('admin_dir_mask') . "/college"] = $this->config->item('admin_dir_mask') . "/college/index";
$route[$this->config->item('admin_dir_mask') . "/college/add"] = $this->config->item('admin_dir_mask') . "/college/add";
$route[$this->config->item('admin_dir_mask') . "/college/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/college/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/college/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/college/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/college/addcollege"] = $this->config->item('admin_dir_mask') . "/college/addcollege";
$route[$this->config->item('admin_dir_mask') . "/college/editcollege/(:num)"] = $this->config->item('admin_dir_mask') . "/college/editcollege/$1";
$route[$this->config->item('admin_dir_mask') . "/college/listcollege/(:num)"] = $this->config->item('admin_dir_mask') . "/college/listcollege/$1";
$route[$this->config->item('admin_dir_mask') . "/college/deletecollege/(:num)"] = $this->config->item('admin_dir_mask') . "/college/deletecollege/$1";
$route[$this->config->item('admin_dir_mask') . "/college/listAllCollege"] = $this->config->item('admin_dir_mask') . "/college/listAllCollege";


$route[$this->config->item('admin_dir_mask') . "/forex/preview/(:num)"] = $this->config->item('admin_dir_mask') . "/forex/preview/$1";
$route[$this->config->item('admin_dir_mask') . "/forex/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/forex/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/forex/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/forex/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/footer"] = $this->config->item('admin_dir_mask') . "/footer/index";
$route[$this->config->item('admin_dir_mask') . "/footer/addgroup"] = $this->config->item('admin_dir_mask') . "/footer/addgroup";
$route[$this->config->item('admin_dir_mask') . "/footer/editgroup/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/editgroup/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/deletegroup/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/deletegroup/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/viewfooters/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/viewfooters/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/addfooter/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/addfooter/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/deletefooter/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/deletefooter/$1";
$route[$this->config->item('admin_dir_mask') . "/footer/editfooter/(:num)"] = $this->config->item('admin_dir_mask') . "/footer/editfooter/$1";

$route[$this->config->item('admin_dir_mask') . "/reports"] = $this->config->item('admin_dir_mask') . "/reports/index";
$route[$this->config->item('admin_dir_mask') . "/reports/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/index/$1";
$route[$this->config->item('admin_dir_mask') . "/reports/addcategory"] = $this->config->item('admin_dir_mask') . "/reports/addcategory";
$route[$this->config->item('admin_dir_mask') . "/reports/editcategory/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/editcategory/$1";
$route[$this->config->item('admin_dir_mask') . "/reports/addfile/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/addfile/$1";
$route[$this->config->item('admin_dir_mask') . "/reports/showitems/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/showitems/$1";
$route[$this->config->item('admin_dir_mask') . "/reports/showitems/(:num)/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/showitems/$1/$2";
$route[$this->config->item('admin_dir_mask') . "/reports/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/reports/deleteitem/(:num)"] = $this->config->item('admin_dir_mask') . "/reports/deleteitem/$1";

$route[$this->config->item('admin_dir_mask') . "/downloads"] = $this->config->item('admin_dir_mask') . "/downloads/index";
$route[$this->config->item('admin_dir_mask') . "/downloads"] = $this->config->item('admin_dir_mask') . "/downloads/index";
$route[$this->config->item('admin_dir_mask') . "/downloads/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/index/$1";
$route[$this->config->item('admin_dir_mask') . "/downloads/addcategory"] = $this->config->item('admin_dir_mask') . "/downloads/addcategory";
$route[$this->config->item('admin_dir_mask') . "/downloads/editcategory/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/editcategory/$1";
$route[$this->config->item('admin_dir_mask') . "/downloads/addfile/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/addfile/$1";
$route[$this->config->item('admin_dir_mask') . "/downloads/showitems/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/showitems/$1";
$route[$this->config->item('admin_dir_mask') . "/downloads/showitems/(:num)/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/showitems/$1/$2";
$route[$this->config->item('admin_dir_mask') . "/downloads/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/downloads/deleteitem/(:num)"] = $this->config->item('admin_dir_mask') . "/downloads/deleteitem/$1";


$route[$this->config->item('admin_dir_mask') . "/management"] = $this->config->item('admin_dir_mask') . "/management/index";
$route[$this->config->item('admin_dir_mask') . "/management/addteam"] = $this->config->item('admin_dir_mask') . "/management/addteam";
$route[$this->config->item('admin_dir_mask') . "/management/editteam/(:num)"] = $this->config->item('admin_dir_mask') . "/management/editteam/$1";
$route[$this->config->item('admin_dir_mask') . "/management/deleteteam/(:num)"] = $this->config->item('admin_dir_mask') . "/management/deleteteam/$1";
$route[$this->config->item('admin_dir_mask') . "/management/viewmembers/(:num)"] = $this->config->item('admin_dir_mask') . "/management/viewmembers/$1";
$route[$this->config->item('admin_dir_mask') . "/management/addmember/(:num)"] = $this->config->item('admin_dir_mask') . "/management/addmember/$1";
$route[$this->config->item('admin_dir_mask') . "/management/editmember/(:num)"] = $this->config->item('admin_dir_mask') . "/management/editmember/$1";
$route[$this->config->item('admin_dir_mask') . "/management/editmember/(:num)/(:num)"] = $this->config->item('admin_dir_mask') . "/management/editmember/$1/$2";
$route[$this->config->item('admin_dir_mask') . "/management/deletemember/(:num)"] = $this->config->item('admin_dir_mask') . "/management/deletemember/$1";
$route[$this->config->item('admin_dir_mask') . "/management/updatefront"] = $this->config->item('admin_dir_mask') . "/management/updatefront";

$route[$this->config->item('admin_dir_mask') . "/outletlocator"] = $this->config->item('admin_dir_mask') . "/outletlocator/index";
$route[$this->config->item('admin_dir_mask') . "/outletlocator/add"] = $this->config->item('admin_dir_mask') . "/outletlocator/add";
$route[$this->config->item('admin_dir_mask') . "/outletlocator/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/outletlocator/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/outletlocator/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/outletlocator/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/outletlocator/sortbranch"] = $this->config->item('admin_dir_mask') . "/outletlocator/sortbranch";

$route[$this->config->item('admin_dir_mask') . "/quicklinks"] = $this->config->item('admin_dir_mask') . "/quicklinks/index";
$route[$this->config->item('admin_dir_mask') . "/quicklinks/add"] = $this->config->item('admin_dir_mask') . "/quicklinks/add";
$route[$this->config->item('admin_dir_mask') . "/quicklinks/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/quicklinks/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/quicklinks/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/quicklinks/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/feedback"] = $this->config->item('admin_dir_mask') . "/feedback/index";
$route[$this->config->item('admin_dir_mask') . "/feedback/view/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/view/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/comments/(:any)"] = $this->config->item('admin_dir_mask') . "/feedback/comments/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/commentsof/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/commentsof/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/approvecomment/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/approvecomment/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/disapprovecomment/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/disapprovecomment/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/deletecomment/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/deletecomment/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/viewcomment/(:num)/(:num)/(:any)"] = $this->config->item('admin_dir_mask') . "/feedback/viewcomment/$1/$2/$3";

$route[$this->config->item('admin_dir_mask') . "/feedback/feedbacktype"] = $this->config->item('admin_dir_mask') . "/feedback/feedbacktype/index";
$route[$this->config->item('admin_dir_mask') . "/feedback/feedbacktype/add"] = $this->config->item('admin_dir_mask') . "/feedback/feedbacktype/add";
$route[$this->config->item('admin_dir_mask') . "/feedback/feedbacktype/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/feedbacktype/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/feedback/feedbacktype/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/feedback/feedbacktype/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/testimonial"] = $this->config->item('admin_dir_mask') . "/testimonial/index";
$route[$this->config->item('admin_dir_mask') . "/testimonial/add"] = $this->config->item('admin_dir_mask') . "/testimonial/add";
$route[$this->config->item('admin_dir_mask') . "/testimonial/updateOrder"] = $this->config->item('admin_dir_mask') . "/testimonial/updateOrder";
$route[$this->config->item('admin_dir_mask') . "/testimonial/updateFront"] = $this->config->item('admin_dir_mask') . "/testimonial/updateFront";
$route[$this->config->item('admin_dir_mask') . "/testimonial/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/testimonial/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/testimonial/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/testimonial/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/vacancy"] = $this->config->item('admin_dir_mask') . "/vacancy/index";
$route[$this->config->item('admin_dir_mask') . "/vacancy/add"] = $this->config->item('admin_dir_mask') . "/vacancy/add";
$route[$this->config->item('admin_dir_mask') . "/vacancy/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/vacancy/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/vacancy/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/vacancy/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/vacancy/viewjobs/(:num)"] = $this->config->item('admin_dir_mask') . "/vacancy/viewjobs/$1";
$route[$this->config->item('admin_dir_mask') . "/vacancy/addjobs"] = $this->config->item('admin_dir_mask') . "/vacancy/addjobs";
$route[$this->config->item('admin_dir_mask') . "/vacancy/editjobs/(:num)"] = $this->config->item('admin_dir_mask') . "/vacancy/editjobs/$1";
$route[$this->config->item('admin_dir_mask') . "/vacancy/deletejobs/(:num)"] = $this->config->item('admin_dir_mask') . "/vacancy/deletejobs/$1";

$route[$this->config->item('admin_dir_mask') . "/career"] = $this->config->item('admin_dir_mask') . "/career/index";
$route[$this->config->item('admin_dir_mask') . "/career/(:num)"] = $this->config->item('admin_dir_mask') . "/career/index/$1";
$route[$this->config->item('admin_dir_mask') . "/career/cvdetail/(:num)"] = $this->config->item('admin_dir_mask') . "/career/cvdetail/$1";
$route[$this->config->item('admin_dir_mask') . "/career/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/career/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/career/exportexcel"] = $this->config->item('admin_dir_mask') . "/career/exportexcel";
$route[$this->config->item('admin_dir_mask') . "/career/careerlist/(:num)"] = $this->config->item('admin_dir_mask') . "/career/careerlist/$1";
$route[$this->config->item('admin_dir_mask') . "/career/careerlist/(:num)/(:num)"] = $this->config->item('admin_dir_mask') . "/career/careerlist/$1/$2";

$route[$this->config->item('admin_dir_mask') . "/popup"] = $this->config->item('admin_dir_mask') . "/popup/index";
$route[$this->config->item('admin_dir_mask') . "/popup/add"] = $this->config->item('admin_dir_mask') . "/popup/add";
$route[$this->config->item('admin_dir_mask') . "/popup/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/popup/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/popup/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/popup/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/contactus"] = $this->config->item('admin_dir_mask') . "/contactus/index";
$route[$this->config->item('admin_dir_mask') . "/contactus/view/(:num)"] = $this->config->item('admin_dir_mask') . "/contactus/view/$1";
//$route[$this->config->item('admin_dir_mask') . "/quicklinks/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/quicklinks/edit/$1";
//$route[$this->config->item('admin_dir_mask') . "/quicklinks/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/quicklinks/delete/$1";
// call any content 

$route[$this->config->item('admin_dir_mask') . "/emailsubscription"] = $this->config->item('admin_dir_mask') . "/emailsubscription/index";
$route[$this->config->item('admin_dir_mask') . "/emailsubscription/add"] = $this->config->item('admin_dir_mask') . "/emailsubscription/add";
$route[$this->config->item('admin_dir_mask') . "/emailsubscription/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/emailsubscription/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/emailsubscription/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/emailsubscription/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/gallery"] = $this->config->item('admin_dir_mask') . "/gallery/index";
$route[$this->config->item('admin_dir_mask') . "/gallery/add"] = $this->config->item('admin_dir_mask') . "/gallery/add";
$route[$this->config->item('admin_dir_mask') . "/gallery/addimage/(:num)"] = $this->config->item('admin_dir_mask') . "/gallery/addimage/$1";
$route[$this->config->item('admin_dir_mask') . "/gallery/preview/(:num)"] = $this->config->item('admin_dir_mask') . "/gallery/preview/$1";
$route[$this->config->item('admin_dir_mask') . "/gallery/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/gallery/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/gallery/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/gallery/edit/$1";


$route[$this->config->item('admin_dir_mask') . "/faq"] = $this->config->item('admin_dir_mask') . "/faq/index";
$route[$this->config->item('admin_dir_mask') . "/faq/index/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/index/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/add"] = $this->config->item('admin_dir_mask') . "/faq/add";
$route[$this->config->item('admin_dir_mask') . "/faq/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/addfaqs/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/addfaqs/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/viewfaqs/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/viewfaqs/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/editfaqs/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/editfaqs/$1";
$route[$this->config->item('admin_dir_mask') . "/faq/deletefaqs/(:num)"] = $this->config->item('admin_dir_mask') . "/faq/deletefaqs/$1";

$route[$this->config->item('admin_dir_mask') . "/video"] = $this->config->item('admin_dir_mask') . "/video/index";
$route[$this->config->item('admin_dir_mask') . "/video/addcat"] = $this->config->item('admin_dir_mask') . "/video/addcat";
$route[$this->config->item('admin_dir_mask') . "/video/editcat/(:num)"] = $this->config->item('admin_dir_mask') . "/video/editcat/$1";
$route[$this->config->item('admin_dir_mask') . "/video/deletecat/(:num)"] = $this->config->item('admin_dir_mask') . "/video/deletecat/$1";
$route[$this->config->item('admin_dir_mask') . "/video/videolist/(:num)"] = $this->config->item('admin_dir_mask') . "/video/videolist/$1";
$route[$this->config->item('admin_dir_mask') . "/video/add/(:num)"] = $this->config->item('admin_dir_mask') . "/video/add/$1";
$route[$this->config->item('admin_dir_mask') . "/video/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/video/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/video/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/video/delete/$1";

$route[$this->config->item('admin_dir_mask') . "/faculty"] = $this->config->item('admin_dir_mask') . "/faculty/index";
$route[$this->config->item('admin_dir_mask') . "/faculty/add"] = $this->config->item('admin_dir_mask') . "/faculty/add";
$route[$this->config->item('admin_dir_mask') . "/faculty/edit/(:num)"] = $this->config->item('admin_dir_mask') . "/faculty/edit/$1";
$route[$this->config->item('admin_dir_mask') . "/faculty/delete/(:num)"] = $this->config->item('admin_dir_mask') . "/faculty/delete/$1";
$route[$this->config->item('admin_dir_mask') . "/faculty/viewFaculty/(:num)"] = $this->config->item('admin_dir_mask') . "/faculty/viewFaculty/$1";
$route[$this->config->item('admin_dir_mask') . "/faculty/viewStudent/(:num)"] = $this->config->item('admin_dir_mask') . "/faculty/viewStudent/$1";
$route[$this->config->item('admin_dir_mask') . "/faculty/deleteStudent/(:num)/(:num)"] = $this->config->item('admin_dir_mask') . "/faculty/deleteStudent/$1/$2";

$route['(:any)'] = "content/index/$1";
