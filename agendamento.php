<?php $tituloPagina = "Agendamento | Box 377 Oficina"; ?>
<?php require 'includes/head.php'; ?>
<?php require 'includes/header.php'; ?>

    <main>

        <section class="contact-page">

            <div class="contact-info">
                <p class="section-subtitle">AGENDE SEU HORÁRIO</p>
                <h2>Sem filas, sem espera.</h2>
                <p>Escolha o serviço e o melhor horário para você. Confirmaremos via WhatsApp.</p>

                <ul>
                    <li>⏰ Seg a Sex: 08h às 18h</li>
                    <li>⏰ Sábado: 08h às 12h</li>
                    <li>📞 (51) 99999-9999</li>
                </ul>
            </div>

            <div class="contact-form">

                <h3>Formulário de Agendamento</h3>

                <?php
                if (isset($_POST['agendar'])) {
                    $nome     = $_POST['nome'];
                    $telefone = $_POST['telefone'];
                    $servico  = $_POST['servico'];
                    $data     = $_POST['data'];

                    echo "<p style='color: green;'>Agendamento solicitado! Entraremos em contato para confirmar.</p>";
                }
                ?>

                <form action="" method="post">

                    <input type="text" name="nome" placeholder="Seu Nome" required>

                    <input type="tel" name="telefone" placeholder="Seu Telefone" required>

                    <select name="servico" required>
                        <option value="">Selecione o Serviço</option>
                        <option value="freios">Freios</option>
                        <option value="suspensao">Suspensão</option>
                        <option value="diagnostico">Diagnóstico Eletrônico</option>
                        <option value="revisao">Revisão Preventiva</option>
                        <option value="eletrica">Elétrica Automotiva</option>
                        <option value="injecao">Injeção Eletrônica</option>
                    </select>

                    <input type="date" name="data" required>

                    <input type="submit" name="agendar" value="SOLICITAR AGENDAMENTO">

                </form>

            </div>

        </section>

    </main>

<?php require 'includes/footer.php'; ?>
