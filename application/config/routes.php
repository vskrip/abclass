<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|
| -------------------------------------------------------------------------
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

// $route['default_controller'] = "welcome";
// $route['404_override'] = '';

//$route['default_controller'] = "pages/show/index";

switch ($_SERVER['HTTP_HOST']) {
    case 'hotel.abclass':
        $route['default_controller'] = "pages/show/search_hotel";
        break;
    default:
        $route['default_controller'] = "pages/show/index";
        break;
  }

$route['scaffolding_trigger'] = "";

$route['materials/(:num)']  = 'materials/show/$1';

$route['sections/show']  = 'pages/show/index';
$route['materials/show'] = 'pages/show/index';
$route['pages/show']     = "pages/show/index";

$route['pages/jorn_fire'] = 'pages/show/jorn_fire';
$route['pages/jorn_hotel'] = 'pages/show/jorn_hotel';
$route['pages/jorn_event'] = 'pages/show/jorn_event';
$route['pages/jorn_exibition'] = 'pages/show/jorn_exibition';
$route['pages/jorn_order'] = 'pages/show/jorn_order';

$route['pages/tic_action'] = 'pages/show/tic_action';
$route['pages/tic_faq'] = 'pages/show/tic_faq';
$route['pages/tic_ports'] = 'pages/show/tic_ports';
$route['pages/tic_bonus'] = 'pages/show/tic_bonus';
$route['pages/tic_order'] = 'pages/show/tic_order';

$route['pages/rem_cont'] = 'pages/show/rem_cont';
$route['pages/rem_hotel'] = 'pages/show/rem_hotel';
$route['pages/rem_rest'] = 'pages/show/rem_rest';

$route['pages/serv_visa'] = 'pages/show/serv_visa';
$route['pages/serv_ozp'] = 'pages/show/serv_ozp';
$route['pages/serv_drift'] = 'pages/show/serv_drift';
$route['pages/serv_agent'] = 'pages/show/serv_agent';
$route['pages/serv_client'] = 'pages/show/serv_client';


$route['pages/about_empl'] = 'pages/show/about_empl';
$route['pages/about_rew'] = 'pages/show/about_rew';
$route['pages/about_cont'] = 'pages/show/about_cont';
$route['pages/about_agent'] = 'pages/show/about_agent';

$route['pages/journey'] = 'pages/show/journey';
$route['pages/tickets'] = 'pages/show/tickets';
$route['pages/reminders'] = 'pages/show/reminders';
$route['pages/service'] = 'pages/show/service';
$route['pages/about_us'] = 'pages/show/about_us';

$route['pages/hotel'] = 'pages/show/hotel';

$route['sections/guest_lego']		= 'sections/show/guest_lego';
$route['sections/guest_skis']		= 'sections/show/guest_skis';
$route['sections/guest_cul']		= 'sections/show/guest_cul';
$route['sections/guest_disn']		= 'sections/show/guest_disn';
$route['sections/guest_aqua']		= 'sections/show/guest_aqua';
$route['sections/guest_zoo']		= 'sections/show/guest_zoo';
$route['sections/guest_alisa']		= 'sections/show/guest_alisa';

$route['sections/love_rom']			= 'sections/show/love_rom';
$route['sections/love_beauty']		= 'sections/show/love_beauty';
$route['sections/love_wedd']		= 'sections/show/love_wedd';
$route['sections/love_month']		= 'sections/show/love_month';
$route['sections/love_ben']			= 'sections/show/love_ben';
$route['sections/love_spa']			= 'sections/show/love_spa';
$route['sections/love_open']		= 'sections/show/love_open';

$route['sections/asia_sind']		= 'sections/show/asia_sind';
$route['sections/asia_night']		= 'sections/show/asia_night';
$route['sections/asia_hotel']		= 'sections/show/asia_hotel';
$route['sections/asia_world']		= 'sections/show/asia_world';
$route['sections/asia_air']			= 'sections/show/asia_air';
$route['sections/asia_jap']			= 'sections/show/asia_jap';
$route['sections/asia_china']		= 'sections/show/asia_china';

$route['sections/sport_foot']		= 'sections/show/sport_foot';
$route['sections/sport_olimp']		= 'sections/show/sport_olimp';
$route['sections/sport_skis']		= 'sections/show/sport_skis';
$route['sections/sport_fish']		= 'sections/show/sport_fish';
$route['sections/sport_hunt']		= 'sections/show/sport_hunt';
$route['sections/sport_dive']		= 'sections/show/sport_dive';
$route['sections/sport_water']		= 'sections/show/sport_water';

$route['sections/jungle_sind']		= 'sections/show/jungle_sind';
$route['sections/jungle_ind']		= 'sections/show/jungle_ind';
$route['sections/jungle_five']		= 'sections/show/jungle_five';
$route['sections/jungle_train']		= 'sections/show/jungle_train';
$route['sections/jungle_world']		= 'sections/show/jungle_world';
$route['sections/jungle_garm']		= 'sections/show/jungle_garm';
$route['sections/jungle_night']		= 'sections/show/jungle_night';

$route['sections/epi_prov']			= 'sections/show/epi_prov';
$route['sections/epi_tosk']			= 'sections/show/epi_tosk';
$route['sections/epi_rest']			= 'sections/show/epi_rest';
$route['sections/epi_cul']			= 'sections/show/epi_cul';
$route['sections/epi_whisk']		= 'sections/show/epi_whisk';
$route['sections/epi_okt']			= 'sections/show/epi_okt';
$route['sections/epi_beer']			= 'sections/show/epi_beer';

$route['sections/news']				= 'sections/show/news';
$route['sections/notes']			= 'sections/show/notes';
$route['sections/actions']			= 'sections/show/actions';
$route['sections/hotels']			= 'sections/show/hotels';
$route['sections/rests']			= 'sections/show/rests';
$route['sections/hotels/(:any)/(:num)']	= 'sections/show_adv/hotels/$1/$2';
$route['sections/rests/(:any)/(:num)']	= 'sections/show_adv/rests/$1/$2';


$route['sections/fire_tours']		= 'sections/show/fire_tours';
$route['sections/hotel_actions']	= 'sections/show/hotel_actions';
$route['sections/events_tours']		= 'sections/show/events_tours';
$route['sections/exposes']			= 'sections/show/exposes';

$route['sections/on_guest']			= 'sections/show/on_guest';
$route['sections/love']     		= 'sections/show/love';
$route['sections/asia']      		= 'sections/show/asia';
$route['sections/sport']      		= 'sections/show/sport';
$route['sections/jungle']      		= 'sections/show/jungle';
$route['sections/epicure']      	= 'sections/show/epicure';

$route['rss']            = 'administration/rss';
$route['archive']        = 'administration/archive';
$route['archive/(:any)'] = 'administration/archive/$1';
$route['search']         = 'administration/search';
$route['search/(:num)']  = 'administration/search/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */