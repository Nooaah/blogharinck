<?

function get_all_posts()
{
    global $db;
    $sth = $db->query("SELECT * FROM posts ORDER BY id DESC");
    return $sth->fetchAll();
}
//CRUD posts
function create_post($title, $content)
{
    global $db;
    $ins = $db->prepare('INSERT INTO posts(title, content) VALUES(?, ?)');
    $ins->execute(array($title, $content));
}
function retrieve_post($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $get->execute(array($id));
    return $get->fetch();
}
function update_post($id, $title, $content)
{
    global $db;
    $up = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    $up->execute(array($title, $content, $id));
}
function delete_post($id)
{
    global $db;
    $del = $db->prepare('DELETE FROM posts WHERE id = ?');
    $del->execute(array($id));
}

//CRUD categories
function get_categorie_id_by_name($name)
{
    global $db;
    $ins = $db->prepare('SELECT * FROM categories WHERE name = ?');
    $ins->execute(array($name));
    $ins = $ins->fetch();
    return $ins['id']; 
}
function create_categorie($name)
{
    global $db;
    $ins = $db->prepare('INSERT INTO categories(name) VALUES(?)');
    $ins->execute(array($name));
}
function retrieve_categorie($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM categories WHERE id = ?');
    $get->execute(array($id));
    return $get->fetch();
}
function update_categorie($id, $name)
{
    global $db;
    $up = $db->prepare('UPDATE categories SET name = ? WHERE id = ?');
    $up->execute(array($name, $id));
}
function delete_categorie($id)
{
    global $db;
    $del = $db->prepare('DELETE FROM categories WHERE id = ?');
    $del->execute(array($id));
}


//CRUD users
function get_user_by_mail_and_password($mail, $password)
{
    global $db;
    $password = sha1($password);
    $get = $db->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
    $get->execute(array($mail, $password));
    return $get;
}
function create_user($pseudo, $mail, $password)
{
    global $db;
    $ins = $db->prepare('INSERT INTO users(pseudo, mail, password) VALUES(?, ?, ?)');
    $ins->execute(array($pseudo, $mail, $password));
}
function retrieve_user($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM users WHERE id = ?');
    $get->execute(array($id));
    return $get->fetch();
}
function update_user($id, $pseudo, $mail, $password)
{
    global $db;
    $up = $db->prepare('UPDATE users SET pseudo = ?, mail = ?, password = ? WHERE id = ?');
    $up->execute(array($pseudo, $mail, $password, $id));
}
function delete_user($id)
{
    global $db;
    $del = $db->prepare('DELETE FROM users WHERE id = ?');
    $del->execute(array($id));
}