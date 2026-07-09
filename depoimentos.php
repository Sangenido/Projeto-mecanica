<?php
$tituloPagina = "Depoimentos | Box 377 Oficina";
require 'includes/head.php';
require 'includes/conexao.php';
require 'includes/header.php';

// Busca os depoimentos cadastrados no banco
$query = "SELECT * FROM depoimentos";
$resultado = mysqli_query($conn, $query);
?>

    <main>

        <section class="testimonials">

            <div class="section-title">
                <p>DEPOIMENTOS</p>
                <h2>O que nossos clientes dizem</h2>
            </div>

            <div class="testimonials-grid">

                <?php while ($dep = mysqli_fetch_assoc($resultado)): ?>
                <article class="testimonial-card">
                    <p>"<?php echo htmlspecialchars($dep['texto']); ?>"</p>
                    <h4><?php echo htmlspecialchars($dep['nome']); ?></h4>
                    <span><?php echo htmlspecialchars($dep['cliente']); ?></span>
                </article>
                <?php endwhile; ?>

            </div>

        </section>

    </main>

<?php require 'includes/footer.php'; ?>
