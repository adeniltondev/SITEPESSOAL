<?php
// Home
?>
<section class="fade-in">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Gestão de Marketing + Tecnologia</p>
            <h1 class="mt-4 text-4xl font-semibold leading-tight text-white md:text-5xl">
                Estruturo operações de marketing, CRM e tecnologia para escalar resultados com eficiência.
            </h1>
            <p class="mt-6 text-lg text-slate-300">
                Consultoria estratégica e implementação prática para empresas que precisam de processos claros, automações e presença digital moderna.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/?page=contato" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-200">Solicitar diagnóstico</a>
                <a href="/?page=projetos" class="rounded-full border border-slate-700 px-6 py-3 text-sm font-semibold text-white hover:border-slate-500">Ver portfólio</a>
            </div>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 p-8 shadow-2xl">
            <div class="grid gap-6">
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <p class="text-sm text-slate-400">Performance & CRM</p>
                    <p class="mt-2 text-xl font-semibold text-white">KPIs claros, funil integrado e automações que convertem.</p>
                </div>
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <p class="text-sm text-slate-400">Tecnologia</p>
                    <p class="mt-2 text-xl font-semibold text-white">Sites e sistemas alinhados à jornada do cliente.</p>
                </div>
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <p class="text-sm text-slate-400">Operações</p>
                    <p class="mt-2 text-xl font-semibold text-white">Processos estruturados para crescimento sustentável.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-900/40">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Diferenciais</p>
                <h2 class="mt-3 text-3xl font-semibold text-white">Serviços orientados a resultado</h2>
            </div>
            <a href="/?page=servicos" class="text-sm font-semibold text-slate-200 hover:text-white">Ver todos os serviços</a>
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
                <div class="card-hover rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <p class="text-lg font-semibold text-white"><?= e($service['title']) ?></p>
                    <p class="mt-3 text-sm text-slate-400"><?= e($service['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
