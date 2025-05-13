<?php include '../inclus/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Inscription</h2>
            
            <?php if ($session->get('error')): ?>
                <div class="alert alert-danger"><?= $session->get('error'); ?></div>
                <?php $session->remove('error'); ?>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
            
            <div class="mt-3">
                <p>Déjà un compte? <a href="login.php">Connectez-vous</a></p>
            </div>
        </div>
    </div>
</div>

<?php include '../inclus/footer.php'; ?>