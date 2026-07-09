<?php $tituloPagina = "Home | Box 377 Oficina"; ?>
<?php require 'includes/head.php'; ?>
<?php require 'includes/header.php'; ?>

    <!-- HERO -->
    <header class="hero imgheader" id="home">

        <p class="subtitulo">BOX 377 OFICINA AUTOMOTIVA</p>

        <h1>PRECISÃO EM</h1>
        <h1><span>CADA DETALHE</span></h1>

        <p class="descricao">
            Serviços automotivos com qualidade, transparência e equipamentos modernos.
        </p>

        <div class="btn-container">
            <a href="#" class="btnred">AGENDAR AGORA</a>
            <a href="servicos.php" class="btn">VER SERVIÇOS</a>
        </div>

    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main>

        <!-- DIFERENCIAIS -->
        <section class="features">

            <div class="feature-card">
                <h3>Fast Service</h3>
                <p>Serviço rápido com qualidade e atenção aos detalhes.</p>
            </div>

            <div class="feature-card">
                <h3>Modern Equipment</h3>
                <p>Equipamentos modernos para diagnósticos precisos.</p>
            </div>

            <div class="feature-card">
                <h3>Qualified Mechanics</h3>
                <p>Mecânicos experientes e especializados.</p>
            </div>

            <div class="feature-card">
                <h3>Service Warranty</h3>
                <p>Garantia em todos os serviços realizados.</p>
            </div>

        </section>

        <!-- SERVIÇOS (prévia) -->
        <section class="services" id="services">

            <p class="section-subtitle">NOSSAS ESPECIALIDADES</p>
            <h2>Serviços de Elite</h2>

            <div class="services-grid">

                <article class="service-card">
                    <img class="imgService" src="resources/css/img/brakes.png" alt="Freios">
                    <div class="service-content">
                        <span>SAFETY & PERFORMANCE</span>
                        <h3>Freios</h3>
                        <p>Manutenção e revisão completa do sistema de freios.</p>
                    </div>
                </article>

                <article class="service-card">
                    <img class="imgService" src="resources/css/img/suspension.png" alt="Suspensão">
                    <div class="service-content">
                        <span>STABILITY & CONTROL</span>
                        <h3>Suspensão</h3>
                        <p>Diagnóstico e manutenção da suspensão.</p>
                    </div>
                </article>

                <article class="service-card">
                    <img class="imgService" src="resources/css/img/system.png" alt="Diagnóstico">
                    <div class="service-content">
                        <span>SYSTEM ANALYSIS</span>
                        <h3>Diagnóstico</h3>
                        <p>Scanner automotivo e diagnóstico eletrônico.</p>
                    </div>
                </article>

            </div>

        </section>

        <!-- SOBRE NÓS (prévia) -->
        <section id="about" class="about">

            <div class="about-img">
                <img src="resources/css/img/mecanic.png" alt="Oficina Box 377">
            </div>

            <div class="about-content">

                <p class="section-subtitle">SOBRE NÓS</p>
                <h2>Confiança e Qualidade em Cada Serviço</h2>

                <p>
                    Na Box 377, tratamos cada veículo com atenção aos detalhes e compromisso com a
                    qualidade. Nossa equipe trabalha com equipamentos modernos e processos que garantem segurança e
                    confiança para nossos clientes.
                </p>

                <p>
                    Buscamos oferecer um atendimento transparente e serviços executados com excelência, desde revisões
                    preventivas até diagnósticos avançados.
                </p>

                <div class="about-years">
                    <h3>15+</h3>
                    <p>ANOS DE EXPERIÊNCIA</p>
                </div>

            </div>

        </section>

        <!-- DEPOIMENTOS -->
        <section class="testimonials">

            <div class="section-title">
                <p>DEPOIMENTOS</p>
                <h2>O que nossos clientes dizem</h2>
            </div>

            <div class="testimonials-grid">

                <article class="testimonial-card">
                    <p>"Atendimento excelente, serviço rápido e transparente. Recomendo para qualquer pessoa que busca confiança."</p>
                    <h4>João Silva</h4>
                    <span>Cliente há 5 anos</span>
                </article>

                <article class="testimonial-card">
                    <p>"Resolveram um problema que outras oficinas não conseguiram identificar. Serviço impecável."</p>
                    <h4>Maria Souza</h4>
                    <span>Cliente</span>
                </article>

            </div>

        </section>

        <!-- CONTATO (prévia) -->
        <section id="contact" class="contact">

            <div class="contact-info">

                <p class="section-subtitle">CONTATO</p>
                <h2>Vamos cuidar do seu veículo?</h2>
                <p>Entre em contato conosco para agendar uma avaliação ou solicitar um orçamento.</p>

                <ul>
                    <li>📍 Rua Banco Inglês, 377 — Santa Teresa, Porto Alegre - RS</li>
                    <li>📞 (51) 99999-9999</li>
                    <li>✉ contato@box377oficina.com.br</li>
                </ul>

                <a href="contato.php" class="btnred">CHAMAR NO WHATSAPP</a>

            </div>

            <div class="contact-map">
                <div class="mapa-responsivo">
                    <iframe src="https://www.google.com/maps?q=Rua+Banco+Ingl%C3%AAs,+377,+Santa+Teresa,+Porto+Alegre,+RS&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </section>

    </main>

<?php require 'includes/footer.php'; ?>
