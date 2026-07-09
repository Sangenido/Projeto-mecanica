<?php
$tituloPagina = "Serviços | Box 377 Oficina";
require 'includes/head.php';
require 'includes/conexao.php';
require 'includes/header.php';

// Busca os serviços cadastrados no banco
$query = "SELECT * FROM servicos";
$resultado = mysqli_query($conn, $query);
?>

    <main>

        <section class="services page-hero">
            <p class="section-subtitle">O QUE FAZEMOS</p>
            <h2>Nossos Serviços</h2>
        </section>

        <section class="services-full">
            <div class="services-grid">

                <?php while ($servico = mysqli_fetch_assoc($resultado)): ?>
                <article class="service-card">
                    <div class="service-content">
                        <span><?php echo htmlspecialchars($servico['categoria']); ?></span>
                        <h3><?php echo htmlspecialchars($servico['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($servico['descricao']); ?></p>
                    </div>
                </article>
                <?php endwhile; ?>

            </div>
        </section>

    </main>

<?php require 'includes/footer.php'; ?>
