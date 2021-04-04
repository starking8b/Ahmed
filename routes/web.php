<?php

use App\Http\Controllers\LanguageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::group(['middleware'=>'auth'], function () {
    // Main Page Route
    Route::get('/', 'DashboardController@dashboardEcommerce')->name('dashboard-ecommerce');

    /* Route Dashboards */
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('analytics', 'DashboardController@dashboardAnalytics')->name('dashboard-analytics');
        Route::get('ecommerce', 'DashboardController@dashboardEcommerce')->name('dashboard-ecommerce');
    });
    /* Route Dashboards */
    Route::group(['prefix' => 'ISP'], function () {
        Route::get('users', 'ISPUsersController@index')->name('isp-users-list');
        Route::get('users/newuser', 'ISPUsersController@add')->name('isp-users-new');
        Route::get('users/user_exists', 'ISPUsersController@user_exists')->name('isp-users-exists');
        Route::get('users/Delete', 'ISPUsersController@destroy')->name('isp-users-destroy');
        Route::get('users/edit/{username}', 'ISPUsersController@edit_view')->name('isp-users-edit_view');
        Route::get('users/add', 'ISPUsersController@add')->name('isp-users-add');
        Route::get('users/edit', 'ISPUsersController@edit')->name('isp-users-edit');
        Route::get('users/adduser', 'ISPUsersController@addview')->name('isp-users-add-view');
        Route::get('usereSearch', 'ISPUsersController@reSearch')->name('isp-users-research');
        Route::get('getPageCountusers', 'ISPUsersController@getPageCount')->name('isp-users-pagecount');
        Route::post('uploadIdImage/{type}', 'ISPUsersController@uploadIdImage')->name('isp-users-uploadIdImage');
    });
    Route::group(['prefix' => 'Location'], function () {
        Route::get('list', 'LocationsController@index')->name('locations-list');
        Route::get('state_list_get', 'LocationsController@state_list_get')->name('state_list_get');
        Route::get('city_list_get', 'LocationsController@city_list_get')->name('city_list_get');
        Route::get('thana_list_get', 'LocationsController@thana_list_get')->name('thana_list_get');
        Route::get('area_list_get', 'LocationsController@area_list_get')->name('area_list_get');

        Route::POST('edit_state', 'LocationsController@edit_state')->name('edit_state');
        Route::POST('add_state', 'LocationsController@add_state')->name('add_state');
        Route::get('delete_state', 'LocationsController@delete_state')->name('delete_state');

        Route::POST('edit_city', 'LocationsController@edit_city')->name('edit_city');
        Route::POST('add_city', 'LocationsController@add_city')->name('add_city');
        Route::get('delete_city', 'LocationsController@delete_city')->name('delete_city');

        Route::POST('edit_thana', 'LocationsController@edit_thana')->name('edit_thana');
        Route::POST('add_thana', 'LocationsController@add_thana')->name('add_thana');
        Route::get('delete_thana', 'LocationsController@delete_thana')->name('delete_thana');
        Route::POST('edit_area', 'LocationsController@edit_area')->name('edit_area');
        Route::POST('add_area', 'LocationsController@add_area')->name('add_area');
        Route::get('delete_area', 'LocationsController@delete_area')->name('delete_area');

        Route::get('get_all_states', 'LocationsController@get_all_states')->name('get_all_states');
        Route::get('get_all_cities', 'LocationsController@get_all_cities')->name('get_all_cities');
        Route::get('get_all_thana', 'LocationsController@get_all_thana')->name('get_all_thana');
        Route::post('get_city_by_state', 'LocationsController@get_city_by_state')->name('get_city_by_state');
        Route::post('get_thana_by_city', 'LocationsController@get_thana_by_city')->name('get_thana_by_city');
        Route::post('get_area_by_thana', 'LocationsController@get_area_by_thana')->name('get_area_by_thana');

    });
    Route::group(['prefix' => 'Plans'], function () {
        Route::get('list', 'PlansController@index')->name('plans-list');
        Route::get('add', 'PlansController@add')->name('plans-add');
        Route::get('edit', 'PlansController@edit')->name('plans-edit');
        Route::post('delete', 'PlansController@delete')->name('plans-delete');
        Route::get('plan_list_get', 'PlansController@plan_list_get')->name('plan_list_get');



    });
    Route::group(['prefix' => 'Routers'], function () {
        Route::get('list', 'NASController@index')->name('Routers-list');
        Route::get('edit_device/{id}', 'NASController@edit_device')->name('Routers-edit_device');
        Route::get('NAS_list_get', 'NASController@NAS_list_get')->name('NAS_list_get');
        Route::get('add', 'NASController@add')->name('add');
        Route::get('router_exists', 'NASController@router_exists')->name('router_exists');
        Route::get('map', 'NASController@map')->name('router-map');
        Route::post('Save_Mikrotik', 'NASController@Save_Mikrotik')->name('router-Save_Mikrotik');
        Route::post('get_Mikrotik', 'NASController@get_Mikrotik')->name('router-get_Mikrotik');
        Route::post('test_API', 'NASController@test_API')->name('router-test_API');
        Route::post('Save_device', 'NASController@Save_device')->name('router-Save_device');
        Route::post('save_map', 'NASController@save_map')->name('router-save_map');
        Route::post('get_Map', 'NASController@get_Map')->name('router-get_Map');


    });

    Route::group(['prefix' => 'NAS'], function () {
        Route::get('NAS', 'NASController@index')->name('nas_index');








    });
    /* Route Apps */
    Route::group(['prefix' => 'app'], function () {
        Route::get('email', 'AppsController@emailApp')->name('app-email');
        Route::get('chat', 'AppsController@chatApp')->name('app-chat');
        Route::get('todo', 'AppsController@todoApp')->name('app-todo');
        Route::get('calendar', 'AppsController@calendarApp')->name('app-calendar');
        Route::get('kanban', 'AppsController@kanbanApp')->name('app-kanban');
        Route::get('invoice/list', 'AppsController@invoice_list')->name('app-invoice-list');
        Route::get('invoice/preview', 'AppsController@invoice_preview')->name('app-invoice-preview');
        Route::get('invoice/edit', 'AppsController@invoice_edit')->name('app-invoice-edit');
        Route::get('invoice/add', 'AppsController@invoice_add')->name('app-invoice-add');
        Route::get('invoice/print', 'AppsController@invoice_print')->name('app-invoice-print');
        Route::get('ecommerce/shop', 'AppsController@ecommerce_shop')->name('app-ecommerce-shop');
        Route::get('ecommerce/details', 'AppsController@ecommerce_details')->name('app-ecommerce-details');
        Route::get('ecommerce/wishlist', 'AppsController@ecommerce_wishlist')->name('app-ecommerce-wishlist');
        Route::get('ecommerce/checkout', 'AppsController@ecommerce_checkout')->name('app-ecommerce-checkout');
        Route::get('file-manager', 'AppsController@file_manager')->name('app-file-manager');
        Route::get('user/list', 'AppsController@user_list')->name('app-user-list');
        Route::get('user/view', 'AppsController@user_view')->name('app-user-view');
        Route::get('user/edit', 'AppsController@user_edit')->name('app-user-edit');
    });
    /* Route Apps */

    /* Route UI */
    Route::group(['prefix' => 'ui'], function () {
        Route::get('typography', 'UserInterfaceController@typography')->name('ui-typography');
        Route::get('colors', 'UserInterfaceController@colors')->name('ui-colors');
    });
    /* Route UI */

    /* Route Icons */
    Route::group(['prefix' => 'icons'], function () {
        Route::get('feather', 'UserInterfaceController@icons_feather')->name('icons-feather');
    });
    /* Route Icons */

    /* Route Cards */
    Route::group(['prefix' => 'card'], function () {
        Route::get('basic', 'CardsController@card_basic')->name('card-basic');
        Route::get('advance', 'CardsController@card_advance')->name('card-advance');
        Route::get('statistics', 'CardsController@card_statistics')->name('card-statistics');
        Route::get('analytics', 'CardsController@card_analytics')->name('card-analytics');
        Route::get('actions', 'CardsController@card_actions')->name('card-actions');
    });
    /* Route Cards */

    /* Route Components */
    Route::group(['prefix' => 'component'], function () {
        Route::get('alert', 'ComponentsController@alert')->name('component-alert');
        Route::get('avatar', 'ComponentsController@avatar')->name('component-avatar');
        Route::get('badges', 'ComponentsController@badges')->name('component-badges');
        Route::get('breadcrumbs', 'ComponentsController@breadcrumbs')->name('component-breadcrumbs');
        Route::get('buttons', 'ComponentsController@buttons')->name('component-buttons');
        Route::get('carousel', 'ComponentsController@carousel')->name('component-carousel');
        Route::get('collapse', 'ComponentsController@collapse')->name('component-collapse');
        Route::get('divider', 'ComponentsController@divider')->name('component-divider');
        Route::get('dropdowns', 'ComponentsController@dropdowns')->name('component-dropdowns');
        Route::get('list-group', 'ComponentsController@list_group')->name('component-list-group');
        Route::get('modals', 'ComponentsController@modals')->name('component-modals');
        Route::get('pagination', 'ComponentsController@pagination')->name('component-pagination');
        Route::get('navs', 'ComponentsController@navs')->name('component-navs');
        Route::get('tabs', 'ComponentsController@tabs')->name('component-tabs');
        Route::get('timeline', 'ComponentsController@timeline')->name('component-timeline');
        Route::get('pills', 'ComponentsController@pills')->name('component-pills');
        Route::get('tooltips', 'ComponentsController@tooltips')->name('component-tooltips');
        Route::get('popovers', 'ComponentsController@popovers')->name('component-popovers');
        Route::get('pill-badges', 'ComponentsController@pill_badges')->name('component-pill-badges');
        Route::get('progress', 'ComponentsController@progress')->name('component-progress');
        Route::get('media-objects', 'ComponentsController@media_objects')->name('component-media-objects');
        Route::get('spinner', 'ComponentsController@spinner')->name('component-spinner');
        Route::get('toast', 'ComponentsController@toast')->name('component-toast');
    });
    /* Route Components */

    /* Route Extensions */
    Route::group(['prefix' => 'ext-component'], function () {
        Route::get('sweet-alerts', 'ExtensionController@sweet_alert')->name('ext-component-sweet-alerts');
        Route::get('block-ui', 'ExtensionController@block_ui')->name('ext-component-block-ui');
        Route::get('toastr', 'ExtensionController@toastr')->name('ext-component-toastr');
        Route::get('slider', 'ExtensionController@slider')->name('ext-component-slider');
        Route::get('drag-drop', 'ExtensionController@drag_drop')->name('ext-component-drag-drop');
        Route::get('tour', 'ExtensionController@tour')->name('ext-component-tour');
        Route::get('clipboard', 'ExtensionController@clipboard')->name('ext-component-clipboard');
        Route::get('plyr', 'ExtensionController@plyr')->name('ext-component-plyr');
        Route::get('context-menu', 'ExtensionController@context_menu')->name('ext-component-context-menu');
        Route::get('swiper', 'ExtensionController@swiper')->name('ext-component-swiper');
        Route::get('tree', 'ExtensionController@tree')->name('ext-component-tree');
        Route::get('ratings', 'ExtensionController@ratings')->name('ext-component-ratings');
        Route::get('locale', 'ExtensionController@locale')->name('ext-component-locale');
    });
    /* Route Extensions */

    /* Route Page Layouts */
    Route::group(['prefix' => 'page-layouts'], function () {
        Route::get('collapsed-menu', 'PageLayoutController@layout_collapsed_menu')->name('layout-collapsed-menu');
        Route::get('boxed', 'PageLayoutController@layout_boxed')->name('layout-boxed');
        Route::get('without-menu', 'PageLayoutController@layout_without_menu')->name('layout-without-menu');
        Route::get('empty', 'PageLayoutController@layout_empty')->name('layout-empty');
        Route::get('blank', 'PageLayoutController@layout_blank')->name('layout-blank');
    });
    /* Route Page Layouts */

    /* Route Forms */
    Route::group(['prefix' => 'form'], function () {
        Route::get('input', 'FormsController@input')->name('form-input');
        Route::get('input-groups', 'FormsController@input_groups')->name('form-input-groups');
        Route::get('input-mask', 'FormsController@input_mask')->name('form-input-mask');
        Route::get('textarea', 'FormsController@textarea')->name('form-textarea');
        Route::get('checkbox', 'FormsController@checkbox')->name('form-checkbox');
        Route::get('radio', 'FormsController@radio')->name('form-radio');
        Route::get('switch', 'FormsController@switch')->name('form-switch');
        Route::get('select', 'FormsController@select')->name('form-select');
        Route::get('number-input', 'FormsController@number_input')->name('form-number-input');
        Route::get('file-uploader', 'FormsController@file_uploader')->name('form-file-uploader');
        Route::get('quill-editor', 'FormsController@quill_editor')->name('form-quill-editor');
        Route::get('date-time-picker', 'FormsController@date_time_picker')->name('form-date-time-picker');
        Route::get('layout', 'FormsController@layouts')->name('form-layout');
        Route::get('wizard', 'FormsController@wizard')->name('form-wizard');
        Route::get('validation', 'FormsController@validation')->name('form-validation');
        Route::get('repeater', 'FormsController@form_repeater')->name('form-repeater');
    });
    /* Route Forms */

    /* Route Tables */
    Route::group(['prefix' => 'table'], function () {
        Route::get('', 'TableController@table')->name('table');
        Route::get('datatable/basic', 'TableController@datatable_basic')->name('datatable-basic');
        Route::get('datatable/advance', 'TableController@datatable_advance')->name('datatable-advance');
        Route::get('ag-grid', 'TableController@ag_grid')->name('ag-grid');
    });
    /* Route Tables */

    /* Route Pages */
    Route::group(['prefix' => 'page'], function () {
        Route::get('account-settings', 'PagesController@account_settings')->name('page-account-settings');
        Route::get('profile', 'PagesController@profile')->name('page-profile');
        Route::get('faq', 'PagesController@faq')->name('page-faq');
        Route::get('knowledge-base', 'PagesController@knowledge_base')->name('page-knowledge-base');
        Route::get('knowledge-base/category', 'PagesController@kb_category')->name('page-knowledge-base');
        Route::get('knowledge-base/category/question', 'PagesController@kb_question')->name('page-knowledge-base');
        Route::get('pricing', 'PagesController@pricing')->name('page-pricing');
        Route::get('blog/list', 'PagesController@blog_list')->name('page-blog-list');
        Route::get('blog/detail', 'PagesController@blog_detail')->name('page-blog-detail');
        Route::get('blog/edit', 'PagesController@blog_edit')->name('page-blog-edit');

        // Miscellaneous Pages With Page Prefix
        Route::get('coming-soon', 'MiscellaneousController@coming_soon')->name('misc-coming-soon');
        Route::get('not-authorized', 'MiscellaneousController@not_authorized')->name('misc-not-authorized');
        Route::get('maintenance', 'MiscellaneousController@maintenance')->name('misc-maintenance');
    });
    /* Route Pages */
    Route::get('/error', 'MiscellaneousController@error')->name('error');

    /* Route Authentication Pages */
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login-v1', 'AuthenticationController@login_v1')->name('auth-login-v1');
        Route::get('login-v2', 'AuthenticationController@login_v2')->name('auth-login-v2');
        Route::get('register-v1', 'AuthenticationController@register_v1')->name('auth-register-v1');
        Route::get('register-v2', 'AuthenticationController@register_v2')->name('auth-register-v2');
        Route::get('forgot-password-v1', 'AuthenticationController@forgot_password_v1')->name('auth-forgot-password-v1');
        Route::get('forgot-password-v2', 'AuthenticationController@forgot_password_v2')->name('auth-forgot-password-v2');
        Route::get('reset-password-v1', 'AuthenticationController@reset_password_v1')->name('auth-reset-password-v1');
        Route::get('reset-password-v2', 'AuthenticationController@reset_password_v2')->name('auth-reset-password-v2');
        Route::get('lock-screen', 'AuthenticationController@lock_screen')->name('auth-lock_screen');
    });
    /* Route Authentication Pages */

    /* Route Charts */
    Route::group(['prefix' => 'chart'], function () {
        Route::get('apex', 'ChartsController@apex')->name('chart-apex');
        Route::get('chartjs', 'ChartsController@chartjs')->name('chart-chartjs');
        Route::get('echarts', 'ChartsController@echarts')->name('chart-echarts');
    });
    /* Route Charts */

    // map leaflet
    Route::get('/maps/leaflet', 'ChartsController@maps_leaflet')->name('map-leaflet');

    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);

});