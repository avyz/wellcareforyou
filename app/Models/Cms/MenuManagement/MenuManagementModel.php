<?php

namespace App\Models\Cms\MenuManagement;

use CodeIgniter\Model;

class MenuManagementModel extends Model
{
    public static function sidebar()
    {
        $instance = new static();
        $db = $instance->getDb();

        $query = "SELECT 
        T0.menu_id,
        T0.menu_slug,
        T0.menu_name,
        T0.menu_icon,
        T0.menu_url,
        T0.created_at,
        T0.updated_at,
        T0.is_active,
        T1.menu_children_id,
        T1.menu_id as 'menu_id_children',
        T1.menu_children_name,
        T1.menu_children_icon,
        T1.menu_children_url,
        T1.created_at as 'created_at_children_menu'
        FROM `menu_table` T0
        LEFT JOIN menu_children_table T1
        ON T1.menu_id = T0.menu_id
        WHERE T0.is_active = 1 ORDER BY T0.menu_id ASC;";

        $result = $db->query($query)->getResultArray();

        $menu_management = [];
        foreach ($result as $r) {
            if (!isset($menu_management[$r['menu_id']])) {
                // Inisialisasi data menu jika belum ada
                $menu_management[$r['menu_id']] = [
                    'menu_id' => $r['menu_id'],
                    'menu_name' => $r['menu_name'],
                    'menu_slug' => $r['menu_slug'],
                    'menu_icon' => $r['menu_icon'],
                    'menu_url' => $r['menu_url'],
                    'created_at' => $r['created_at'],
                    'updated_at' => $r['updated_at'],
                    'is_active' => $r['is_active'],
                    'sidebar' => [],
                    // 'tab' => []
                ];
            }

            // Tambahkan children sidebar atau tab
            if ($r['menu_children_id']) {
                $menu_management[$r['menu_id']]['sidebar'][] = [
                    'menu_children_id' => $r['menu_children_id'],
                    'menu_id' => $r['menu_id'],
                    'menu_children_name' => $r['menu_children_name'],
                    'menu_children_icon' => $r['menu_children_icon'],
                    'menu_children_url' => $r['menu_children_url'],
                    'created_at_children_menu' => $r['created_at_children_menu'],
                    'tab' => self::menuTabByChildrenId($r['menu_children_id'])
                ];
            }
        }

        $menu_management = array_values($menu_management); // Reset index array
        return $menu_management;
    }

    public static function menuTabByChildrenId($children_id)
    {
        $instance = new static();
        $db = $instance->getDb();

        if ($children_id) {
            $query = "SELECT
            T0.menu_tab_id,
            T0.menu_children_id as 'children_id',
            T0.menu_tab_name,
            T0.created_at as 'created_at_tab_menu',
            T1.menu_children_id,
            T1.menu_id as 'menu_id_children',
            T1.menu_children_name,
            T1.menu_children_icon,
            T1.menu_children_url,
            T1.created_at as 'created_at_children_menu'
            FROM `menu_children_tab_table` T0
            LEFT JOIN menu_children_table T1
            ON T1.menu_children_id = T0.menu_children_id 
            WHERE T0.is_active = 1 AND T0.menu_children_id = $children_id ORDER BY T0.menu_tab_id ASC;";

            $tabs = $db->query($query)->getResultArray();

            // Tab
            $tab = [];
            if ($tabs) {
                foreach ($tabs as $t) {
                    if (!isset($tab[$t['children_id']])) {
                        $tab[] = [
                            'menu_tab_id' => $t['menu_tab_id'],
                            'menu_children_id' => $t['children_id'],
                            'menu_tab_name' => $t['menu_tab_name'],
                            'created_at_tab_menu' => $t['created_at_tab_menu']
                        ];
                    }
                }
            }

            return $tab;
        } else {
            return [];
        }
    }

