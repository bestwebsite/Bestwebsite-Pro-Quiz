<?php

class WpProQuiz_View_QuizOverallTable extends WP_List_Table
{
    /** @var  WpProQuiz_Model_Quiz[] */
    private $quizItems;

    private $quizCount;
    private $perPage;

    /** @var  WpProQuiz_Model_Category[] */
    private $categoryItems;

    public static function getColumnDefs()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'Bestwebsite-Pro-Quiz'),
            'category' => __('Category', 'Bestwebsite-Pro-Quiz'),
            'shortcode' => __('Shortcode', 'Bestwebsite-Pro-Quiz'),
            'shortcode_leaderboard' => __('Shortcode-Leaderboard', 'Bestwebsite-Pro-Quiz')
        );

        return $columns;
    }

    function __construct($quizItems, $quizCount, $categoryItems, $perPage)
    {
        parent::__construct(array(
            'singular' => __('Quiz', 'Bestwebsite-Pro-Quiz'),
            'plural' => __('Quiz', 'Bestwebsite-Pro-Quiz'),
            'ajax' => false,
            'screen' => 'toplevel_page_wpproquiz'
        ));

        $this->quizItems = $quizItems;
        $this->quizCount = $quizCount;
        $this->categoryItems = $categoryItems;
        $this->perPage = $perPage;
    }

    function no_items()
    {
        _e('No data available', 'Bestwebsite-Pro-Quiz');
    }

    function column_default($item, $column_name)
    {
        return isset($item[$column_name]) ? $item[$column_name] : '';
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'name' => array('name', false),
            'category' => array('category', false),
        );

        return $sortable_columns;
    }

    function get_columns()
    {
        return get_column_headers(get_current_screen());
    }

    function column_name($item)
    {
        $actions = array(
            'wpProQuiz_questions' => sprintf('<a href="?page=wpProQuiz&module=question&quiz_id=%s">' . __('Questions',
                    'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']),
        );

        if (current_user_can('wpProQuiz_edit_quiz')) {
            $actions['wpProQuiz_edit'] = sprintf('<a href="?page=wpProQuiz&action=addEdit&quizId=%s">' . __('Edit',
                    'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']);
        }

        if (current_user_can('wpProQuiz_delete_quiz')) {
            $actions['wpProQuiz_delete'] = sprintf('<a style="color: red;" href="?page=wpProQuiz&action=delete&id=%s">' . __('Delete',
                    'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']);
        }

        $actions['wpProQuiz_preview'] = sprintf('<a href="?page=wpProQuiz&module=preview&id=%s">' . __('Preview',
                'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']);

        if (current_user_can('wpProQuiz_show_statistics')) {
            $actions['wpProQuiz_statistics'] = sprintf('<a href="?page=wpProQuiz&module=statistics&id=%s">' . __('Statistics',
                    'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']);
        }

        if (current_user_can('wpProQuiz_toplist_edit')) {
            $actions['wpProQuiz_leaderboard'] = sprintf('<a href="?page=wpProQuiz&module=toplist&id=%s">' . __('Leaderboard',
                    'Bestwebsite-Pro-Quiz') . '</a>', $item['ID']);
        }

        return sprintf('<a class="row-title" href="?page=wpProQuiz&module=question&quiz_id=%1$s">%2$s</a> %3$s',
            $item['ID'], $item['name'], $this->row_actions($actions));
    }

    function get_bulk_actions()
    {
        $actions = array();

        if (current_user_can('wpProQuiz_delete_quiz')) {
            $actions['delete'] = __('Delete', 'Bestwebsite-Pro-Quiz');
        }

        if (current_user_can('wpProQuiz_export')) {
            $actions['export'] = __('Export', 'Bestwebsite-Pro-Quiz');
        }

        if (current_user_can('wpProQuiz_edit_quiz')) {
            $actions['set_category'] = __('Set Category', 'Bestwebsite-Pro-Quiz');
        }

        return $actions;
    }

    function extra_tablenav($which)
    {
        if ($which != 'top') {
            return;
        }
        ?>

        <div class="alignleft actions">
            <label class="screen-reader-text" for="cat"><?php _e('Filter by category'); ?></label>
            <select name="cat" id="cat" class="postform">
                <option value="0"><?php _e('All categories'); ?> </option>
                <?php
                foreach ($this->categoryItems as $c) {
                    $isSet = isset($_GET['cat']) && $_GET['cat'] == $c->getCategoryId();

                    echo '<option class="level-0" value="' . $c->getCategoryId() . '" ' . ($isSet ? 'selected' : '') . '>' . $c->getCategoryName() . '</option>';
                }
                ?>
            </select>
            <?php submit_button(__('Filter'), 'button', 'filter_action', false, array('id' => 'post-query-submit')); ?>
        </div>

        <?php
    }

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="quiz[]" value="%s" />', $item['ID']
        );
    }

    function prepare_items()
    {
        $this->set_pagination_args(array(
            'total_items' => $this->quizCount,
            'per_page' => $this->perPage
        ));

        $items = array();

        foreach ($this->quizItems as $q) {
            $items[] = array(
                'ID' => $q->getId(),
                'name' => $q->getName(),
                'category' => $q->getCategoryName(),
                'shortcode' => '[WpProQuiz ' . $q->getId() . ']',
                'shortcode_leaderboard' => $q->isToplistActivated() ? '[WpProQuiz_toplist ' . $q->getId() . ']' : ''
            );
        }

        $this->items = $items;
    }
}