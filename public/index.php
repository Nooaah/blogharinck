<?

require_once '../includes/config.php';

$posts = get_all_posts();

//create_post();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Blog</h1>
        <div class="row">
            <? foreach($posts as $post): ?>
                <div class="col-md-4">
                    <h2><?= $post['title'] ?></h2>
                    <p><?= $post['content'] ?></p>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</body>
</html>
