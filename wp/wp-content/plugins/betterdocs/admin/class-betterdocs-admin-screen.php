<?php
class Betterdocs_Admin_Screen
{
    public function __construct() {
        add_filter( 'manage_docs_posts_columns', array($this, 'set_custom_edit_action_columns') );
        add_action( 'manage_docs_posts_custom_column' , array($this, 'custom_action_column'), 10, 2 );
        add_filter( 'manage_edit-docs_columns', array($this, 'sort_columns') );
        add_action('admin_menu', array( $this, 'menu_page') );
        add_filter('parent_file', array($this, 'highlight_admin_menu'), 10, 2);

        global $pagenow;
        if ($pagenow == 'edit-tags.php') {
            add_filter( 'submenu_file', array( $this, 'highlight_admin_submenu'), 10, 2);
        }
    }

    public function set_custom_edit_action_columns($columns)
    {
        unset( $columns['comments'] );
        $columns['action'] = __( 'Action', 'betterdocs' );
        return $columns;
    }

    public function custom_action_column($column, $post_id)
    {
        $wp_list_table = new BetterDocs_WP_Posts_List_Table();
        $post = get_post($post_id);
        switch ( $column ) {
            case 'action' :
                echo $wp_list_table->custom_row_actions( $post );
                break;
        }
    }

    public function sort_columns( $cols ) {
        $cols += array_splice($cols,array_search('action',array_keys($cols)),1);
        return $cols;
    }
    /**
     * Admin Menu Page
     *
     * @return void
     */
    public function menu_page()
    {
        $settings_class = new betterdocs_settings();
        $singular_name = BetterDocs_DB::get_settings('breadcrumb_doc_title');

        $betterdocs_articles_caps = apply_filters( 'betterdocs_articles_caps', 'edit_posts', 'article_roles' );
        $betterdocs_terms_caps = apply_filters( 'betterdocs_terms_caps', 'delete_others_posts', 'article_roles' );
        $betterdocs_settings_caps = apply_filters( 'betterdocs_settings_caps', 'administrator', 'settings_roles' );

        $settings = apply_filters( 'betterdocs_admin_menu', array(
            'betterdocs-setup'   => array(
                'title'      => __('Quick Setup', 'betterdocs'),
                'capability' => 'delete_users',
                'callback'   => 'BetterDocsSetupWizard::plugin_setting_page'
            ),
            'betterdocs-settings'   => array(
                'title'      => __('Settings', 'betterdocs'),
                'capability' => $betterdocs_settings_caps,
                'callback'   => array( $settings_class, 'settings_page' )
            ),
        ) );

        $this->menu_slug = 'betterdocs-admin';
        //$betterdocs_admin_output = apply_filters( 'betterdocs_admin_output', array() );
        $betterdocs_admin_output = $this->betterdocs_admin_output();

        add_menu_page(
            'BetterDocs', 'BetterDocs',
            $betterdocs_articles_caps, $this->menu_slug, $betterdocs_admin_output,
            BETTERDOCS_ADMIN_URL.'/assets/img/betterdocs-icon-white.svg', 5
        );
        add_submenu_page(
            $this->menu_slug, '',
            __( 'All Docs', 'betterdocs' ),
            $betterdocs_articles_caps, $this->menu_slug
        );
        add_submenu_page(
            $this->menu_slug, __('Add New', 'betterdocs'),
            __('Add New', 'betterdocs'),
            $betterdocs_articles_caps,
            'post-new.php?post_type=docs'
        );
        add_submenu_page(
            $this->menu_slug, __('Categories', 'betterdocs'), __('Categories', 'betterdocs'),
            $betterdocs_terms_caps, 'edit-tags.php?taxonomy=doc_category&post_type=docs'
        );
        add_submenu_page(
            $this->menu_slug, __('Tags', 'betterdocs'), __('Tags', 'betterdocs'),
            $betterdocs_terms_caps, 'edit-tags.php?taxonomy=doc_tag&post_type=docs'
        );

        foreach( $settings as $slug => $setting ) {
            $cap  = isset( $setting['capability'] ) ? $setting['capability'] : 'delete_users';
            add_submenu_page( $this->menu_slug, $setting['title'], $setting['title'], $cap, $slug, $setting['callback'] );
        }
    }

    public function highlight_admin_menu($parent_file)
    {
        global $current_screen;
        if( $this->menu_slug === 'betterdocs-admin' && in_array( $current_screen->id, array( 'edit-doc_tag', 'edit-doc_category' ) ) ) {
            $parent_file = 'betterdocs-admin';
        } else {
            if( in_array( $current_screen->id, array( 'edit-doc_tag', 'edit-doc_category' ) ) ) {
                $parent_file = 'edit.php?post_type=docs';
            }
        }
        return $parent_file;
    }

    public function highlight_admin_submenu( $parent_file, $submenu_file )
    {
        global $current_screen, $pagenow;
        if ( $current_screen->post_type == 'docs' ) {
            if ( $pagenow == 'post.php' ) {
                $submenu_file = 'edit.php?post_type=docs';
            }
            if ( $pagenow == 'post-new.php' ) {
                $submenu_file = 'post-new.php?post_type=docs';
            }
            if( $current_screen->id === 'edit-doc_category' ) {
                $submenu_file = 'edit-tags.php?taxonomy=doc_category&post_type=docs';
            }
            if( $current_screen->id === 'edit-doc_tag' ) {
                $submenu_file = 'edit-tags.php?taxonomy=doc_tag&post_type=docs';
            }
            if( $current_screen->id === 'edit-knowledge_base' ) {
                $submenu_file = 'edit-tags.php?taxonomy=knowledge_base&post_type=docs';
            }
        }
        if( 'betterdocs_page_betterdocs-settings' == $current_screen->id ) {
            $submenu_file = 'betterdocs-settings';
        }
        if( 'betterdocs_page_betterdocs-setup' == $current_screen->id ) {
            $submenu_file = 'betterdocs-setup';
        }

        return $submenu_file;
    }

