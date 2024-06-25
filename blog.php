<?php
$title = "Bloglar";
require 'includes/header.php';
require 'database.php';

$posts = $conn->prepare("SELECT * FROM posts");
$posts->execute();
$data = $posts->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DELETE'])) {

    $postId = $_POST['post_id'];
    $statement = $conn->prepare("DELETE FROM posts WHERE id=?");
    $statement->execute([$postId]);


    header("Location: blog.php");
}

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Quyidagi post o'chirilsinmi?
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    <input id="modal_post_id" type="hidden" name="post_id" value="">
                    <input type="hidden" name="DELETE">
                    <button type="submit" class="btn btn-danger">O'chirish</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>


            </div>
        </div>
    </div>
</div>


<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Blog yaratish</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
                <p>
                    <a href="post_create.php" class="btn btn-primary my-2">Blog Yaratish</a>
                    <a href="index.php" class="btn btn-secondary my-2">Bosh sahifaga qaytish</a>
                </p>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <?php
            if (isset($_SESSION['post-creted'])) :
            ?>
                <div id="alertID" class="alert alert-success" role="alert">
                    <?= $_SESSION['post-creted'];
                    unset($_SESSION['post-creted']);
                    ?>
                </div>
            <?php endif
            ?>
             <?php
            if (isset($_SESSION['post-updated'])) :
            ?>
                <div id="alertID" class="alert alert-info" role="alert">
                    <?= $_SESSION['post-updated'];
                    unset($_SESSION['post-updated']);
                    ?>
                </div>
            <?php endif
            ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($data as $post) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>

                            <div class="card-body">
                                <a href="post.php?id=<?= $post['id'] ?>">
                                    <h6><?= $post['title'] ?></h6>
                                </a>
                                <p class="card-text"><?= $post['body'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="post_edit.php?id=<?= $post['id']?>" class="btn btn-primary" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <button id="submit" type="button" data-title="<?= $post['title'] ?>" data-postId="<?= $post['id'] ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main>
<script>
    const submitBTn = document.querySelectorAll("#submit");
    const alertDiv = document.querySelector('#alertID');
    let modalTitle = document.querySelector('#exampleModalLabel');
    let modalPostId = document.querySelector("#modal_post_id");
    submitBTn.forEach((btn) => {
        btn.addEventListener('click', () => {
            modalTitle.innerHTML = btn.getAttribute('data-title');
            modalPostId.value = btn.getAttribute('data-postId');

        })

    })
    setInterval(function() {
        alertDiv.style.display = 'none';
    }, 3000);
</script>
<?php require 'includes/footer.php'; ?>