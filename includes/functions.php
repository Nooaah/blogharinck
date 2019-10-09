<?

function get_all_posts()
{
    global $db;
    $sth = $db->query("SELECT * FROM posts");
    return $sth->fetchAll();
}
//CRUD
function create_post()
{
    global $db;
    $ins = $db->prepare('INSERT INTO posts(title, content) VALUES(?, ?)');
    $ins->execute(array('titre', 'contenu'));
}
function retrieve_post($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $get->execute(array($id));
}
function update_post($id, $title, $content)
{
    global $db;
    $get = $db->prepare('UPDATE posts SET title = ? AND content = ? WHERE id = ?');
    $get->execute(array($id, $title, $content));
}
function delete_post($id)
{
    global $db;
    $get = $db->prepare('DELETE FROM posts WHERE id = ?');
    $get->execute(array($id));
}