    public function header_template()
    {
        $html = '<div class="betterdocs-settings-header">
            <div class="betterdocs-header-full">
                <img src="'.BETTERDOCS_ADMIN_URL.'assets/img/betterdocs-icon.svg" alt="">
                <h2 class="title">'.esc_html__('BetterDocs', 'betterdocs').'</h2>
                <div class="betterdocs-header-button">
                    <a href="edit.php?post_type=docs&bdocs_view=classic" class="betterdocs-button betterdocs-button-secondary">'.esc_html__('Switch to Classic UI', 'betterdocs').'</a>
                    <a href="post-new.php?post_type=docs" class="betterdocs-button betterdocs-button-primary">'.esc_html__('Add New Doc', 'betterdocs').'</a>
                </div>
                <div class="betterdocs-switch-mode">
                    <label for="betterdocs-mode-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="dayIcon" x="0px" y="0px" viewBox="0 0 35 35" style="enable-background:new 0 0 35 35;" xml:space="preserve">
							<g id="Sun">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M6,17.5C6,16.672,5.328,16,4.5,16h-3C0.672,16,0,16.672,0,17.5    S0.672,19,1.5,19h3C5.328,19,6,18.328,6,17.5z M7.5,26c-0.414,0-0.789,0.168-1.061,0.439l-2,2C4.168,28.711,4,29.086,4,29.5    C4,30.328,4.671,31,5.5,31c0.414,0,0.789-0.168,1.06-0.44l2-2C8.832,28.289,9,27.914,9,27.5C9,26.672,8.329,26,7.5,26z M17.5,6    C18.329,6,19,5.328,19,4.5v-3C19,0.672,18.329,0,17.5,0S16,0.672,16,1.5v3C16,5.328,16.671,6,17.5,6z M27.5,9    c0.414,0,0.789-0.168,1.06-0.439l2-2C30.832,6.289,31,5.914,31,5.5C31,4.672,30.329,4,29.5,4c-0.414,0-0.789,0.168-1.061,0.44    l-2,2C26.168,6.711,26,7.086,26,7.5C26,8.328,26.671,9,27.5,9z M6.439,8.561C6.711,8.832,7.086,9,7.5,9C8.328,9,9,8.328,9,7.5    c0-0.414-0.168-0.789-0.439-1.061l-2-2C6.289,4.168,5.914,4,5.5,4C4.672,4,4,4.672,4,5.5c0,0.414,0.168,0.789,0.439,1.06    L6.439,8.561z M33.5,16h-3c-0.828,0-1.5,0.672-1.5,1.5s0.672,1.5,1.5,1.5h3c0.828,0,1.5-0.672,1.5-1.5S34.328,16,33.5,16z     M28.561,26.439C28.289,26.168,27.914,26,27.5,26c-0.828,0-1.5,0.672-1.5,1.5c0,0.414,0.168,0.789,0.439,1.06l2,2    C28.711,30.832,29.086,31,29.5,31c0.828,0,1.5-0.672,1.5-1.5c0-0.414-0.168-0.789-0.439-1.061L28.561,26.439z M17.5,29    c-0.829,0-1.5,0.672-1.5,1.5v3c0,0.828,0.671,1.5,1.5,1.5s1.5-0.672,1.5-1.5v-3C19,29.672,18.329,29,17.5,29z M17.5,7    C11.71,7,7,11.71,7,17.5S11.71,28,17.5,28S28,23.29,28,17.5S23.29,7,17.5,7z M17.5,25c-4.136,0-7.5-3.364-7.5-7.5    c0-4.136,3.364-7.5,7.5-7.5c4.136,0,7.5,3.364,7.5,7.5C25,21.636,21.636,25,17.5,25z" />
                                </g>
                            </g>
						</svg>
                    </label>
                    <input class="betterdocs-mode-toggle" id="betterdocs-mode-toggle" type="checkbox">
                    <label class="betterdocs-mode-toggle-button" for="betterdocs-mode-toggle"></label>
                    <label for="betterdocs-mode-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="nightIcon" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
							<path d="M96.76,66.458c-0.853-0.852-2.15-1.064-3.23-0.534c-6.063,2.991-12.858,4.571-19.655,4.571  C62.022,70.495,50.88,65.88,42.5,57.5C29.043,44.043,25.658,23.536,34.076,6.47c0.532-1.08,0.318-2.379-0.534-3.23  c-0.851-0.852-2.15-1.064-3.23-0.534c-4.918,2.427-9.375,5.619-13.246,9.491c-9.447,9.447-14.65,22.008-14.65,35.369  c0,13.36,5.203,25.921,14.65,35.368s22.008,14.65,35.368,14.65c13.361,0,25.921-5.203,35.369-14.65  c3.872-3.871,7.064-8.328,9.491-13.246C97.826,68.608,97.611,67.309,96.76,66.458z" />
						</svg>
                    </label>
                </div>
            </div>
        </div>';

        echo apply_filters('betterdocs_admin_screen_header_nav',$html);
    }

    public function betterdocs_menu_slug()
    {
        return 'betterdocs-admin';
    }

    public function betterdocs_admin_output()
    {
        return array($this, 'betterdocs_admin_display');
    }

    public function betterdocs_admin_display()
    {
        if (file_exists(BETTERDOCS_ADMIN_DIR_PATH . 'partials/betterdocs-admin-screen.php')) {
            return include_once BETTERDOCS_ADMIN_DIR_PATH . 'partials/betterdocs-admin-screen.php';
        }
    }
}