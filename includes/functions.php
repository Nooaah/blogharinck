<?

function get_all_posts()
{
    global $db;
    $sth = $db->query("SELECT * FROM posts ORDER BY id DESC");
    return $sth->fetchAll();
}
//CRUD posts
function create_post($id_user, $title, $content, $image, $categorie)
{
    global $db;
    $ins = $db->prepare('INSERT INTO posts(id_user, title, content, image, categorie, date) VALUES(?, ?, ?, ?, ?, ?)');
    $ins->execute(array($id_user, $title, $content, $image, $categorie, time()));
}
function retrieve_post($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $get->execute(array($id));
    return $get->fetch();
}
function update_post($id, $title, $content, $categorie)
{
    global $db;
    $up = $db->prepare('UPDATE posts SET title = ?, content = ?, categorie = ? WHERE id = ?');
    $up->execute(array($title, $content, $categorie, $id));
}
function delete_post($id)
{
    global $db;
    $del = $db->prepare('DELETE FROM posts WHERE id = ?');
    $del->execute(array($id));
}
function get_post_by_categorie($cat)
{
    global $db;
    $getByCat = $db->prepare('SELECT * FROM posts WHERE categorie = ? ORDER BY id');
    $getByCat->execute(array($cat));
    return $getByCat->fetchAll();
}
function get_posts_by_user($id)
{
    global $db;
    $getByCat = $db->prepare('SELECT * FROM posts WHERE id_user = ?');
    $getByCat->execute(array($id));
    return $getByCat->fetchAll();
}
function add_view($id)
{
    global $db;
    $up = $db->prepare('UPDATE posts SET views = views + 1 WHERE id = ?');
    $up->execute(array($id));
}
function get_most_famous_posts()
{
    global $db;
    $getFamousPost = $db->prepare('SELECT * FROM posts ORDER BY views DESC LIMIT 3');
    $getFamousPost->execute();
    return $getFamousPost->fetchAll();
}
function get_new_posts()
{
    global $db;
    $getNewPosts = $db->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
    $getNewPosts->execute();
    return $getNewPosts->fetchAll();
}
//CRUD commentaires
function get_com_by_id($id)
{
    global $db;
    $sth = $db->prepare("SELECT * FROM commentaires where id_post = ?");
    $sth->execute(array($id));
    return $sth;
}
function add_comment($id, $id_user, $content)
{
    global $db;
    $sth = $db->prepare("INSERT INTO commentaires(id_user, id_post, content, date) VALUES(?,?,?,?)");;
    $sth->execute(array($id_user, $id, $content, time()));
}
//CRUD categories
function get_all_categories()
{
    global $db;
    $sth = $db->query("SELECT * FROM categories ORDER BY id");
    return $sth->fetchAll();
}
function get_categorie_id_by_name($name)
{
    global $db;
    $ins = $db->prepare('SELECT * FROM categories WHERE name = ?');
    $ins->execute(array($name));
    $ins = $ins->fetch();
    return $ins['id']; 
}
function retrieve_categorie_by_id($id)
{
    global $db;
    $ins = $db->prepare('SELECT * FROM categories WHERE id = ?');
    $ins->execute(array($id));
    $ins = $ins->fetch();
    return $ins['name']; 
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
function get_user_pseudo_by_id($id)
{
    global $db;
    $getUserById = $db->prepare('SELECT * FROM users WHERE id = ?');
    $getUserById->execute(array($id));
    return $getUserById->fetch();
}
function get_user_by_mail_and_password($mail, $password)
{
    global $db;
    $password = sha1($password);
    $get = $db->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
    $get->execute(array($mail, $password));
    return $get;
}
function create_user($pseudo, $mail, $password, $image)
{
    global $db;
    $ins = $db->prepare('INSERT INTO users(pseudo, mail, password, image) VALUES(?, ?, ?, ?)');
    $ins->execute(array($pseudo, $mail, $password, $image));
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