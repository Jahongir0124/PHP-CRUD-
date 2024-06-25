<?php 
require 'includes/header.php';
require 'database.php';


$id = $_GET['id'];
$sql = $conn -> prepare("SELECT * FROM posts WHERE id=?");
$sql -> execute([$id]);
$post = $sql -> fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['PUT'])){

    $name = $_POST['title'];
    $text = $_POST['text'];
    $id = $_POST['post_id'];

    
    $statement = $conn->prepare("UPDATE  posts SET title=:title, body=:body WHERE id=:id");
    $statement->execute(
        [
            'title' => $name,
            'body' => $text,
            'id' => $id
        ]
        );
    
    $_SESSION['post-updated'] = 'Post  Tahrirlandi';
    header("Location: blog.php");
    exit;
}


?>
<form action="" method="POST">
    <div class="container mt-5 mb-5">
        <div class="mb-3">
        <input type="hidden" name="PUT">
        <input type="hidden" name="post_id" value="<?= $post['id']?>">
        <label  class="form-label">Post nomi</label>
        <input name="title" type="text" class="form-control" value="<?= $post['title'] ?>">
        </div>
        <div class="mb-3">
        <label  class="form-label">Post matni</label>
        <textarea name="text" class="form-control"  rows="3">
            <?=$post['body']?>
        </textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
</form>
<?php 
require 'includes/footer.php';
?>