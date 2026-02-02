# Site Profissional - Gestão de Marketing & Tecnologia

## Requisitos
- PHP 8+
- MySQL (Hostinger / phpMyAdmin)
- Apache

## Estrutura
```
/assets
  /css
  /js
  /uploads
/includes
/pages
/admin
/config
```

## Instalação (Hostinger)
1. Crie um banco de dados MySQL no painel da Hostinger.
2. Abra o phpMyAdmin e execute o script [database.sql](database.sql).
3. Edite as credenciais em [config/db.php](config/db.php).
4. Ajuste `base_url` em [config/config.php](config/config.php) se necessário.
5. Envie todos os arquivos para a pasta `public_html`.
6. Garanta permissões de escrita em `assets/uploads` (ex.: 755).
7. Acesse `/admin/seed.php` para criar o usuário administrador (use uma única vez).
8. Remova o arquivo `admin/seed.php` após criar o usuário.
9. Acesse `/admin/login.php` e entre com as credenciais criadas.

## Observações
- Use HTTPS no ambiente de produção.
- Altere a senha após o primeiro login.
- Para upload de vídeos, use MP4.
