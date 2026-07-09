<?php
$tituloPagina = "Contato | Box 377 Oficina";
require 'includes/head.php';
require 'includes/conexao.php';
require 'includes/header.php';
?>

    <main>

        <section class="contact-page">

            <div class="contact-info">
                <p class="section-subtitle">FALE CONOSCO</p>
                <h2>Vamos cuidar do seu veículo?</h2>
                <p>Entre em contato para agendar uma avaliação ou solicitar um orçamento.</p>
                <ul>
                    <li>📍 Rua Banco Inglês, 377 — Santa Teresa, Porto Alegre - RS</li>
                    <li>📞 (51) 99999-9999</li>
                    <li>✉ contato@box377oficina.com.br</li>
                </ul>
                <a href="#" class="btnred">CHAMAR NO WHATSAPP</a>
            </div>

            <div class="contact-form">

                <h3>Envie uma mensagem</h3>

                <?php
                if (isset($_POST['enviar'])) {
                    $nome     = mysqli_real_escape_string($conn, $_POST['nome']);
                    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
                    $email    = mysqli_real_escape_string($conn, $_POST['email']);
                    $mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']);

                    // Salva a mensagem no banco de dados
                    $query = "INSERT INTO mensagens (nome, telefone, email, mensagem)
                              VALUES ('$nome', '$telefone', '$email', '$mensagem')";

                    if (mysqli_query($conn, $query)) {
                        echo "<p style='color: green;'>Mensagem enviada! Entraremos em contato em breve.</p>";
                    } else {
                        echo "<p style='color: red;'>Erro ao enviar. Tente novamente.</p>";
                    }
                }
                ?>

                <form action="" method="post">
                    <input type="text"  name="nome"     placeholder="Seu Nome"     required>
                    <input type="tel"   name="telefone" placeholder="Seu Telefone" required>
                    <input type="email" name="email"    placeholder="Seu E-mail"   required>
                    <textarea name="mensagem" placeholder="Sua Mensagem" rows="5" required></textarea>
                    <input type="submit" name="enviar" value="ENVIAR MENSAGEM">
                </form>

            </div>

        </section>

    </main>

<?php require 'includes/footer.php'; ?>