    public static function menuBySlug($slug, $lang_code)
    {
        $instance = new static();
        $db = $instance->getDb();

        if ($lang_code) {
            $query = "SELECT 
        T0.menu_id,
        T0.menu_slug,
        T0.menu_name,
        T0.menu_icon,
        T0.menu_url,
        T0.created_at,
        T0.updated_at,
        T0.is_active,
        T1.menu_children_id,
        T1.menu_id as 'menu_id_children',
        T1.menu_children_name,
        T1.menu_children_icon,
        T1.menu_children_url,
        T1.created_at
        FROM `menu_table` T0
        LEFT JOIN menu_children_table T1
        ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_slug = '$slug' AND T0.lang_code = '$lang_code' ORDER BY T0.menu_id ASC;";
        } else {
            $query = "SELECT 
        T0.menu_id,
        T0.menu_slug,
        T0.menu_name,
        T0.menu_icon,
        T0.menu_url,
        T0.created_at,
        T0.updated_at,
        T0.is_active,
        T1.menu_children_id,
        T1.menu_id as 'menu_id_children',
        T1.menu_children_name,
        T1.menu_children_icon,
        T1.menu_children_url,
        T1.created_at
        FROM `menu_table` T0
        LEFT JOIN menu_children_table T1
        ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_slug = '$slug' AND T0.lang_code = (SELECT a.lang_code FROM lang_table a WHERE a.is_lang_default = 1) ORDER BY T0.menu_id ASC;";
        }

        $query_lang = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default
        FROM `lang_table` 
        WHERE is_active = 1 ORDER BY lang_id ASC;";

        $result = $db->query($query)->getRowArray();
        $sidebars = $db->query($query)->getResultArray();

        $lang = $db->query($query_lang)->getResultArray();


        // Language
        $language = [];

        // Sidebar
        $uri = service('uri');
        $url = $uri->getPath();
        $sidebar = [];

        // Menu
        $menu_management = [];
        if ($result) {
            if ($lang) {
                foreach ($lang as $l) {
                    if (!isset($language[$l['lang_id']])) {
                        $language[] = [
                            'lang_id' => $l['lang_id'],
                            'lang_code' => $l['lang_code'],
                            'language' => $l['language'],
                            'lang_icon' => $l['lang_icon'],
                            'created_at' => $l['created_at'],
                            'is_active' => $l['is_active'],
                            'is_lang_default' => $l['is_lang_default'],
                        ];
                    }
                }
            }
            if ($sidebars) {
                foreach ($sidebars as $s) {
                    if (!isset($sidebar[$s['menu_children_id']])) {
                        if ($url == $s['menu_children_url']) {
                            $sidebar[] = [
                                'menu_children_id' => $s['menu_children_id'],
                                'menu_id' => $s['menu_id'],
                                'menu_children_name' => $s['menu_children_name'],
                                'menu_children_icon' => $s['menu_children_icon'],
                                'menu_children_url' => $s['menu_children_url'],
                                'created_at' => $s['created_at'],
                                'tab' => self::menuTabByChildrenId($s['menu_children_id'])
                            ];
                        }
                    }
                }
            }
            if (!isset($menu_management[$result['menu_id']])) {
                // Inisialisasi data menu jika belum ada
                $menu_management[$result['menu_id']]['language'] = $language;
                $menu_management[$result['menu_id']]['menu'] = [
                    'menu_id' => $result['menu_id'],
                    'menu_name' => $result['menu_name'],
                    'menu_slug' => $result['menu_slug'],
                    'menu_icon' => $result['menu_icon'],
                    'menu_url' => $result['menu_url'],
                    'created_at' => $result['created_at'],
                    'updated_at' => $result['updated_at'],
                    'is_active' => $result['is_active']
                ];
                $menu_management[$result['menu_id']]['sidebar'] = $sidebar;
            }
        }

        $menu_management = array_values($menu_management); // Reset index array
        // dd($menu_management);
        if ($menu_management) {
            return $menu_management[0];
        }

        return $menu_management;
    }

    // Breadcrumbs
    public static function breadCrumbsBySlug($lang_code)
    {
        $breadcrumbs = service('uri');

        // Breadcrumbs
        $breadcrumb = [];
        if ($breadcrumbs) {
            $getSegments = $breadcrumbs->getSegments();
            $segment = $breadcrumbs->getSegment($breadcrumbs->getTotalSegments());
            $first_segment = self::menuBySlug($breadcrumbs->getSegment(1), $lang_code)['menu'] ?? null;
            $i = 1;
            if ($first_segment) {
                foreach ($getSegments as $b) {
                    $subSegments = array_slice($getSegments, 0, $i);
                    $link = implode('/', $subSegments);
                    $text = str_replace('-', ' ', $b);
                    $url = '/' . $link;
                    $breadcrumb[] = [
                        'segment' => $first_segment['menu_slug'] === $breadcrumbs->getSegment($i) ? $first_segment['menu_name'] : ucwords($text),
                        'url' => $segment == $text ? '#' : $url
                    ];
                    $i++;
                }
            }
        }

        return $breadcrumb;
    }

    // Language By Language Code
    public static function languageByLangCode($lang_code)
    {
        $instance = new static();
        $db = $instance->getDb();
        if ($lang_code) {
            $query = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default
        FROM `lang_table` 
        WHERE is_active = 1 AND lang_code = '$lang_code' ORDER BY lang_id ASC;";
        } else {
            $query = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default
        FROM `lang_table` 
        WHERE is_active = 1 AND is_lang_default = 1 ORDER BY lang_id ASC;";
        }

        $result = $db->query($query)->getRowArray();

        return $result;
    }
}
