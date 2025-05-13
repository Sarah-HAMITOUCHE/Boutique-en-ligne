<?php include '../inclus/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Connexion</h2>
            
            <?php if ($session->get('error')): ?>
                <div class="alert alert-danger"><?= $session->get('error'); ?></div>
                <?php $session->remove('error'); ?>
            <?php endif; ?>
            
            <?php if ($session->get('success')): ?>
                <div class="alert alert-success"><?= $session->get('success'); ?></div>
                <?php $session->remove('success'); ?>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
            
            <div class="mt-3">
                <p>Pas encore de compte? <a href="/register">Inscrivez-vous</a></p>
                <p><a href="/forgot-password">Mot de passe oublié?</a></p>
            </div>
        </div>
    </div>
</div>

<?php include '../inclus/footer.php'; ?>