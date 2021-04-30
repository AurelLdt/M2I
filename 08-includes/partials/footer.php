    <footer>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h2>Réseaux sociaux</h2>
                    <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                    </ul>
                </div>
                <div class="col-4">
                    <h2>Inscrivez-vous à la newsletter</h2>

                    <form action="" method="post">
                        <div class="input-group">
                            <input type="email" name="news-email" placeholder="Votre email"
                                   class="form-control">
                            <button class="btn btn-outline-light" name="newsletter">Ok</button>
                        </div>
                    </form>

                    <?php if (!empty($_POST) && isset($_POST['newsletter'])) { ?>
                        <div>Vous êtes inscrit à la newsletter.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
