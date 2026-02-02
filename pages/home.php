<?php
// Home
?>
<section class="fade-in">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-lime-400">Prazer, sou Adenilton</p>
            <h1 class="mt-4 text-4xl font-bold leading-tight text-white md:text-5xl">
                Marketing, CRM e Tecnologia para escalar resultados com eficiência.
            </h1>
            <p class="mt-6 text-lg text-gray-300">
                Tenho 30 anos e sou formado em Sistemas de Informação. Atuo há 8 anos com estratégia de imagem e marketing digital, unindo tecnologia e comunicação para gerar resultados.
            </p>
            <p class="mt-4 text-gray-300">
                Possuo experiência em implantação e gestão de sistemas de CRM, desenvolvimento e otimização de sites, integração de sistemas e estruturação de processos de marketing e vendas.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/?page=contato" class="rounded-full bg-lime-400 px-6 py-3 text-sm font-bold text-black hover:bg-lime-300">Vamos conversar?</a>
                <a href="/?page=projetos" class="rounded-full border border-lime-400 px-6 py-3 text-sm font-bold text-lime-400 hover:bg-lime-400 hover:text-black transition">Ver portfólio</a>
            </div>
        </div>
        <div class="rounded-3xl border border-lime-400/30 bg-gradient-to-br from-gray-900 via-black to-black p-8 shadow-2xl shadow-lime-400/20">
            <div class="grid gap-6">
                <div class="rounded-2xl border border-lime-400/20 bg-black/50 p-6">
                    <p class="text-sm text-lime-400 font-bold">Performance & CRM</p>
                    <p class="mt-2 text-xl font-semibold text-white">KPIs claros, funil integrado e automações que convertem.</p>
                </div>
                <div class="rounded-2xl border border-lime-400/20 bg-black/50 p-6">
                    <p class="text-sm text-lime-400 font-bold">Tecnologia</p>
                    <p class="mt-2 text-xl font-semibold text-white">Sites e sistemas alinhados à jornada do cliente.</p>
                </div>
                <div class="rounded-2xl border border-lime-400/20 bg-black/50 p-6">
                    <p class="text-sm text-lime-400 font-bold">Processos</p>
                    <p class="mt-2 text-xl font-semibold text-white">Estrutura e automação para crescimento escalável.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-950">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-lime-400">O Que Faço</p>
                <h2 class="mt-3 text-3xl font-bold text-white">Serviços orientados a resultado</h2>
            </div>
            <a href="/?page=servicos" class="text-sm font-bold text-lime-400 hover:text-lime-300">Ver todos</a>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <?php
            $services = [
                ['title' => 'Gestão de Marketing', 'desc' => 'Planejamento, execução e análise para performance consistente.'],
                ['title' => 'CRM & Automação', 'desc' => 'Implantação, integração e jornadas automatizadas.'],
                ['title' => 'Sites e Sistemas', 'desc' => 'Experiências digitais modernas e escaláveis.'],
                ['title' => 'Processos & Dados', 'desc' => 'Mapeamento, indicadores e melhoria contínua.'],
            ];
            foreach ($services as $service):
            ?>
                <div class="card-hover rounded-2xl border border-lime-400/20 bg-gray-950 p-6 hover:border-lime-400/50">
                    <p class="text-lg font-bold text-white"><?= e($service['title']) ?></p>
                    <p class="mt-3 text-sm text-gray-400"><?= e($service['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
