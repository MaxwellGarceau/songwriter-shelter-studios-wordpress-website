<?php

// UPVOTE ICON

// Customizes WordPress API Endpoint for upvote count

add_action('rest_api_init', 'songwriterUpvoteRoutes');

function songwriterUpvoteRoutes()
{
    register_rest_route('songwriter/v1', 'manageUpvote', [
        'methods'  => 'POST',
        'callback' => 'createUpvote',
    ]);

    register_rest_route('songwriter/v1', 'manageUpvote', [
        'methods'  => 'DELETE',
        'callback' => 'deleteUpvote',
    ]);
}

// Backend function for creating upvotes
function createUpvote($data)
{
    if (is_user_logged_in()) {
        // sanitize_text_field protects from malicious user input
        $post = sanitize_text_field($data['postId']);

        // Makes sure each user can only give one upvote
        $existQuery = new WP_Query([
            'author'     => get_current_user_id(),
            'post_type'  => 'upvote',
            'meta_query' => [
                [
                    'key'     => 'upvoted_post_id',
                    'compare' => '=',
                    'value'   => get_the_ID(),
                ],
            ],
        ]);

        if ($existQuery->found_posts == 0) {
            return wp_insert_post([
                'post_type'   => 'upvote',
                'post_status' => 'publish',
                'post_title'  => 'New Upvote!',
                'meta_input'  => [
                    'upvoted_post_id' => $post,
                ],
            ]);
        } else {
            die('One upvote per user.');
        }

    } else {
        die('Only logged in users can create an upvote.');
    }
}

// Backend function for deleting upvotes
function deleteUpvote($data)
{
    $upvoteId = sanitize_text_field($data['upvote']);
    if (get_current_user_id() == get_post_field('post_author', $upvoteId) and get_post_type($upvoteId) == 'upvote') {
        wp_delete_post($upvoteId, true);
        return 'Congrats, upvote deleted.';
    } else {
        die('You do not have permission to delete that.');
    }
}
