<?php
// Sobre
?>
<section class="fade-in">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-2">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-lime-400">Sobre</p>
            <h1 class="mt-4 text-4xl font-bold text-white">Prazer, meu nome é Adenilton</h1>
            <p class="mt-6 text-lg text-gray-300">
                Tenho 30 anos e sou formado em Sistemas de Informação. Atuo há 8 anos com estratégia de imagem e marketing digital, unindo tecnologia e comunicação para gerar resultados.
            </p>
            <p class="mt-4 text-gray-300">
                Possuo experiência em implantação e gestão de sistemas de CRM, desenvolvimento e otimização de sites, integração de sistemas e estruturação de processos de marketing e vendas.
            </p>
        </div>
        <div class="rounded-3xl border border-lime-400/30 bg-gray-950 p-8">
            <h2 class="text-xl font-bold text-lime-400">Especialidades</h2>
            <ul class="mt-4 space-y-3 text-gray-300">
                <li class="flex items-start gap-3">
                    <span class="text-lime-400 font-bold">→</span>
                    <span>Gestão de marketing e performance</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-lime-400 font-bold">→</span>
                    <span>CRM, automações e integrações</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-lime-400 font-bold">→</span>
                    <span>Desenvolvimento de sites e sistemas</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-lime-400 font-bold">→</span>
                    <span>Processos e analytics</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="bg-gray-950">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <h2 class="text-3xl font-bold text-white">Experiência em</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <?php
            $timeline = [
                ['title' => 'Estratégia & Growth', 'desc' => 'Definição de metas, funil e indicadores de performance.'],
                ['title' => 'CRM & Automação', 'desc' => 'Implantação de CRM, integrações e jornadas personalizadas.'],
                ['title' => 'Tecnologia', 'desc' => 'Sites e sistemas voltados para conversão e eficiência.'],
                ['title' => 'Processos', 'desc' => 'Mapeamento e otimização para escala.'],
            ];
            foreach ($timeline as $item):
            ?>
                <div class="card-hover rounded-2xl border border-lime-400/20 bg-black p-6 hover:border-lime-400/50">
                    <p class="text-lg font-bold text-lime-400"><?= e($item['title']) ?></p>
                    <p class="mt-3 text-sm text-gray-300"><?= e($item['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
