<?php
/**
 * returns true if user exists in the database or false if user does not exist
 *
 * @param string $username
 * @param string $password
 * @param mysqli $con
 * @return bool
 */
function userAlreadyExists(string $username, string $password, $con): bool
{
    $query = "SELECT * FROM members WHERE BINARY username='$username' AND password='" . hash('sha256', $password) . "'";
    $result = mysqli_query($con, $query) or die("Not able to execute the query");
    $rows = mysqli_num_rows($result);
    return $rows == 1;
}

// Receives a user id and returns the username
function getUsernameById($id, $con): string
{
    $result = mysqli_query($con, "SELECT username FROM members WHERE id=" . $id . " LIMIT 1");
    // return the username
    return mysqli_fetch_assoc($result)['username'];
}

// Receives username and returns user's profile picture details
function getMemberDetails($username, $con): array
{
    $query = "SELECT picture_path, profile_pic FROM members WHERE username = '$username'  LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img_path = $row['picture_path'];
    $img_name = $row['profile_pic'];
    return array($img_path, $img_name);
}

// Receives a post id and returns the total number of comments on that post
function getRepliessCount($post_id, $con)
{
    $result = mysqli_query($con, "SELECT COUNT(*) AS total FROM comment_replies");
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

function getUsersID($con, $username)
{
    //find user id from session name
    $query = "SELECT id FROM members WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    return $row['id'];
}

function photoIdNotExists($con, $photo_id): bool
{
    //find user id from session name
    $query = "SELECT * FROM images WHERE photo_id = '$photo_id' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    return empty($row[0]);
}

function receiverIdNotExists($con, $user_id): bool
{
    //find user id from session name
    $query = "SELECT * FROM members WHERE id = '$user_id' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    return empty($row[0]);
}

// this function is used to change like/unlike state mostly on pic_comments.php and profile3.php pages
function post_is_liked_from($username, $post_id, $con): bool
{
    $user_id = getUsersID($con, $username);
    $result = mysqli_query($con, "SELECT * FROM post_likes WHERE liked_by_user = '$user_id' AND posted_photo_id='$post_id'");
    return (mysqli_num_rows($result) > 0); // which means post is liked by this user
}

// functions that used only on profile3.php page
// ------------------------------------------ //
function isSaved($con, $post_id): bool
{
    $query_count_saves = "SELECT COUNT(*) FROM saved_posts WHERE post_id = $post_id";
    $result_count_saves = mysqli_query($con, $query_count_saves);
    $row_count_saves = mysqli_fetch_row($result_count_saves);
    return ($row_count_saves[0] > 0);
}

/* handle user status utility functions */
function set_status($con, $username, $status)
{
    $query = "UPDATE members SET status='$status' WHERE username = '$username' ";
    $result = mysqli_query($con, $query) or die("Not able to execute the query");
    return $result;
}

function get_status($con, $username)
{
    $query = "SELECT status FROM members WHERE username = '$username' ";
    $result = mysqli_query($con, $query) or die("Not able to execute the query");
    $user_status = mysqli_fetch_array($result);
    return $user_status[0];
}