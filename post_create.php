<?php 
require 'includes/header.php';
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['title'];
    $text = $_POST['text'];

    
    $statement = $conn->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
    $statement->execute(
        [
            'title' => $name,
            'body' => $text
        ]
        );
    
    $_SESSION['post-creted'] = 'Post Normalniy yaratildi';
    header("Location: blog.php");
}


?>
<form action="" method="POST">
    <div class="container mt-5 mb-5">
        <div class="mb-3">
        <label  class="form-label">Post nomi</label>
        <input name="title" type="text" class="form-control">
        </div>
        <div class="mb-3">
        <label  class="form-label">Post matninin kiriting</label>
        <textarea name="text" class="form-control"  rows="3"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
</form>
<?php 
require 'includes/footer.php';
?>